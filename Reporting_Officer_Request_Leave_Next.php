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
$reporting= $_POST['reporting'];
$leavetype= $_POST['leavetype'];
$fromdate= $_POST['fromdate'];
$todate= $_POST['todate'];
$days= $_POST['days'];
$uid="" .$userid ."-" .$fromdate ."-" .$todate;
$cmmdays = 2*$days;

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$retval = mysql_query("SELECT * FROM leavebalance WHERE User_Id = $userid");
if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }

while ($row = mysql_fetch_array($retval)){
	if($leavetype == "CL" && $days!=0 && $row['CL']!=0 && $row['CL'] >= $days){
		$sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
        	die('Error: ' . mysql_error());
    }


    elseif($leavetype == "RH" && $days!=0 && $row['RH']!=0 && $row['RH'] >= $days){
		$sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
        	die('Error: ' . mysql_error());
    }

    elseif($leavetype == "EL" && $days!=0 && $row['EL']!=0 && $row['EL'] >= $days){
		$sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($leavetype == "PL" && $days!=0 && $row['PL']!=0 && $row['PL'] >= $days){
        $sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($leavetype == "ML" && $days!=0 && $row['ML']!=0 && $row['ML'] >= $days){
        $sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($leavetype == "HPL" && $days!=0 && $row['HPL']!=0 && $row['HPL'] >= $days){
        $sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($leavetype == "CCL" && $days!=0 && $row['CCL']!=0 && $row['CCL'] >= $days){
        $sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
            die('Error: ' . mysql_error());
    }

    elseif($leavetype == "CMM" && $days!=0 && $row['HPL']!=0 && $row['HPL'] >= $cmmdays){
        $sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, From_Date, To_Date, Days, Status, U_Id)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$fromdate', '$todate', '$days', 'Pending', '$uid')";

        if (!mysql_query($sql, $dbhandle))
        	die('Error: ' . mysql_error());
    }

    elseif ($days == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('Apply atleast one day!');
    }

    elseif ($leavetype == "CL" && $row['CL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "RH" && $row['RH'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "EL" && $row['EL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "PL" && $row['PL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "ML" && $row['ML'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "HPL" && $row['HPL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "CCL" && $row['CCL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    elseif ($leavetype == "CMM" && $row['HPL'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
        die('you have no ' .$leavetype .' left!');
    }

    else{
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
    	die('you have excedded the left ' .$leavetype .' leaves!');
    }
}

mysql_close($dbhandle);
header("refresh:10;url=Reporting_Officer_Request_Leave.php");
echo "New Leave Applied" . "<br />";
echo "User Name : $user" . "<br />";
echo "User Id : $userid" . "<br />";
echo "Designation : $designation" . "<br />";
echo "Department : $department" . "<br />";
echo "Leave Type : $leavetype" . "<br />";
echo "From Date : $fromdate" . "<br />";
echo "To Date : $todate" . "<br />";
echo "Days : $days" . "<br />";
?>