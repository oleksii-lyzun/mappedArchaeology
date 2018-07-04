window.onload = function () {
    let searchField = document.getElementById('searchAJAX');
    const URL = '/home';

    searchField.addEventListener('keydown', function () {
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Typical action to be performed when the document is ready:
                console.log(xhttp.responseText);
            }
        };
        xhttp.open("POST", URL, true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp.send(`name=${this.value}`);
    })
};