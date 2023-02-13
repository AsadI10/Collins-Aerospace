class Map{

    constructor(){
        //var userpoints = [];
        var map = L.map('map').setView([53.45043, -2.25975], 13);
        var markers = new L.LayerGroup().addTo(map);
        document.getElementsByClassName('leaflet-control-attribution')[0].style.display = 'none';

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    }

}