<?php
if(!isset($_POST["identifier"]) || $_POST["identifier"] == "")
{
	exit();
}
$_POST["identifier"] = str_getcsv($_POST["identifier"]);

?>


<!-- Broken right now but we can pass CSV/array/JSON data into the piechart -->

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['marker', '<?php var_dump($_POST["identifier"][0]);?>']
        ]);

        var options = {
          backgroundColor: 'transparent',
          title: 'Collins Data',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 350px; height: 240px;"></div>
  </body>
</html>