<!DOCTYPE html>
<?php
require("Auth_token.php");
?>
<html>
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Collins Team One</title>
          <!--Leaflet-->
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
          <link rel="stylesheet" href="CSS/index.css"/>
          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
          integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
          crossorigin=""></script>
          <style type="text/css">
               #map {
                    overflow: auto;
                    height: 1080px;
               }
          </style>
     </head>

     <body>
     <nav class="CollinsNav">
        <h2>Collins</h2>
        <ul>
            <li>Menu</li>
            <li>Logout</li>
        </ul>
    </nav>
          <div id="map"></div>
          <script>
               var points = [];

               var map = L.map('map').setView([53.45043, -2.25975], 13);

               L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
               maxZoom: 19,
               attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
               }).addTo(map);

function onMapClick(e) {
     points.push(e.latlng);
     L.marker(e.latlng).addTo(map);
}
map.on('click', onMapClick);

window.oncontextmenu = function () {
  var polygon = L.polygon(points).addTo(map);
  points = [];
}
          </script>
     </body>

</html>