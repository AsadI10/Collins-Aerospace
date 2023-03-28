//=====================================
//Functions to be called to draw charts
//=====================================

//base val is in M^2 (that being the total M^2 of the UK)
function loadPieChart(data){
  //gets the bounds of the current users Map view...
    let bounds = map.getBounds();
    let boundsarr = [
      [bounds.getNorthEast().lat, bounds.getNorthEast().lng],
      [bounds.getNorthWest().lat, bounds.getNorthWest().lng],
      [bounds.getSouthWest().lat, bounds.getSouthWest().lng],
      [bounds.getSouthEast().lat, bounds.getSouthWest().lng]
    ];
    baseval = calculateArea(boundsarr) / 1000000;

    let total;
    try{
    //gets the aggregate area of each marker the user can see
        total = data.reduce(function(a, b){
        return a + b;
      });
    }catch(error){
      total = baseval;
    }

    // Clamp to maximum
    if (total > baseval)
        total = baseval;

    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart(data));
      function drawChart(data) {
        var data = google.visualization.arrayToDataTable([
          ['Uncovered', 'Viewable coverage'],
          ['Uncovered', baseval - total],
          ['Covered', total]
        ]);

        var options = {
          backgroundColor: 'transparent',
          position:"absolute",
          chartArea: { height: '500', left: 0, right: 0, top: 10, bottom: 0 },
          legend: { position: 'none'},
          // colors: ['#333333', '#242424']
          colors: ['#bac9b9', '#Ff0000']
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(data, options);
      }
}

/*
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
  */