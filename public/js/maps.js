let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });
}

document.addEventListener('DOMContentLoaded', function() {
    let map2 = document.getElementById('map2');
    let myData = map2.dataset.sites;
    console.log(JSON.parse(myData));
});