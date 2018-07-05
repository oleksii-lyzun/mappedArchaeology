window.onload = function () {
    // Input type=text
    let searchField = document.getElementById('searchAJAX');

    // parentElement for searchField
    let searchDiv = searchField.parentElement;
    const URL = '/search';


    searchField.addEventListener('input', function () {
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                // Parse JSON response from server
                let parsedJSON = JSON.parse(xhttp.responseText);

                if(parsedJSON === null && searchField.value.length < 1)
                {
                    deleteChildDOMElementsExceptFirst(searchDiv);
                    return;
                }

                // If parsedJSON not empty - render search results under searchField
                if(parsedJSON)
                {
                    deleteChildDOMElementsExceptFirst(searchDiv);

                    for(let i = 0; i < parsedJSON.length; i++)
                    {
                        createOneSearchResult(searchDiv, parsedJSON[i]);
                    }
                } else if(searchField.value.length > 0 && searchField.value.length <= 2)
                {
                    deleteChildDOMElementsExceptFirst(searchDiv);
                    createOneSearchResult(searchDiv, 'Спробуйте ввести більше знаків', false);
                }
                else {
                    deleteChildDOMElementsExceptFirst(searchDiv);
                    createOneSearchResult(searchDiv, 'Вибачте, нічого не розкопали', false);
                }
            }
        };
        xhttp.open("POST", URL, true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp.send(`userSearch=${this.value}`);
    })
};

/**
 *
 * @param parent parentElement
 * Removes all childElements of parentElement except first one (because first one is input searchField)
 */
function deleteChildDOMElementsExceptFirst(parent) {
    while(parent.childElementCount > 1) {
        parent.lastElementChild.remove();
    }
}

/**
 *
 * @param parent
 * @param stringToShow
 * @param allowToClick
 *
 * Creates one search result as link or <p> (depends of allowToClick)
 * This func compatible only with searchField addEventListener
 */
function createOneSearchResult(parent, stringToShow, allowToClick = true) {
    let div = document.createElement('div');
    let a = document.createElement('a');
    let p = document.createElement('p');

    if(allowToClick)
    {
        a.setAttribute('href', `${stringToShow.controller}` + `${stringToShow.id}`);
        a.className = 'searchResultLink';
        a.innerText = `${stringToShow.site_name_ua}`;

        div.appendChild(a);
    } else {
        p.className = 'searchResultLink';
        p.innerText = `${stringToShow}`;

        div.appendChild(p);
    }

    parent.appendChild(div);
}