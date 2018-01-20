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

$sql = mysql_query("SELECT * FROM leavebalance WHERE User_Id = $loggedinuser");
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Leave Balance</title>
	<link rel="stylesheet" type="text/css" href="Requested_Leaves.css">
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
  <ul id = "menu">
  <li><a href="Reporting_Officer_Dashboard.php">Home</a></li>
  <li><a href="Reporting_Officer_Requested_Leaves.php">Requested Leaves</a></li>
  <li><a href="Reporting_Officer_My_Leaves.php">My Leaves</a></li>
  <li><a href="Reporting_Officer_Leave_Balance.php">My Leaves Balance</a></li>
  <li><a href="https://www.india.gov.in/calendar" target="Blank">Calendar</a></li>
  <li><a href="Reporting_Officer_Request_Leave.php">Request Leave</a></li>
  <li class="menu_right"><a href="Sign_Out.php">Sign Out</a></li>
  </ul>
<br>
	<h1>Leave Balance</h1>
	<br>
	<table class="data-table">
		<thead>
			<tr>
				<th>SNo</th>
				<th>User Name</th>
				<th>User Id</th>
				<th>Department</th>
				<th>Designation</th>
				<th>CL</th>
				<th>RH</th>
				<th>EL</th>
				<th>PL</th>
				<th>ML</th>
				<th>HPL</th>
				<th>CCL</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($row = mysql_fetch_array($sql))
			{
				echo '
				<tr>
				<td>'.$no.'</td>
				<td>'.$row['User_Name'].'</td>
				<td>'.$row['User_Id'].'</td>
				<td>'.$row['Department'].'</td>
				<td>'.$row['Designation'].'</td>
				<td>'.$row['CL'].'</td>
				<td>'.$row['RH'].'</td>
				<td>'.$row['EL'].'</td>
				<td>'.$row['PL'].'</td>
				<td>'.$row['ML'].'</td>
				<td>'.$row['HPL'].'</td>
				<td>'.$row['CCL'].'</td>
				</tr>';
				$no++;
			}
			?>
				
			</tbody>
		</table>
	</body>
	</html>