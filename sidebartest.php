<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>sidebar page</title>

          <title>Collins Team One</title>
          <!--Leaflet-->
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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

          <!-- Use this for the sidebar For some reason the 0.4.1 package is taking 30 + seconds to load, Maybe depreciated? -->
          <!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> 
          <script src="https://unpkg.com/leaflet-sidebar-v2@0.4.1/js/leaflet-sidebar.min.js"></script>-->
          <!-- Our Stuff -->

          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="GetPage.js"></script>
          <script src="Sidebar.js"></script>
          <script src="./lib/map/wise-leaflet-pip.js"></script>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="sidebartest.js"></script>
          
</head>
<body>
<br>
<?php 
            include("./sidebarheader.php")
            ?>
<!-- Side Panel -->
<div class="piecharthistogram">
  <button>Histogram</button>
  <button>Piechart</button>
</div>
<span id="panel1" class="d-block p-2 bg-dark text-white">
</span>

<!-- Map -->
<div id="map"></div>
        <!-- Post page loading scripts -->
        <script type="text/javascript" src="Map_init.js"></script>
        <script type="text/javascript" src="Marker_init.js"></script>
        <script type="text/javascript" src="map.js"></script>
        
    <script type="text/javascript" src="map.js"></script>
</body>
</html>

<style>
  .piecharthistogram{
    position: relative;
    margin-left:1000px;
  }
  .testingbutton{
    border: solid black 2px;
    font-size: 19px;
    float: right;
    display: inline;
  }
  body{
    /* background-color: white; */
    background-color: white;
  }
    .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 200px;
  background-color: #f1f1f1;
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
</style>
