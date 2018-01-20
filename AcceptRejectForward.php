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
$forward = mysql_query("SELECT * FROM userinfo WHERE User_Id = $loggedinuser");
while ($forwardrow = mysql_fetch_array($forward)){
    $forwardreporting = "'" .$forwardrow['Reporting_Officer']. "'";
    $forwardreporting2 = $forwardrow['Reporting_Officer'];
}

if ($decision == 'Approve' && $status == 'Pending' && $forwardreporting2 == 'FINAL'){
    while ($row = mysql_fetch_array($retval)){
        $cl = $row['CL'];
        $rh = $row['RH'];
        $el = $row['EL'];
        $pl = $row['PL'];
        $ml = $row['ML'];
        $hpl = $row['HPL'];
        $ccl = $row['CCL'];
    }

    if($type == 'CL' && $cl!=0 && $cl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $cl - $days;
        $sql = "UPDATE leavebalance SET CL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'RH' && $rh!=0 && $rh >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $rh - $days;
        $sql = "UPDATE leavebalance SET RH=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'EL' && $el!=0 && $el >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $el - $days;
        $sql = "UPDATE leavebalance SET EL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'PL' && $pl!=0 && $pl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $pl - $days;
        $sql = "UPDATE leavebalance SET PL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

    elseif($type == 'ML' && $ml!=0 && $ml >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $ml - $days;
        $sql = "UPDATE leavebalance SET ML=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'HPL' && $hpl!=0 && $hpl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $hpl - $days;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'CCL' && $ccl!=0 && $ccl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $ccl - $days;
        $sql = "UPDATE leavebalance SET CCL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif($type == 'CMM' && $hpl!=0 && $hpl >= $cmmdays){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $hpl - $cmmdays;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
        }

        elseif ($type == 'CL' && $cl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'RH' && $rh == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'EL' && $el == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'PL' && $pl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'ML' && $ml == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'HPL' && $hpl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'CCL' && $ccl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'CMM' && $hpl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        else{
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('Excedded the left ' .$type .' leaves!');
        } 
    }

if ($decision == 'Approve' && $status == 'Pending' && $forwardreporting2 != 'FINAL') {
	while ($row = mysql_fetch_array($retval)){
		$cl = $row['CL'];
		$rh = $row['RH'];
		$el = $row['EL'];
        $pl = $row['PL'];
        $ml = $row['ML'];
        $hpl = $row['HPL'];
        $ccl = $row['CCL'];
	}

	if($type == 'CL' && $cl!=0 && $cl >= $days){
		$sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'RH' && $rh!=0 && $rh >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'EL' && $el!=0 && $el >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'PL' && $pl!=0 && $pl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'ML' && $ml!=0 && $ml >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'HPL' && $hpl!=0 && $hpl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'CCL' && $ccl!=0 && $ccl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif($type == 'CMM' && $hpl!=0 && $hpl >= $cmmdays){
        $sq1 = mysql_query("UPDATE leaves SET Status='Forwarded', Reporting_Officer = $forwardreporting WHERE U_Id = $uids");
    }

    elseif ($type == 'CL' && $cl == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'RH' && $rh == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'EL' && $el == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'PL' && $pl == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'ML' && $ml == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'HPL' && $hpl == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'CCL' && $ccl == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    elseif ($type == 'CMM' && $hpl == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('No ' .$type .' left!');
    }

    else{
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
        die('Excedded the left ' .$type .' leaves!');
    }
}

if ($decision == 'Approve' && $status == 'Forwarded') {
    while ($row = mysql_fetch_array($retval)){
        $cl = $row['CL'];
        $rh = $row['RH'];
        $el = $row['EL'];
        $pl = $row['PL'];
        $ml = $row['ML'];
        $hpl = $row['HPL'];
        $ccl = $row['CCL'];
    }

    if($type == 'CL' && $cl!=0 && $cl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $cl - $days;
        $sql = "UPDATE leavebalance SET CL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($type == 'RH' && $rh!=0 && $rh >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $rh - $days;
        $sql = "UPDATE leavebalance SET RH=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($type == 'EL' && $el!=0 && $el >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $el - $days;
        $sql = "UPDATE leavebalance SET EL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($type == 'PL' && $pl!=0 && $pl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $pl - $days;
        $sql = "UPDATE leavebalance SET PL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

        elseif($type == 'ML' && $ml!=0 && $ml >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $ml - $days;
        $sql = "UPDATE leavebalance SET ML=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

        elseif($type == 'HPL' && $hpl!=0 && $hpl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $hpl - $days;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

        elseif($type == 'CCL' && $ccl!=0 && $ccl >= $days){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $ccl - $days;
        $sql = "UPDATE leavebalance SET CCL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

        elseif($type == 'CMM' && $hpl!=0 && $hpl >= $cmmdays){
        $sq1 = mysql_query("UPDATE leaves SET Status='Approved' WHERE U_Id = $uids");
        $temp = $hpl - $cmmdays;
        $sql = "UPDATE leavebalance SET HPL=$temp WHERE User_Id = $id";
        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

        elseif ($type == 'CL' && $cl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'RH' && $rh == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'EL' && $el == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'PL' && $pl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'ML' && $ml == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'HPL' && $hpl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'CCL' && $ccl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        elseif ($type == 'CMM' && $hpl == 0) {
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('No ' .$type .' left!');
        }

        else{
            mysql_close($dbhandle);
            header("refresh:5;url=Reporting_Officer_Requested_Leaves.php");
            die('Excedded the left ' .$type .' leaves!');
        }
    }

if ($decision == 'Reject') {
    $sq1 = mysql_query("UPDATE leaves SET Status='Rejected', U_Id = '' WHERE U_Id = $uids");
}
mysql_close($dbhandle);
header('Location:Reporting_Officer_Requested_Leaves.php');
?>