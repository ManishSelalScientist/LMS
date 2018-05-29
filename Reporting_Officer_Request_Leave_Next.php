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
$duration= $_POST['specify'];

if ($duration == '' || $duration == 'Full') {
    $uid="" .$userid ."-" .$fromdate ."-" .$todate;
}

if ($duration == 'Half Forenoon') {
    $uid="" .$userid ."-" .$fromdate ."-" .$todate. "1";
}

if ($duration == 'Half Afternoon') {
    $uid="" .$userid ."-" .$fromdate ."-" .$todate. "2";
}

$cmmdays = 2*$days;

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$retval = mysql_query("SELECT * FROM leavebalance WHERE User_Id = $userid");
if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }

while ($row = mysql_fetch_array($retval)){
	if($leavetype == "CL" && $days!=0 && $row['CL']!=0 && $row['CL'] >= $days){
		$sql = "INSERT INTO leaves (User_Name, User_Id, Designation, Department, Reporting_Officer, Leave_Type, Duration, From_Date, To_Date, Days, Status, U_Id, Remarks)
        VALUES ('$user', '$userid', '$designation', '$department', '$reporting', '$leavetype', '$duration', '$fromdate', '$todate', '$days', 'Pending', '$uid', '')";

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

    elseif($leavetype == "CCL" && $days!=0 && $row['CCL']!=0 && $row['CCL'] >= $days && $row['CCL_NO'] > 0){
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

    elseif ($leavetype == "CCL" && $row['CCL_NO'] == 0) {
        mysql_close($dbhandle);
        header("refresh:5;url=User_Request_Leave.php");
        die('you have excedded ' .$leavetype .' Turns left!');
    }

    else{
        mysql_close($dbhandle);
        header("refresh:5;url=Reporting_Officer_Request_Leave.php");
    	die('you have excedded the left ' .$leavetype .' leaves!');
    }
}

mysql_close($dbhandle);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="Leave_Form.css">
    <meta charset="UTF-8">
    <script type="text/javascript">function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
    <title>LeaveForm</title>
</head>
<body id="printableArea">
    <form>
    <input type="button" value="Print" style="float: right;" onclick="printDiv('printableArea')">
    <input type="button" value="Done"  style="float: right;" onclick="location.href = 'Reporting_Officer_Request_Leave.php'">
    </form>
    <p>भारत सरकार<br>Government Of India<br>इलेक्ट्रॉनिक क्षेत्रीय परीक्षण प्रयोगशाला (उत्तर)<br>Electronic Regional Test Laboratory (North)<br>एस-ब्लॉक, ओखला औद्योगिक क्षेत्र चरण दो, नई दिल्ली - 110020, भारत<br>S-Block, Okhla Industrial Area, Phase 2, New Delhi - 110020, India.</p>

    <div><p>छुट्टी आवेदन संख्या&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspतारीख<br>


    Leave Application No&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate..............................</p><br>
    

    <p>1.&nbsp&nbspनाम/Name&nbsp:&nbsp&nbsp<?php echo $user ?><br>
        
        2.&nbsp&nbspकर्मचारी संख्या/Emp No.&nbsp:<br>

        3.&nbsp&nbspपद/Designation&nbsp:&nbsp&nbsp<?php echo $designation ?><br>

        4.&nbsp&nbspविभाग/Department&nbsp:&nbsp&nbsp<?php echo $department ?><br>

        5.&nbsp&nbspवेतनमान/Pay Scale&nbsp:<br>

        6.&nbsp&nbspछुट्टी की प्रकृति/Nature of Leave&nbsp:&nbsp&nbspआकस्मिक,CL / प्रतिबंधित,RH / प्रसूति,ML / विशेषाधिकार,PL / अर्जित,EL / अर्धवैतनिक,HPL / परिवर्तित अवकाश,CMM<br>

    7.&nbsp&nbspछुट्टी की अवधि/Period of Leave&nbsp:&nbsp&nbsp<?php echo $days ?></p>
    <table style="width:100%" border="1">
  <tr>
    <th>Leave Type</th>
    <th>From</th> 
    <th>Up to</th>
    <th>No of days</th>
  </tr>
  <tr>
    <td><?php echo $leavetype ?></td>
    <td><?php echo $fromdate ?></td> 
    <td><?php echo $todate ?></td>
    <td><?php echo $days ?></td>
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td>इस एप्लिकेशन को छोड़कर शेष राशि<br>Balance excluding this Application</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td>आवेदन के लिए लंबित<br>Pending for Approval</td>
    <td></td>
  </tr>
</table>
    <p>8.&nbsp&nbspरविवार और छुट्टी के दिन<br>&nbsp&nbsp&nbsp&nbsp&nbspयदि किसी भी प्रस्तावित या प्रत्ययी होना प्रस्तावित है<br>&nbsp&nbsp&nbsp&nbspSunday & Holidays if any proposed to be prefixed / suffixed&nbsp:<br>

        9.&nbsp&nbspछुट्टी के लिए कारण<br>&nbsp&nbsp&nbsp&nbspGround on which leave is applied&nbsp:<br>

        10.&nbsp&nbspअंतिम छुट्टी और प्रकृति और उस छुट्टी की अवधि से वापसी की तारीख<br>&nbsp&nbsp&nbsp&nbspDate of return from last leave and<br>&nbsp&nbsp&nbsp&nbspNature and period of that leave&nbsp:<br>

        11.&nbsp&nbspमैं ब्लॉक वर्ष के लिए छुट्टी यात्रा रियायत का लाभ उठाने का प्रस्ताव नहीं करता<br>&nbsp&nbsp&nbsp&nbspI do not propose to avail of leave Travel Concession for the block year&nbsp:<br>

        12.&nbsp&nbspछुट्टी अवधि के दौरान पता<br>&nbsp&nbsp&nbsp&nbspAddress during leave period&nbsp:</p><br>

    <p>Date..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspआवेदक के हस्ताक्षर<br>

    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSignature of Applicant</p><br>
    

    <p>संस्तुति की गई/ नहीं की गई&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspनियंत्रक अधिकारी<br>

        Recommended/Not Recommended&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspControlling Officer<br>

    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspपदनाम/Designation..............................</p><br>

    <p>मंजूर की गई/ नहीं की गई<br>Sanctioned/Not Sanctioned</p>


</div>
<br>
<p>(प्रस्थान करने के लिए स्वीकार्यता के बारे में प्रमाण पत्र<br>Certificate Regarding Admissibility to Leave)<br>

    (निजी अनुभाग<br>

    Personal Section)<br>

    प्रमाणित है कि सीएल (छुट्टी की प्रकृति)..............................दिन से..............................से..............................<br>

    केंद्रीय नागरिक सेवाओं (छोड़) के नियमों के तहत स्वीकार्य है&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCertified that CL(Nature of Leave) for..............................days from..............................to..............................<br>

    is admissible under Rule..............................of the Central Civil Services(Leave) rules.&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>

    <br>

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspहस्ताक्षर/Signature..............................</p>

</body>
</html>