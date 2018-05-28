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

$sql = mysql_query("SELECT * FROM leaves");
$sqltext = mysql_query("SELECT * FROM userinfo WHERE User_Id = $loggedinuser");
while ($rowtext = mysql_fetch_array($sqltext)){
	$loggedinusertext = $rowtext['User_Name'];
}
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Requested Leaves</title>
	<link rel="stylesheet" type="text/css" href="Requested_Leaves.css">
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
<div class="navbar">	
  <ul id = "menu">
  <li><a href="Reporting_Officer_Dashboard.php">Home</a></li>
  <li><a href="Reporting_Officer_Requested_Leaves.php">Requested Leaves</a></li>
  <li><a href="Reporting_Officer_My_Leaves.php">My Leaves</a></li>
  <li><a href="Reporting_Officer_Leave_Balance.php">My Leaves Balance</a></li>
  <li><a href="https://www.india.gov.in/calendar" target="Blank">Calendar</a></li>
  <li><a href="Reporting_Officer_Request_Leave.php">Request Leave</a></li>
  <li class="menu_right"><a href="Sign_Out.php">Sign Out</a></li>
  </ul>
</div>
<br>
<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for Names">
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for User Id">
<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search for Department">
<input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Search for Type">
<br>
	<h1>Requested Leaves</h1>
	<br>
	<table id="myTable" class="data-table">
		<thead>
			<tr class="header">
				<th>SNo</th>
				<th>User Name</th>
				<th>User Id</th>
				<th>Department</th>
				<th>Designation</th>
				<th>Leave Type</th>
				<th>Duration</th>
				<th>From Date</th>
				<th>To Date</th>
				<th>Days</th>
				<th>Status</th>
				<th>Action</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($row = mysql_fetch_array($sql))
			{   
				if ($row['Reporting_Officer']==$loggedinusertext && ($row['Status']=="Pending" || $row['Status']=='Forwarded'))
				{
				{
					echo '
					<tr>
				    <td>'.$no.'</td>
				    <td>'.$row['User_Name'].'</td>
				    <td>'.$row['User_Id'].'</td>
				    <td>'.$row['Department'].'</td>
				    <td>'.$row['Designation'].'</td>
				    <td>'.$row['Leave_Type'].'</td>
				    <td>'.$row['Duration'].'</td>
				    <td>'.$row['From_Date'].'</td>
				    <td>'.$row['To_Date'].'</td>
				    <td>'.$row['Days'].'</td>
				    <td>'.$row['Status'].'</td>
				    <td>
				    <button name="name" style="background-color:#99ff99; border:1px solid black;" value="Approve '.$row['User_Id'].' '.$row['U_Id'].' '.$row['Leave_Type'].' '.$row['Days'].' '.$row['Status'].'" onclick="do_accept(this.value)">Approve</button>

                    <button name="name" style="background-color:#f55858; border:1px solid black;" value="Reject '.$row['User_Id'].' '.$row['U_Id'].' '.$row['Leave_Type'].' '.$row['Days'].'" '.$row['Status'].' onclick="do_reject(this.value)">Reject</button>

                    </td>
				    </tr>';
					}
				$no++;
			}
			}
			?>
				
			</tbody>
	</table>
<script type="text/javascript">
	function do_accept(a1){
		var words = a1.split(" ");
		var decision = words[0];
		var id = words[1];
		var uid = words[2];
		var type = words[3];
		var days = words[4];
		var status = words[5];
		window.location.href = "AcceptRejectForward.php?decision=" + decision +"&id=" + id +"&uid=" + uid +"&type=" + type +"&days=" + days +"&status=" +status;
	}
	function do_reject(r1) {
		var words = r1.split(" ");
		var decision = words[0];
		var id = words[1];
		var uid = words[2];
		var type = words[3];
		var days = words[4];
		var status = words[5];
		var site = prompt("Please Enter Remark For Rejection", "Write Here Something");
		if (site) {
			window.location.href = "AcceptRejectForward.php?decision=" + decision +"&id=" + id +"&uid=" + uid +"&type=" + type +"&days=" + days +"&status=" +status +"&remark=" +site;
		}
	}
</script>	
<script type="text/javascript">	
function myFunction1() {
  // Declare variables 
  var input1, filter1, table, tr, td, i;
  input1 = document.getElementById("myInput1");
  filter1 = input1.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter1) > -1) 
      {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function myFunction2() {
  // Declare variables 
  var input2, filter2, table, tr, td, i;
  input2 = document.getElementById("myInput2");
  filter2 = input2.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter2) > -1) 
      {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function myFunction3() {
  // Declare variables 
  var input3, filter3, table, tr, td, i;
  input3 = document.getElementById("myInput3");
  filter3 = input3.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter3) > -1) 
      {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

function myFunction4() {
  // Declare variables 
  var input2, filter2, table, tr, td, i;
  input4 = document.getElementById("myInput4");
  filter4 = input4.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter4) > -1) 
      {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
</body>
</html>