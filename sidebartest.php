<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/lib/map/wise-leaflet-pip.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>sidebar page</title>
</head>
<body>

    <div class="sidebar">
        <button class="sidebar-toggle">Toggle Sidebar</button>
        <ul>
            <li><a href="#">Menu Item 1 home</a></li>
            <li><a href="#">Menu Item 2 histogram</a></li>
            <li><a href="#">Menu Item 3 piechart</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Collins Aerospace</h1>
        <p>the map needs to go here</p>
    </div>

    <script type="text/javascript" src="map.js"></script>

    <script type="text/javascript" src="sidebartest.js"></script>

</body>

    
</body>
</html>

<style>
    .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 200px;
  background-color: #f1f1f1;
  z-index: 1;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar-toggle {
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
