<?php
$servername = "localhost:3306";
 
//username to connect to the db
//the default value is root
$username = "root";
 
//password to connect to the db
//this is the value you would have specified during installation of WAMP stack
$password = "AnushAn33laJ0ey";
 
//name of the db under which the table is created
$dbName = "CO2_emissions";
 
//establishing the connection to the db.
// $conn = new mysqli($servername, $username, $password, $dbName);
 
// //checking if there were any error during the last connection attempt
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
 
   $con = mysqli_connect($servername, $username, $password, $dbName);
   $result = mysqli_query($con, "SELECT * FROM dropped_data");
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
        'packages':['corechart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);
 
      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'CO2_emissions'],
 
         <?php
        //  $query = "SELECT * FROM dropped_data";
 
        //  //storing the result of the executed query
        //  $result = $conn->query($query);
         
        //  //initialize the array to store the processed data
        //  $jsonArray = array();
         
        //  //check if there is any data returned by the SQL Query
        //  if ($result->num_rows > 0) {
        //    //Converting the results into an associative array
        //    while($row = $result->fetch_assoc()) {
        //      $jsonArrayItem = array();
        //      $jsonArrayItem['Country'] = $row['Country'];
        //      $jsonArrayItem['CO2_emissions'] = $row['CO2_emissions'];
        //      //$jsonArrayItem['Year'] = $row['Year'];
         
        //      //append the above created object into the main array.
        //      array_push($jsonArray, $jsonArrayItem);
        //    }
        //  }
         
        //  //Closing the connection to DB
        //  $conn->close();

         if(mysqli_num_rows($result)> 0){
          if( $row['Year'] == "1990"){
          while($row = mysqli_fetch_array($result)){

              echo "['".$row['Country']."', '".$row['CO2_emissions']."'],";

          }
        }


      }

         
        //  //set the response content type as JSON
        //  header('Content-type: application/json');
        //  //output the return value of json encode using the echo function.
        //  echo json_encode($jsonArray);
        //  $sql = "SELECT * FROM `dropped_data`";
        //  $fire = mysqli_query($con,$sql);
        //   while ($result = mysqli_fetch_assoc($fire)) {
        //     echo"['".$result['Country']."',".$result['CO2_emissions']."],";
        //   }
 
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