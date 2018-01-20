<?php
session_start();
?>

<?php
$loggedinuser = $_SESSION["userid"];
?>

<?php 
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql = mysql_query("SELECT * FROM userinfo WHERE User_Id = $loggedinuser");
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
  <ul id = "menu">
    <li><a href="User_Dashboard.php">Home</a></li>
    <li><a href="User_My_Leaves.php">My Leaves</a></li>
    <li><a href="User_Leave_Balance.php">My Leaves Balance</a></li>
    <li><a href="https://www.india.gov.in/calendar" target="Blank">Calendar</a></li>
    <li ><a href="User_Request_Leave.php">Request Leave</a></li>
    <li class="menu_right"><a href="Sign_Out.php">Sign Out</a></li>
  </ul>
<br>
<p><b>Leave Management System!</b></p>
<p>This is your Dashboard, From here you can navigate through whole application.</p>

<?php
while ($row = mysql_fetch_array($sql)){
echo "User Name   -" .$row['User_Name'] . "<br />";	
echo "User Id     -" .$row['User_Id'] . "<br />";
echo "Department  -" .$row['Department'] . "<br />";
echo "Designation -" .$row['Designation'] . "<br />";
}
mysql_close($dbhandle);
?>
	</body>
</html>


