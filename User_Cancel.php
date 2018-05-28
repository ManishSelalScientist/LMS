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

$decision = $_GET["decision"];
$id = $_GET["id"];
$uid = $_GET["uid"];
$type = $_GET["type"];
$days = $_GET["days"];
$status = $_GET["status"];
$uids = "'" .$uid. "'";

$retval = mysql_query("SELECT * FROM leavebalance WHERE User_Id = $id ");
if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }

if ($decision == 'Reject') {
    $sq1 = mysql_query("UPDATE leaves SET Status='Canceled', U_Id = '' WHERE U_Id = $uids");
}
mysql_close($dbhandle);
header('Location:User_My_Leaves.php');
?>