google.load('visualization', '1.0', { 'packages': ['corechart'] });
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
      total = 0;
    }

    // Clamp to maximum
    if (total > baseval)
        total = baseval;
    // Load the package and call the function as soon as possible to load the chart
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
            position: "absolute",
            chartArea: { height: '500', left: 0, right: 0, top: 10, bottom: 0 },
            legend: { position: 'none' },
            colors: ['#bac9b9', '#Ff0000']
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(data, options);
    }
}