let map;

/**
 * Array of sites, that comes from backend
 */
const SITES = JSON.parse(document.getElementById('map').dataset.sites);

/**
 * Array with all created markers. Added custom properties to filter - era, period, culture
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
            culture: SITES[i].getCulture
        });

        markers.push(marker);

        marker.addListener('click', function () {
            if(document.querySelector('.siteInfo-inner').childElementCount > 0)
            {
                return;
            }

            document.getElementById('siteInfo').style.width = '20%';

            let parent = document.querySelector('.siteInfo-inner');
            createSidebar(parent,
                SITES[i].nameUa,
                SITES[i].nameEn,
                SITES[i].getLatitude,
                SITES[i].getLongitude,
                SITES[i].getHeight,
                SITES[i].getEra,
                SITES[i].getPeriod,
                SITES[i].getCulture,
                SITES[i].descUa);
        });
    }
}


/**
 *
 * @param parent
 * @param siteName
 * @param siteEnName
 * @param lat
 * @param long
 * @param h
 * @param eras
 * @param periods
 * @param cultures
 * @param sh
 */
function createSidebar(parent, siteName, siteEnName, lat, long, h, eras, periods, cultures, sh)
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
    let button = document.createElement('button');

    //
    divI.className = 'siteInfo-inner__close';
    divI.innerHTML = '<i class="fas fa-times"></i>';
    divI.addEventListener('click', deleteNodes);
    button.className = 'btn btn-primary btn-block siteInfo-inner__go';
    button.type = 'button';
    button.innerText = 'ПЕРЕЙТИ';

    //Set site's name from arguments to h2
    h2.className = 'siteInfo-inner__h2';
    h2.innerHTML = `${siteName}`;

    //
    pEnName.innerHTML = `EN: ${siteEnName}`;
    pLat.innerHTML = `Довгота: ${lat}`;
    pLong.innerHTML = `Широта: ${long}`;
    pHeight.innerHTML = `Висота на рівнем моря: ${h}`;
    pEras.innerHTML = `Ери: ${eras}`;
    pPeriods.innerHTML = `Періоди: ${periods}`;
    pCultures.innerHTML = `Культури: ${cultures}`;
    pShortDesc.innerHTML = `Короткий опис: ${sh}`;

    //
    parent.appendChild(divI);
    parent.appendChild(button);
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

function deleteNodes()
{
    let rootNode = document.querySelector('.siteInfo-inner');
    document.getElementById('siteInfo').style.width = '0';

    while (rootNode.firstChild) {
        rootNode.removeChild(rootNode.firstChild);
    }
}

////////////////////////////////////////////////////////////////////////////

let filterSidebarIsActive = false;
let filterSidebar = document.getElementById('siteFilters-sidebar');
let filterSidebarButton = document.getElementById('siteFilters-button');

filterSidebarButton.addEventListener('click', function (ev) {
    if(!filterSidebarIsActive)
    {
        filterSidebar.style.display = 'block';
        filterSidebar.style.width = '250px';
        filterSidebarIsActive = true;

        console.log(filterSidebarButton.firstElementChild);
        filterSidebarButton.firstElementChild.classList.remove('fa-angle-right');
        filterSidebarButton.firstElementChild.classList.add('fa-angle-left');
    } else {
        filterSidebar.style.display = 'none';
        filterSidebar.style.width = '0';
        filterSidebarIsActive = false;
    }
});