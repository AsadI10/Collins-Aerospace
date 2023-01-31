/*
AJAX REQUEST TO TRY AND GET THE ECHOD OUT DATA FROM Fetch_Data.php
*/
let data = fetch('Fetch_data.php');

document.write(data);

var points = [];
var map = L.map('map').setView([53.45043, -2.25975], 13);

console.log(Error);

document.getElementsByClassName( 'leaflet-control-attribution' )[0].style.display = 'none';

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 18,
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

          function loadProducts(){
          }

          loadProducts();
          map.on('contextmenu', oncontextmenu);
          map.on('click', onMapClick);