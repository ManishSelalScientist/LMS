<?php
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

$user= $_POST['name'];
$userid= $_POST['id'];
$designation= $_POST['designation'];
$department= $_POST['department'];
$email= $_POST['email'];
$password= $_POST['password'];
$reporting= $_POST['reporting'];

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql = "INSERT INTO userinfo (User_Name, User_Id, Designation, Department, Email, Password, Reporting_Officer)
        VALUES ('$user', '$userid', '$designation', '$department', '$email', '$password', '$reporting')";

if (!mysql_query($sql, $dbhandle))
  {
  die('Error: ' . mysql_error());
  }

$sql1 = "INSERT INTO leavebalance (User_Name, User_Id, Department, Designation, CL, RH, EL, PL, ML, HPL, CCL)
        VALUES ('$user', '$userid', '$department', '$designation', '8', '2', '15', '15', '180', '10', '730')";

if (!mysql_query($sql1, $dbhandle))
  {
  die('Error: ' . mysql_error());
  }

//close the connection
mysql_close($dbhandle);

header("refresh:10;url=Login.html");
echo "New Account Created" . "<br />";
echo "User Name : $user" . "<br />";
echo "User Id : $userid" . "<br />";
echo "Designation : $designation" . "<br />";
echo "Department : $department" . "<br />";
echo "Email : $email" . "<br />";
echo "Reporting Officer : $reporting" . "<br />"; 

?>