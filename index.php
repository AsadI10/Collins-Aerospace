<!DOCTYPE html>
<?php
    //===================================================================
    // This section will initialize primary session variables such as the API connection and database connection
    require_once("./APIInterface.php");
    require_once("./CacheDB.php");
    require_once("./SessionMaster.php");

    // Initialize the caching database to cache API call results
    if(!isset($_SESSION["CacheDB"])){
        $_SESSION["CacheDB"] = new CacheDB("./Cache.db");
    }
    // Initialize the APIInterface to communicate with the API
    if(!isset($_SESSION["APIInterface"]) || $_SESSION["APIInterface"]->IsLoggedIn() == false){
        if(!isset($_POST["Username"]) || !isset($_POST["Password"])){
            header("Location: ./Login.php");
        }
        else{
            $_SESSION["APIInterface"] = new APIInterface("https://hallam.sci-toolset.com", $_POST["Username"], $_POST["Password"]);
        }
    }

    // Initialize the caching database to cache API call results
    if(!isset($_SESSION["CacheDB"])){
        $_SESSION["CacheDB"] = new CacheDB("./Cache.db");
    }

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
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
          <link rel="stylesheet" href="https://unpkg.com/leaflet-sidebar-v2@0.4.1/css/leaflet-sidebar.min.css" />
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
          <!-- Use this for the sidebar -->
          <!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> -->
          <script src="https://unpkg.com/leaflet-sidebar-v2@0.4.1/js/leaflet-sidebar.min.js"></script>
          <!-- Our Stuff -->
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="GetPage.js"></script>
          <script src="Sidebar.js"></script>
          <script src="./lib/map/wise-leaflet-pip.js"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     </head>

    <body>
        <!-- Header -->
        <?php
            include("./Header.php")
        ?>

        <!-- Side Panel -->
        <span id="panel1" class="d-block p-2 bg-dark text-white">
        </span>
  
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
            GetWebPage("SideBar_PieChart.php", function(text){
                console.log(text);
                LoadSidebar(text);
                }
            );

            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]);

            var options = {
               backgroundColor: 'transparent',
               title: 'Collins Data',
               is3D: true,
               chartArea: {
               width: '70%',
               height: '70%'
          }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
            }
        </script>

     </body>
</html>