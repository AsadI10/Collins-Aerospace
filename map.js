var points = [];

var data = document.getElementById("helper").getAttribute("data-name");

var map = L.map('map').setView([53.45043, -2.25975], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

function onMapClick(e) {
    points.push(e.latlng);
    L.marker(e.latlng).addTo(map);
}

function oncontextmenu(e) {
    var polygon;
    polygon = L.polygon(points).addTo(map);
    points = [];
}

map.on('contextmenu', oncontextmenu);
map.on('click', onMapClick);