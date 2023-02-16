<?php
if(!isset($_POST["identifier"]) || $_POST["identifier"] == "")
{
	//exit();
}
$_POST["identifier"] = str_getcsv($_POST["identifier"]);

foreach($_POST["identifier"] as $product){
    echo $product;
    echo "<br>";
}
?>

<!-- Broken right now but we can pass CSV/array/JSON data into the piechart -->

<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>

