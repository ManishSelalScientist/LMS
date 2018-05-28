<html>
<head>
  <title>Admin User Create</title>
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

<?php  $username = "root";
$password = "";
$hostname = "localhost:3388"; 

$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

$selected = mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql = mysql_query("SELECT * FROM userinfo");
mysql_close($dbhandle);
?>
<html>
<head>
  <title>Leave_Balance_CMS</title>
  <link rel="stylesheet" type="text/css" href="Sign_Up_Form.css">
</head>
<body>
<form action="Leave_Balance_CMS_Next.php" method="post" onsubmit="return validate(this);">
  <div class="container">

    <label><b>User Id</b></label>
    <input type="number" maxlength="6" placeholder="Enter Id" id="id" name="id" required>

    <label><b>CL</b></label>
    <input type="number" step="any" placeholder="Enter CL" id="cl" name="cl" required>

    <label><b>RH</b></label>
    <input type="number" placeholder="Enter RH" id="rh" name="rh" required>

    <label><b>EL</b></label>
    <input type="number" placeholder="Enter EL" id="el" name="el" required>

    <label><b>PL</b></label>
    <input type="number" placeholder="Enter PL" id="pl" name="pl" required>

    <label><b>ML</b></label>
    <input type="number" placeholder="Enter ML" id="ml" name="ml" required>

    <label><b>HPL</b></label>
    <input type="number" placeholder="Enter HPL" id="hpl" name="hpl" required>

    <label><b>CCL</b></label>
    <input type="number" placeholder="Enter CCL" id="ccl" name="ccl" required>

    <label><b>CCL NO</b></label>
    <input type="number" placeholder="Enter CCL NO" id="cclno" name="cclno" required>

    <div class="clearfix">
      <button type="submit" class="signupbtn"><b>Submit</b></button>
      <button type="button" class="cancelbtn" onclick="window.location.reload()"><b>Cancel</b></button>
    </div>
  </div>
</form> 

</body>
</html>


