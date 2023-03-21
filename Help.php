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

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <title>Collins Team One</title>
          <!--Leaflet-->
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <!-- <link rel="stylesheet" href="CSS/index.css"/> -->
          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
          integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
          crossorigin=""></script>
          <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <!-- use this to get the search bar -->
          <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
          <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
          <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

          <!-- Use this for the sidebar For some reason the 0.4.1 package is taking 30 + seconds to load, Maybe depreciated? -->
          <!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> 
          <script src="https://unpkg.com/leaflet-sidebar-v2@0.4.1/js/leaflet-sidebar.min.js"></script>-->
          <!-- Our Stuff -->

              <!-- Leaflet.draw main plug in files -->
              <link rel="stylesheet" href="./lib/map/leaflet.draw.css" /> <!--add here-->
              <script src="./lib/map/leaflet.draw.js"></script>

          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="GetPage.js"></script>
          <script src="Sidebar.js"></script>
          <script src="./lib/map/wise-leaflet-pip.js"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script src="Charts.js"></script>
          <script src="CalculatePolygonArea.js"></script>
          <script src="index.js"></script>
        
</head>
<body>
<br>
<?php include("./PageHeader.php")?>

<p>
Welcome to SHU-Discovery, an instance of SCI-Discovery developed by Collins-Aerospace.
This Project has been developed by 5 students at sheffield hallam university over the span of 12
weeks in order to demonstrate our ability to create a profesional application.
</p>
<br>

<div class="Dropmenu">
  <details open>
  <summary><u><b>How do I change the map view?</b></u></summary>
    <p>
      Navbar directs user to three different directories index page, help page, and logout.
      To access index page user can click on the home page which will be the main page.
      Help will direct user to help page if the user need access to any guidence.
      Finally to logout click logout it will direct out main login page.
    </p>
    <img class="Map-layers" src="img/Map-Views.gif">
  </details>
  <details open>
    <summary><u><b>How do I get the details from a marker?</b></u></summary>
    <p>
    If you want to view the details of a single marker then you just need to left click it and it will
    appear on the sidebar. Once its in the sidebar you can see simple details about the marker,
    to view all the JSON it contains you can click "Details".
    </p>
    <img class="Map-layers" src="img/Marker-view-details.gif">
    <p>
    <br>
    To select multiple markers you can shift + left click in order to drag a box over markers. This will
    then put the markers into the sidebar.
    </p>
    <img class="Map-layers" src="img/2023-03-14 10-08-04.gif">
  </details>
  <details open>
    <summary><u><b>How does the pie chart update?</b></u></summary>
    <p>
    The pie chart represents the coverage of the markers landmass in comparison with the landmass the user
    can see in the maps view. It is calculated by aggregating all the footprints on-screen (taking into
    consideration overlapping of footprints).
    </p>
    <img class="Map-layers" src="img/Zoom_in_out.gif">
  </details>
  <details open>
    <summary><u><b>How do I search for a location?</b></u></summary>
    <p>
    To search for a specific location you can click the magnifying glass icon, underneeth the zoom in and
    zoom out. You can search for any city/country and the map will redirect your view to that area, along
    with placing a temporary marker in that location.
    </p>   
    <img class="Map-layers" src="img/Search-GIF.gif">  
  </details>
  <details open>
    <summary><u><b>What does the red box represent under the markers?</b></u></summary>
    <p>
    The red box that appears when you hover over a marker represents the "footprint" of the marker. The footprint
    is drawn based on the GeoJSON given in the metadata.
    </p>
  </details>

</div>
<br>
</body>
</html>

<style>
  p{
    font-family: 'Poppins', sens-serif;
    font-size: 16px;
    padding: 6px;
  }
  .Map-layers{
    width:100%;
    display:block;
    margin-left:auto;
    margin-right:auto;
    cursor:pointer
  }
  body{
    /* background-color: white; */
    background-color: white;
    position: center;
    overflow-x: hidden;
	  overflow-y: auto;
	  text-align:justify;
    margin-top: -6px;
  }
  nav{
    text-align: right;
    overflow: hidden;
    position: relative;
    margin-top: -42px;
    padding-right: 15px;
}
nav ul li{
    display: inline;
    font-size: 17px;
    color: black;
    padding:100px 10px 10px; 
    padding: 5px 16px;
    font-weight: bold;
    font-family: 'Courier New', Courier, monospace; 
    cursor: pointer;
}
    .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 200px;
  background-color: #242424;
  /* background-color: black; */
  z-index: 1;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}
.sidebar-toggle {
  font-weight: bold;
  position: absolute;
  top: 0;
  /* right: -50px; */
  right: 0px;
  background-color: #333;
  color: #fff;
  padding: 10px 15px;
  border: none;
  outline: none;
  cursor: pointer;
  z-index: 2;
}
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.sidebar li a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: #000;
}
.sidebar li a:hover {
  background-color: #ddd;
}
.content {
  margin-left: 200px;
  padding: 20px;
}
.box {
  background-color: black;
  width: 250px;
  border: 15px lightgrey;
  padding: 50px;
  margin: 20px;
}
.Dropmenu{
  border: solid 3px grey;
  /* width: 100%; */
  padding-left: 2px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 98%;
  padding:3px;
}
</style>
