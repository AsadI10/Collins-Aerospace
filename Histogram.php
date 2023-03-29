<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="GetPage.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Identifier');
        data.addColumn('date', 'Date Created');
        var products;
        GetWebPage("Fetch_product_data.php", function (text) { products = JSON.parse(text) });
        for(var i = 0; i < products.length; i++){
            var date = new Date(1970, 0, 1);
            date.setSeconds(products[i]["DateCreated"]);
            console.log(date);
            data.addRow([products[i]["Identifier"], date]);
        }

        var options =
         {
            title: 'Data Creation Dates',
            legend: {  position: 'top', maxLines: 2 },
        
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
<?php
?>


