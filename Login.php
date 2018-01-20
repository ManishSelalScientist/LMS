<?php
session_start();
?>

<?php
$_SESSION["userid"]= $_POST['id'];
$_SESSION["password"]= $_POST['password'];

?>

<?php 
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

$userid= $_POST['id'];
$password= $_POST['password'];

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$login = mysql_query("SELECT * FROM userinfo WHERE (User_Id = '$userid') and (Password = '$password')");

if (mysql_num_rows($login)) {
	if($userid== "123456")
		{
			mysql_close($dbhandle);
			header('Location:Admin_Dashboard.php');
		}
	else
		{
			while ($row = mysql_fetch_array($login)){
				$reportingtext = "'" .$row['User_Name']."'";
			}
			
			$row1 = mysql_query("SELECT * FROM leaves WHERE Reporting_Officer = $reportingtext");
			if(mysql_num_rows($row1)){
				mysql_close($dbhandle);
				header('Location:Reporting_Officer_Dashboard.php');	
			}
			else{
				mysql_close($dbhandle);
				header('Location:User_Dashboard.php');
			}
		}
	}
else
{
	mysql_close($dbhandle);
	header('Location:Login.html');
}
?>
