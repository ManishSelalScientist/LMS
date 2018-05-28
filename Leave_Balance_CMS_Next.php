<?php
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

$userid= $_POST['id'];
$cl= $_POST['cl'];
$rh= $_POST['rh'];
$el= $_POST['el'];
$pl= $_POST['pl'];
$ml= $_POST['ml'];
$hpl= $_POST['hpl'];
$ccl= $_POST['ccl'];
$ccl_no= $_POST['ccl_no'];

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql1 = "UPDATE leavebalance SET CL = '$cl', RH = '$rh', EL = '$el', PL = '$pl', ML = '$ml', HPL = '$hpl', CCL = '$ccl', CCL_NO = '$ccl_no' WHERE User_Id = '$userid'";

if (!mysql_query($sql1, $dbhandle))
  {
  die('Error: ' . mysql_error());
  }

//close the connection
mysql_close($dbhandle);

header("refresh:10;url=Leave_Balance_CMS.php");
echo "Leave balance updated!" . "<br />";
echo "CL : $cl" . "<br />";
echo "RH : $rh" . "<br />";
echo "EL : $el" . "<br />";
echo "PL : $pl" . "<br />";
echo "ML : $ml" . "<br />";
echo "HPL : $hpl" . "<br />";
echo "CCL : $ccl" . "<br />";
echo "CCL_NO : $ccl_no";
?>