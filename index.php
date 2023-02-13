<!DOCTYPE html>
<?php
     require_once("APIInterface.php");
     require_once("CacheDB.php");
     session_start();

     // Initialize the caching database to cache API call results
     $_SESSION["CacheDB"] = new CacheDB("./Cache.db");
     // Initialize the APIInterface to communicate with the API
     $_SESSION["APIInterface"] = new APIInterface("https://hallam.sci-toolset.com", "hallam", "9JS(g8Zh");

     $apiFailureReason = $_SESSION["APIInterface"]->GetFailureReason();
     if($apiFailureReason != null){
        ?>
        <h1>APIInterface failed to initialize!</h1>
        <t><?php echo $apiFailureReason ?></t>
        <?php
          exit();
     }

     // The testing zone
     $testIdentifier = $_SESSION["APIInterface"]->GetAllProductIdentifiers()[0];
     $testProduct = ProductData::Load($testIdentifier);
     //var_dump($testProduct);
     //$_SESSION["APIInterface"]->echojson($testIdentifier);
     
     // Not the testing zone
?>

<html>
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
     <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand" href="">Home</a>
     </nav>
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

<<<<<<< HEAD
     <body oncontextmenu="return false;">

     
     <span id="panel1" class="d-block p-2 bg-dark text-white">
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable
        ([
          ['Task', 'Hours per Day'],
          ['',     11],
          ['',      200],
          ['',  245],
          ['', 276],
          ['',    76]
        ]);

        var options = 
        {
          chartArea: {width: 400, height: 300},
          backgroundColor: 'transparent',
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
     <div id="piechart" style="width: 300px; height: 100%;   "></div>
     </span>
     <div id="map">
          <script type="text/javascript" src="Map_init.js" ></script>
     </div>

     <span id="panel1" class="d-block p-2 bg-dark text-white"></span>
=======
     <body oncontextmenu="return false;"> 
     <!-- <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand" href="">Home</a>
          <a class="navbar-logout" href="">Logout</a>
          <a href=""></a>
     </nav> -->
     <h1 class="name">Collins Aerospace</h1>
     <nav>
          <ul>
               <li>Home</li>
               <li>Logout</li>
          </ul>
          <!-- <input class="searchbar" type="text" id="Name" name="Name" placeholder="Search"> -->
     </nav>
<br>
     <span id="panel1" class="d-block p-2 bg-dark text-white">
     </span>
>>>>>>> ebdba47df6495020f4d1f6bb1e1dab36e5d19e82

     <div id="map">
          <script type="text/javascript" src="Map_init.js" ></script>
     </div>
     <footer>
     <p class="copy">&copy; Created By <a class="Asad" href="https://www.shu.ac.uk/myhallam">Team 1 Sheffield Hallam University</a> |
            <script>document.write(new Date().getFullYear())</script> All rights reserved
        </p>
     </footer>
     
     <script type="text/javascript" src="map.js" ></script>

     </body>
</html>