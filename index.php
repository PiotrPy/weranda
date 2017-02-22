<?php
// settings
// host, user and password settings
$host = "localhost";
$user = "logger";
$password = "password";
$database = "temperatures";

//how many hours backwards do you want results to be shown in web page.
$hours = 12;

// make connection to database
$con = mysql_connect($host,$user,$password);
// select db
mysql_select_db($database,$con);

// sql command that selects all entires from current time and X hours backwards
$sql="SELECT * FROM temperaturedata WHERE dateandtime >= (NOW() - INTERVAL $hours HOUR) ORDER BY dateandtime DESC";

//NOTE: If you want to show all entries from current date in web page uncomment line below by removing //
//$sql="select * from temperaturedata where date(dateandtime) = curdate();";

// set query to variable
$temperatures = mysql_query($sql);

// create content to web-pagge
?>
<html>
<head>
<title>Temperatures</title>
</head>

<body>
</body>

<table width="600" border="1" cellpadding="1" cellspacing="1" align="center">
<tr>
<th>Date</th>
<th>Sensor</th>
<th>Temperature</th>
<th>Humidity</th>
<tr>
<?php
        // loop all the results that were read from database and "draw" to web page
        while($temperature=mysql_fetch_assoc($temperatures)){
                echo "<tr>";
                echo "<td>".$temperature['dateandtime']."</td>";
                echo "<td>".$temperature['sensor']."</td>";
                echo "<td>".$temperature['temperature']."</td>";
                echo "<td>".$temperature['humidity']."</td>";
                echo "<tr>";
        }
?>
</table>
</html>
