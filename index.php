<!DOCTYPE html>
<html>
     <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title>Collins Team One</title>
               <!--Leaflet-->
               <link rel="stylesheet" href="lib/map/leaflet.css">
               <script src="lib/map/leaflet.js"></script>
               <style type="text/css">
                    #map{ height: 400px;}
               </style>
     </head>

     <body>
          <div id="map"></div>
          <script>
               var map = L.map('map').setView([51.505, -0.09], 13);
          </script>
     </body>

</html>