<?php
  $con = mysqli_connect("localhost","root","AnushAn33laJ0ey","CO2_emissions");
  if($con){
    echo "connected";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'CO2_emissions'],
         <?php
         $sql = "SELECT * FROM `dropped_data`";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Country']."',".$result['CO2_emissions']."],";
          }

         ?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <header id="header"><div class="inner">
        <a href="index.html" class="logo"><strong>CO2 Emission</strong>Tracking</a>
        <nav id="nav"><a href="index.html">Home</a>
            <a href="visualize.html">Visualize</a>
            <!--<a href="elements.html">Elements</a>-->
        </nav><a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
    </div>
    <div id="regions_div" style="width: 900px; height: 500px;"></div>
</header>
</body>
</html>

