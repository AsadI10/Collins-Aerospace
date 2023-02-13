var userpoints = [];
var map = L.map('map').setView([53.45043, -2.25975], 13);
var markers = new L.LayerGroup().addTo(map);

var shapes = new L.LayerGroup().addTo(map);

//This add a scale to the map
L.control.scale().addTo(map);

document.getElementsByClassName('leaflet-control-attribution')[0].style.display = 'none';

var searchControl = new L.esri.Controls.Geosearch().addTo(map);

            var results = new L.LayerGroup().addTo(map);

              searchControl.on('results', function(data){
                results.clearLayers();
                for (var i = data.results.length - 1; i >= 0; i--) {
                  results.addLayer(L.marker(data.results[i].latlng));
                }
});

// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 18,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);
var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);