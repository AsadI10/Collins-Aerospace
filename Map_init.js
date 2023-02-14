var userpoints = [];
// Set default position of map
var map = L.map('map').setView([53.45043, -2.25975], 13);
// Create a layer group for markers
var markers = new L.LayerGroup().addTo(map);

// Create a layer group for any drawn polygons
var shapes = new L.LayerGroup().addTo(map);

var greenIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
//This add a scale to the map
L.control.scale().addTo(map);

document.getElementsByClassName('leaflet-control-attribution')[0].style.display = 'none';

//Used for search control
var searchControl = new L.esri.Controls.Geosearch().addTo(map);
// Create new layer group for search results
var results = new L.LayerGroup().addTo(map);
searchControl.on('results', function(data){
    results.clearLayers();
    // Add every result of the search to the group
    for (var i = data.results.length - 1; i >= 0; i--) {
        results.addLayer(L.marker(data.results[i].latlng));
        }
});

// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 18,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);

var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  maxZoom: 18,
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);