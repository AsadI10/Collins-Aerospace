<!DOCTYPE html>
<?php
session_start();
     require_once("Auth_token.php");
     require_once("Get_products.php");
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
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
          integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
          crossorigin=""></script>
          <style>
               #map {
                    position: relative;
                    border: 1px solid black;
                    border-radius: 8px;
                    height: 100vh;  /* or as desired */
                    width: 100%;  /* This means "100% of the width of its container", the .col-md-8 */
               }
          </style>
     </head>

     <body oncontextmenu="return false;">

     <nav class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="">Home</a>
     </nav>

     <div id="map">
          <script type="text/javascript" src="map.js"></script>
     </div>

     </body>

</html>