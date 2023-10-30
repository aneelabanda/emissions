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
   $query = "SELECT * FROM `merged_data`";
   $result = mysqli_query($con, $query);
  //  if($con){
  //    echo "connected";
  //  }
  //  if (!$con) {
  //   die("Connection failed: " . mysqli_connect_error());
  //   }
   

   if(isset($_POST['submit']))
    {
        // Store the Product name in a "name" variable
        $year = mysqli_real_escape_string($con,$_POST['Year']);
        
         echo `$year`;
        // Store the Category ID in a "id" variable      
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $query = "SELECT * FROM `merged_data` WHERE Year = $year";
        $result1 = mysqli_query($con, $query);
        if (!$result1) {
          die("Query failed: " . mysqli_error($con));
         }
          // The following code attempts to execute the SQL query
          // if the query executes with no errors 
          // a javascript alert message is displayed
          // which says the data is inserted successfully
        //   if(mysqli_query($con,$result1))
        // {
        //     echo '<script>alert("Product added successfully")</script>';
        // }
    }
?>

<!-- // Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve data
$query = "SELECT * FROM `dropped_data` WHERE Year = 1990";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }
}
</script> -->
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'CO2_emissions'],
          <?php
          // Loop through the data and format it as JavaScript array elements
          while ($row = mysqli_fetch_assoc($result1)) {
              echo "['" . $row['Country'] . "', " . $row['CO2_emissions'] . "],";
          }
          ?>
        ]);

        var options = {};

        var chart = new google.visualization.(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
    <!-- <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);
 
      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'CO2_emissions'],
 
        // ?php
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

         //if(mysqli_num_rows($result)> 0){

          
          //while($row = mysqli_fetch_array($result)){

            //  echo "['".$row['Country']."', '".$row['CO2_emissions']."'],";

          //}
        //}


      

         
        //  //set the response content type as JSON
        //  header('Content-type: application/json');
        //  //output the return value of json encode using the echo function.
        //  echo json_encode($jsonArray);
        //  $sql = "SELECT * FROM `dropped_data`";
        //  $fire = mysqli_query($con,$sql);
        //   while ($result = mysqli_fetch_assoc($fire)) {
        //     echo"['".$result['Country']."',".$result['CO2_emissions']."],";
        //   }
 
         //?>
        ]);
        var options = {};
 
        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
 
        chart.draw(data, options);
      }
    </script> -->
</head>
<body>
    <header id="header"><div class="inner">
        <a href="index.html" class="logo"><strong>CO2 Emission</strong>Tracking</a>
        <nav id="nav"><a href="index.html">Home</a>
            <a href="visualize.php">Visualize</a>
            <a href="health.php">Correlate with health</a>
        </nav><a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
    </div>
<div>
    <form method="POST">
      <div class="flex-container">
  <select name="Year" id="Year" placeholder="Choose a Year">
  <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option>
  </select>
  <select name="Country" id="Country" placeholder="Choose a Country">
  <!-- <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option> -->
  </select>
  <select name="HealthIssue" id="HealthIssue" placeholder="Choose an Issue">
  <!-- <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option> -->
  </select>
  <input type="submit" value="Submit" name="submit"></div>
</form>
    </div>
    <div id="regions_div"></div>
</header>
</body>
</html>