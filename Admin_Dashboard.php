<?php
session_start();
?>

<?php
$loggedinuser = $_SESSION["userid"];
if(!isset($loggedinuser)) // not logged in
{  
        header('Location: Login.php');
        exit();
}
?>

<?php
function _e($string){
    echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    //echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}
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
    <meta charset="UTF-8">
	<title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
	<ul id = "menu">
		<li><a href="Admin_Dashboard.php">Home</a></li>
		<li><a class="drop">Admin</a>
			<div class="dropdown_Admin">
				<div class="col_1">
					<p><a href="List_Users.php" >Users</a></p>
                </div>
                <div class="col_2">
                    <p><a href="Create.html">Create</a></p>
                </div>
                <div class="col_3">
                    <p><a href="Leave_Balance.php">Leave Balance</a></p>
                </div>
			</div>
		</li>
    	<li><a class="drop">HR Admin</a>
    		<div class="dropdown_HR_Admin">
				<div class="col_1">
					<p><a href="Leave_Balance_CMS.php">Leave Balance Update</a></p>
                </div>
                <div class="col_2">
                    <p><a href="#">Link2</a></p>
                </div>
                <div class="col_3">
                    <p><a href="#">Link3</a></p>
                </div>    			
        </li>
        <li><a href="Requested_Leaves.php">Approved Leaves</a></li>
        <li><a href="Admin_My_Leaves.php">My Leaves</a></li>
		<li><a href="https://www.india.gov.in/calendar" target="Blank">Calendar</a></li>
		<li><a href="Admin_Request_Leave.php">Request Leave</a></li>
		<li class="menu_right"><a href="Sign_Out.php">Sign Out</a></li>
	</ul>
<br>
<p><b><?php _e('Leave Management System!')?></b></p>
<p><?php _e("This is Admin's Dashboard, From here Admin can navigate through whole application.")?></p>

<?php
while ($row = mysql_fetch_array($sql)){
echo "User Name   -" .$row['User_Name'] . "<br />";	
echo "User Id     -" .$row['User_Id'] . "<br />";
echo "Department  -" .$row['Department'] . "<br />";
echo "Designation -" .$row['Designation'] . "<br />";
}
?>
	</body>
</html>


