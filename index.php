<!DOCTYPE html>
<?php
     require_once("APIInterface.php");
     require_once("CacheDB.php");
     session_start();

     $_SESSION["CacheDB"] = new CacheDB();
     $_SESSION["APIInterface"] = new APIInterface("https://hallam.sci-toolset.com", "hallam", "9JS(g8Zh");

     // The testing zone
     $testIdentifier = $_SESSION["APIInterface"]->GetAllProductIdentifiers()[0];
     //$_SESSION["APIInterface"]->echojson($testIdentifier);
     
     // Not the testing zone
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
          <link rel="stylesheet" href="CSS/index.css"/>
          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
          integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
          crossorigin=""></script>
          <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
     </head>

     <body oncontextmenu="return false;"> 

     <h1 class="name">Collins Aerospace</h1>
     <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand" href="">Home</a>
          <a class="navbar-logout" href="">Logout</a>
     </nav>

     <span id="panel1" class="d-block p-2 bg-dark text-white">
     </span>

     <div id="map">
          <script type="text/javascript" src="Map_init.js" ></script>
     </div>
     <br> 
     <footer>
     <p class="copy">&copy; Created By <a class="Asad" href="https://www.shu.ac.uk/myhallam">Team 1 Sheffield Hallam University</a> |
            <script>document.write(new Date().getFullYear())</script> All rights reserved
        </p>
     </footer>
     
     <script type="text/javascript" src="map.js" ></script>

     </body>
</html>