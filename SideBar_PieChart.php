
     <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Task', 'Hours per Day'],
          ['Plane', 11],
          ['Jet', 2],
          ['Military', 2],
          ['Random', 2],
          ['On ground', 7]
        ]);

        var options = {
          backgroundColor: 'transparent',
          is3D: true,
          'width':400,
          'height':300,
          'title' : 'My Chart'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    
    </span>