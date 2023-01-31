<!DOCTYPE html>
<?php
session_start();
     require("Auth_token.php");
     require("Get_products.php");
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
     </head>

     <body oncontextmenu="return false;">
     <nav class="CollinsNav">
        <h2>Collins</h2>
        <ul>
            <li>Menu</li>
            <li>Logout</li>
        </ul>
    </nav>

     <div id="map"></div>

     <script type="text/javascript" src="map.js"></script>

     <!--
     <script>
          var points = [];
          var map = L.map('map').setView([53.45043, -2.25975], 13);

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
     </script>
     -->
     </body>

</html>