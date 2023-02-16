//=====================================
//Functions to be called to draw charts
//=====================================

function loadPieChart(data){
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart(data));
      function drawChart(data) {
        console.log(data.length);
        var data = google.visualization.arrayToDataTable([
          ['Uncovered', 'Viewable coverage'],
          ['Uncovered', data[0] - (data.length - 1)],
          ['Covered', (data.length - 1)]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('panel1'));
        chart.draw(data, options);
      }
}

function loadHistogram(data){
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Dinosaur', 'Length'],
        ['Acrocanthosaurus (top-spined lizard)', 12.2],
        ['Albertosaurus (Alberta lizard)', 9.1],
        ['Allosaurus (other lizard)', 12.2],
        ['Apatosaurus (deceptive lizard)', 22.9],
        ['Archaeopteryx (ancient wing)', 0.9],
        ['Argentinosaurus (Argentina lizard)', 36.6]]);

      var options = {
        title: 'Lengths of dinosaurs, in meters',
        legend: { position: 'none' },
      };

      var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
}