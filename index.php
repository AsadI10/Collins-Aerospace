<!DOCTYPE html>
<?php
    //===================================================================
    // This section will initialize primary session variables such as the API connection and database connection
    require_once("./APIInterface.php");
    require_once("./CacheDB.php");
    require_once("./SessionMaster.php");

    // Initialize the caching database to cache API call results
    $_SESSION["CacheDB"] = new CacheDB($_SERVER["DOCUMENT_ROOT"]."/Cache.db");
    // Initialize the APIInterface to communicate with the API
    $_SESSION["APIInterface"] = new APIInterface("https://hallam.sci-toolset.com", "hallam", "9JS(g8Zh");

    // The testing zone
    //$testIdentifier = $_SESSION["APIInterface"]->GetAllProductIdentifiers()[0];
    //$testProduct = ProductData::Load($testIdentifier);
    //var_dump($testProduct);

    //$_SESSION["APIInterface"]->echojson($testIdentifier);
     
    // Not the testing zone
?>

<html>
     <head>
          <title>Collins Team One</title>
          <!--Leaflet-->
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <link rel="stylesheet" href="CSS/index.css"/>
          <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
          integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
          crossorigin=""></script>
          <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <!-- use this to get the search bar -->
          <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
          <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
          <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
          <!-- Our Stuff -->
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="GetPage.js"></script>
          <script src="Sidebar.js"></script>
          <script src="./lib/map/wise-leaflet-pip.js"></script>
     </head>

    <body>
        <!-- Header -->
        <?php
            include("./Header.php")
        ?>

        <!-- Side Panel -->
        <span id="panel1" class="d-block p-2 bg-dark text-white"></span>
  
        <!-- Map -->
        <div id="map">
          <!-- create a sidebar on the map -->
          
        </div>


        <br>
        <!-- Footer -->
        <?php
            include("./Footer.php");
        ?>
     
        <!-- Post page loading scripts -->
        <script type="text/javascript" src="Map_init.js"></script>
        <script type="text/javascript" src="Marker_init.js"></script>
        <script type="text/javascript" src="map.js"></script>
        <script>
            // Default load of sidebar
            GetWebPage("SideBar/SideBar_PieChart.php", function(text){
                LoadSidebar(text);
                }
            );
        </script>

     </body>
</html>