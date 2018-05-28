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
$cmmdays = 2*$days;

$retval = mysql_query("SELECT * FROM leavebalance WHERE User_Id = $id ");
if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }

while ($row = mysql_fetch_array($retval)){
	$cl = $row['CL'];
    $rh = $row['RH'];
    $el = $row['EL'];
    $pl = $row['PL'];
    $ml = $row['ML'];
    $hpl = $row['HPL'];
    $ccl = $row['CCL'];
    $cclno = $row['CCL_NO'];
}

if ($decision == 'Reject') {

	    if($type == 'CL'){
        $temp = $cl + $days;
        $sql = "UPDATE leavebalance SET CL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'RH'){
        $temp = $rh + $days;
        $sql = "UPDATE leavebalance SET RH=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'EL'){
        $temp = $el + $days;
        $sql = "UPDATE leavebalance SET EL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'PL'){
        $temp = $pl + $days;
        $sql = "UPDATE leavebalance SET PL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'ML'){
        $temp = $ml + $days;
        $sql = "UPDATE leavebalance SET ML=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'HPL'){
        $temp = $hpl + $days;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'CCL'){
        $temp = $ccl + $days;
        $temp2 = $cclno + 1;
        $sql = "UPDATE leavebalance SET CCL=$temp, CCL_NO=$temp2 WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'CMM'){
        $temp = $hpl + $cmmdays;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        $sq1 = mysql_query("UPDATE leaves SET Status='Admin Canceled', U_Id = '' WHERE U_Id = $uids");
}
mysql_close($dbhandle);
header('Location:Requested_Leaves.php');
?>