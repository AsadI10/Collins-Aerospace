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
          <h1><?php echo $_SESSION["authtoken"];?></h1>
          <div id="map"></div>
          <script>
               var map = L.map('map').setView([51.505, -0.09], 13);

               L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
               maxZoom: 19,
               attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
               }).addTo(map);
          </script>
     </body>

</html>