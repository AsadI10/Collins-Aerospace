/*
AJAX REQUEST TO TRY AND GET THE ECHO'D OUT DATA FROM Fetch_Data.php
*/
fetch('Fetch_data.php')
.then(function(response){
     return response.json();
}).then(function(data){
     alert(data);
});

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