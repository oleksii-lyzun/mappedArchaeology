let map;
const SITES = JSON.parse(document.getElementById('map').dataset.sites);

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.471705, lng: 31.472399},
        zoom: 6.3
    });

    for(let i = 0; i < SITES.length; i++)
    {
        let geoCoordinates = {lat: parseFloat(SITES[i].getLatitude), lng: parseFloat(SITES[i].getLongitude)};
        let marker = new google.maps.Marker({position: geoCoordinates, map: map});
        marker.addListener('click', function () {
            document.getElementById('siteInfo').style.display = 'block';
        });
    }
}