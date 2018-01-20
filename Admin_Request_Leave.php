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

$sql = mysql_query("SELECT * FROM userinfo WHERE User_Id = $loggedinuser");
$sql1 = mysql_query("SELECT * FROM leaves WHERE User_Id = $loggedinuser AND (Status = 'Pending' || Status = 'Approved' || Status = 'Forwarded')");
mysql_close($dbhandle);
if(!$sql1)
{
    alert("sql1 query failed!");
}
            
$valueMap = array();
while($row = mysql_fetch_array($sql1)){
    $valueMap[] = array($row['From_Date'], $row['To_Date']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Request Leave</title>
  <link rel="stylesheet" type="text/css" href="Dashboard.css">
  <link rel="stylesheet" type="text/css" href="Sign_Up_Form.css">
</head>
<body>
    <ul id = "menu">
        <li><a href="Admin_Dashboard.php">Home</a></li>
        <li><a class="drop">Admin</a>
            <div class="dropdown_Admin">
                <div class="col_1">
                    <p><a href="List_Users.php">Users</a></p>
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
                    <p><a href="#">Link1</a></p>
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

<?php
while ($row = mysql_fetch_array($sql)){
$name = $row['User_Name']; 
$id = $row['User_Id'];
$department = $row['Department'];
$designation = $row['Designation'];
$reporting = $row['Reporting_Officer'];
}
?>

<form action="Admin_Request_Leave_Next.php" method="post">                  
  <div class="container">
    <label><b>User Name</b></label>
    <input type="text" value = '<?php echo $name;?>' placeholder="Enter Name" id="name" name="name" onkeydown="upperCaseF(this)" required>

    <label><b>User Id</b></label>
    <input type="number" maxlength="6" value = '<?php echo $id;?>' placeholder="Enter Id" id="id" name="id" required>


    <label><b>Designation</b></label>
    <input type="text" placeholder="Designation" value = '<?php echo $designation ?>' id="designation" name="designation" onkeydown="upperCaseF(this)" required/> 

    <label><b>Department</b></label>
    <input type="text" value = '<?php echo $department ?>' placeholder="Enter Department" id="department" name="department" onkeydown="upperCaseF(this)" required>

    <label><b>Reporting Officer</b></label>
    <input type="text" value = '<?php echo $reporting ?>' placeholder="Reporting_Officer" id="reporting" name="reporting" onkeydown="upperCaseF(this)" required>

    <label><b>Leave Type</b></label>
    <input list="select_leave" type="text" placeholder="Leave Type" id="leavetype" name="leavetype" onkeydown="upperCaseF(this)" required/>
    <datalist id="select_leave">
    <option value="CL">
    <option value="RH">
    <option value="EL">
    <option value="CCL">
    <option value="PL">
    <option value="ML">
    <option value="HPL">
    <option value="CMM">
    </datalist>

    <label><b>From Date</b></label>
    <input type="date" placeholder="From Date" id="fromdate" name="fromdate" onchange="DateCheck()" required>

    <lablel><b>To Date</b></label>
    <input type="date" placeholder="Enter Id" id="todate" name="todate" onchange="DateCheck()" required>

    <label><b>Days</b></label>
    <input type="number" placeholder="No of Days" id="days" name="days" onclick="Days()" required> 

    <div class="clearfix">
      <button type="submit" class="signupbtn"><b>Apply Leave</b></button>
      <button type="button"  class="cancelbtn" onclick="window.location.reload()"><b>Cancel</b></button>
    </div>
  </div>
</form>

<script type="text/javascript">
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
</script>

<script type="text/javascript">
    function DateCheck()
    {
        var nowDate = new Date();
        var StartDate= document.getElementById('fromdate').value;
        var EndDate= document.getElementById('todate').value;
        var eDate = new Date(EndDate);
        var sDate = new Date(StartDate);
        if(sDate < nowDate)
        {
            document.getElementById('fromdate').value = '';
            alert("Please ensure that the From Date is greater than or equal to the Current Date!");
            return false;
        }
        if(StartDate!= '' && EndDate!= '' && sDate> eDate)
        {
            document.getElementById('todate').value = '';
            alert("Please ensure that the To Date is greater than or equal to the From Date!");
            return false;
        }
        if (StartDate!= '' && EndDate!= '') {
                var jArray= <?php echo json_encode($valueMap); ?>;
                for (var i = jArray.length - 1; i >= 0; i--) 
                {

                var fdate = jArray[i][0];
                var fdate1 = new Date(fdate);
                var tdate = jArray[i][1];
                var tdate1 = new Date(tdate);
                if(fdate1<=sDate && sDate<=tdate1 || fdate1<=eDate && eDate<=tdate1)
                {
                    document.getElementById('fromdate').value = '';
                    document.getElementById('todate').value = '';
                    alert("Leaves already applied in these dates!");
                    return false;
                }
                
            }
            
        }
    }
    function Days(){
        var StartDate= document.getElementById('fromdate').value;
        var EndDate= document.getElementById('todate').value;
        var eDate = new Date(EndDate);
        var sDate = new Date(StartDate);
        var days = ((eDate - sDate)/1000/60/60/24)+1;
        document.getElementById('days').value = days; 

    }
</script>

</body>
</html>

    