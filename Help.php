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

<ul>
  <li>Login</li>
  <li>interactable nav bar with some options</li>
  <li>Press on the stalite icon</li>
  <li>press shift for polygon</li>
  <li>Zoom in and out of the map</li>
  <li>use the side panal for the information</li>
  <li>pie chart for the coverage</li>
</ul>
<br>

<div class="Dropmenu">
  <details>
    <summary>Login</summary>
    <p>
    <p><u>Login</u></p>
      To access website please enter your login details with your username and password. 
       Ensure that the user has logged in before accessing the map. 
       Once logged in it will direct you to index page with the map as your main veiw.  
    </p>
  </details>
  <details>
  <summary>Navbar</summary>
    <p>
      <p><u>Navbar</u></p>
      Navbar directs user to three different directories index page, help page, and logout.
      To access index page user can click on the home page which will be the main page.
      Help will direct user to help page if the user need access to any guidence.
      Finally to logout click logout it will direct out main login page.
  
    </p>
  </details>
  <details>
    <summary>The Map</summary>
    <p>
    <p><u>The Map</u></p>
      Map is a interactable and main part of the software which allows user to view.Location
      and interact with collection of markers. Markers is product which contains all the data such as 
      calculating the footprint area. 
    </p>
    <!-- <img src="https://media.discordapp.net/attachments/1064835577310089289/1082683496721567814/ezgif.com-optimize.gif?width=807&height=586" width="40%"> -->
  </details>
  <details>
    <summary>Icon</summary>
    <p>
    <p><u>Map view </u></p>
       Users have varities of map views such as Bluemap, Smooth Dark, Bright map, and Satelite map. 
       The map has different view because, it is responsive and adaptive.
    </p>
    <img class="Map-layers" src="img/Map-Views.gif">
    <p>
    <p><u>Zoom in and out </u></p>
       Zoom in and out features are available for the users. This is located on the top left corner. 
       Plus + is to zoom in minus - is to zoom out. 
    </p>
    <img class="Zoom-in" src="img/Zoom_in_out.gif">
     <p>
      <p><u>Search bar </u></p>
       Other features include search icon which allows you to manually write the location of user desired
       location. To use this click on the search engine, write the location of where you want to go.  
       Note be specific to where you want to go because, there might be more than one location with the same name.  
     </p>   
     <img class="search-bar" src="img/Search-GIF.gif">  
  </details>

</div>
<br>
</body>
</html>

<style>
  .Zoom-in{
    width:35%;
    display:block;
    margin-left:auto;
    margin-right:auto;
    cursor:pointer;
  }
  p{
    font-family: 'Poppins', sens-serif;
    font-size: 16px; 
  }
  .Map-layers{
    width:35%;
    display:block;
    margin-left:auto;
    margin-right:auto;
    cursor:pointer
  }
  .search-bar{
    width:35%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    cursor:pointer;
  }
  body{
    /* background-color: white; */
    background-color: white;
     /* float: center; */
    position: center;
    overflow-x: hidden;
	  overflow-y: auto;
	  text-align:justify;
    margin-top: -6px;
  }
  /* added nav  */
  nav{
    text-align: right;
    overflow: hidden;
    /* margin-top: -20px; */
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
  width: 55%;
  /* margin-left: 2px; */
  padding-left: 2px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
  padding:3px;
}

</style>
