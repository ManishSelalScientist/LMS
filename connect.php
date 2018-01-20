<?php  $username = "root";
$password = "";
$hostname = "localhost:3388"; 

$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

$selected = mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");
echo "database selected";



mysql_close($dbhandle);
?>