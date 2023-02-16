//var userpoints = [];
// Set default position of map
var map = L.map('map',
    {
        maxBounds: [[-90, -180], [90, 180]],
        maxBoundsViscosity: 1.0,
        minZoom: 1
    }).setView([53.45043, -2.25975], 13);
// Create a layer group for markers
var markers = new L.LayerGroup().addTo(map);
// Create a layer group for any drawn polygons
var shapes = new L.LayerGroup().addTo(map);
// Create a layer group for any drawn footprint
var footprints = new L.LayerGroup().addTo(map);
//Polygon That has the bounds of the UK (allows us to calculate a coverage).
let ukBounds = [[50.52385324459923,1.2673593],[52.372888239740604,2.4182594295425133],[58.520067103791064,2.326563295380015],[59.35194725811601, -4.019833022964065],[58.209998162302526, -7.501579364708988],[52.93286365003604 ,-7.268946366193222],[49.326538909642494, -6.169537470707127]];
var ukPolygonMesh = L.polygon(ukBounds).addTo(map);

console.log(ukPolygonMesh);
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
// });
var StamenTerrain = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}{r}.{ext}', {
	attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	subdomains: 'abcd',
	minZoom: 0,
	maxZoom: 18,
	ext: 'png'
});
var EsriWorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  maxZoom: 18,
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);
var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
  maxZoom: 20,
  subdomains:['mt0','mt1','mt2','mt3']
 });
 var Stadia_AlidadeSmoothDark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
	maxZoom: 20,
	attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
});
//Trying to create a Leaflet layer control
var baseLayers = {
  "Bluemap": EsriWorldImagery,
  "Smooth Dark": Stadia_AlidadeSmoothDark
};
L.control.layers(baseLayers).addTo(map);