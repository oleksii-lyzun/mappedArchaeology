let map;

/**
 * Array of sites, that comes from backend
 */
const SITES = JSON.parse(document.getElementById('map').dataset.sites);
console.log(SITES);
/**
 * Array with all created markers.
 * @type {Array}
 */
let markers = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.471705, lng: 31.472399},
        zoom: 6.3,
        mapTypeId: 'satellite',
        mapTypeControl: false,
        streetViewControl: false
    });

    for(let i = 0; i < SITES.length; i++)
    {
        let geoCoordinates = {lat: parseFloat(SITES[i].getLatitude), lng: parseFloat(SITES[i].getLongitude)};
        let marker = new google.maps.Marker({
            position: geoCoordinates,
            map: map,
            era: SITES[i].getEra,
            period: SITES[i].getPeriod,
            culture: SITES[i].getCulture,
            id: SITES[i].id,
        });

        markers.push(marker);

        marker.addListener('click', function () {
            if(document.querySelector('.siteInfo-inner').childElementCount > 0)
            {
                return;
            }

            document.getElementById('siteInfo').style.width = '20%';

            let parent = document.querySelector('.siteInfo-inner');
            let parent2 = document.querySelector('.siteInfo__go');
            createSidebar(parent, parent2,
                SITES[i].nameUa,
                SITES[i].nameEn,
                SITES[i].getLatitude,
                SITES[i].getLongitude,
                SITES[i].getHeight,
                SITES[i].getEra,
                SITES[i].getPeriod,
                SITES[i].getCulture,
                SITES[i].descUa,
                SITES[i].id
            );
        });
    }
}

////////////////////////////////////////////////////////////////////////////

let filterSidebar = document.getElementById('siteFilters-sidebar');
let filterSidebarButton = document.getElementById('siteFilters-button');

let downUpButtonEra = document.querySelector('.downUpButton-era');
let downUpButtonPeriod = document.querySelector('.downUpButton-period');
let downUpButtonCulture = document.querySelector('.downUpButton-culture');

let eraCheckboxes = '.eraCheckContainer';
let periodCheckboxes = '.periodCheckContainer';
let cultureCheckboxes = '.cultureCheckContainer';

let filterSidebarIsActive = false;
let eraCheckboxesIsActive = false;
let periodCheckboxesIsActive = false;
let cultureCheckboxesIsActive = false;

filterSidebarButton.addEventListener('click', function () {
    if(!filterSidebarIsActive)
    {
        filterSidebar.style.display = 'block';
        filterSidebar.style.width = '250px';
        filterSidebarIsActive = true;

        filterSidebarButton.firstElementChild.classList.remove('fa-angle-right');
        filterSidebarButton.firstElementChild.classList.add('fa-angle-left');

        cutCheckBoxes(document.querySelectorAll('.eraCheckContainer'));
        cutCheckBoxes(document.querySelectorAll('.periodCheckContainer'));
        cutCheckBoxes(document.querySelectorAll('.cultureCheckContainer'));
    } else {
        filterSidebar.style.display = 'none';
        filterSidebar.style.width = '0';
        filterSidebarIsActive = false;

        filterSidebarButton.firstElementChild.classList.remove('fa-angle-left');
        filterSidebarButton.firstElementChild.classList.add('fa-angle-right');
    }
});


showCheckboxes(eraCheckboxes, downUpButtonEra, eraCheckboxesIsActive);
showCheckboxes(periodCheckboxes, downUpButtonPeriod, periodCheckboxesIsActive);
showCheckboxes(cultureCheckboxes, downUpButtonCulture, cultureCheckboxesIsActive);


/*
*
*
*
*
HERE IS A BLOCK OF CODE WITH SERVICE FUNCTIONS
*
*
*
*
*/


/**
 *
 * @param parent - parent div
 * @param parent2
 * @param siteName - name of the site in Ukrainian
 * @param siteEnName - name of the site in English
 * @param lat - latitude
 * @param long - longitude
 * @param h - height above the sea
 * @param eras
 * @param periods
 * @param cultures
 * @param sh - short description in Ukrainian
 * @param id
 * This function creates a Sidebar with detailed information about the site
 */
function createSidebar(parent, parent2, siteName, siteEnName, lat, long, h, eras, periods, cultures, sh, id)
{
    let h2 = document.createElement('h2');
    let pEnName = document.createElement('p');
    let pLat = document.createElement('p');
    let pLong = document.createElement('p');
    let pHeight = document.createElement('p');
    let pEras = document.createElement('p');
    let pPeriods = document.createElement('p');
    let pCultures = document.createElement('p');
    let pShortDesc = document.createElement('p');
    let divI = document.createElement('div');
    let link = document.createElement('a');

    //Close button
    divI.className = 'siteInfo-inner__close';
    divI.innerHTML = '<i class="fas fa-times"></i>';
    divI.addEventListener('click', deleteNodes);

    //Button to the site page
    link.className = 'siteInfo-inner__go';
    link.href = `sites/show/${id}`;
    link.innerText = 'ПЕРЕЙТИ';

    //Set site's name from arguments to h2
    h2.className = 'siteInfo-inner__h2';
    h2.innerHTML = `${siteName}`;

    //Set site's properties from arguments
    pEnName.innerHTML = `EN: ${siteEnName}`;
    pLat.innerHTML = `Довгота: ${lat}`;
    pLong.innerHTML = `Широта: ${long}`;
    pHeight.innerHTML = `Висота на рівнем моря: ${h}`;
    pEras.innerHTML = `Ери: ${eras}`;
    pPeriods.innerHTML = `Періоди: ${periods}`;
    pCultures.innerHTML = `Культури: ${cultures}`;
    pShortDesc.innerHTML = `Короткий опис: ${sh}`;

    //Append elements
    parent.appendChild(divI);
    parent2.appendChild(link);
    parent.appendChild(h2);
    parent.appendChild(pEnName);
    parent.appendChild(pLat);
    parent.appendChild(pLong);
    parent.appendChild(pHeight);
    parent.appendChild(pEras);
    parent.appendChild(pPeriods);
    parent.appendChild(pCultures);
    parent.appendChild(pShortDesc);
}

/**
 * Delete all child nodes from .siteInfo-inner div
 * Set width of div with id #siteInfo to 0
 */
function deleteNodes()
{
    let rootNode = document.querySelector('.siteInfo-inner');
    document.getElementById('siteInfo').style.width = '0';

    while (rootNode.firstChild) {
        rootNode.removeChild(rootNode.firstChild);
    }
}

function showCheckboxes(checkboxesList, button, stateForButton) {
    button.addEventListener('click', function () {
        if(!stateForButton)
        {
            showHidedCheckboxes(document.querySelectorAll(`${checkboxesList}`));
            stateForButton = true;
        } else {
            cutCheckBoxes(document.querySelectorAll(`${checkboxesList}`));
            stateForButton = false;
        }
    });
}

function cutCheckBoxes(checkboxes) {
    for(let j = 3; j < checkboxes.length; j++)
    {
        checkboxes[j].style.display = 'none';
    }
}

function showHidedCheckboxes(checkboxes) {


    for(let j = 0; j < checkboxes.length; j++)
    {
        checkboxes[j].style.display = 'block';
    }
}

