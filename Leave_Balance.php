<?php 
$username = "root";
$password = "";
$hostname = "localhost:3388";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

mysql_select_db("leavemanagement",$dbhandle) 
  or die("Could not select examples");

$sql = mysql_query("SELECT * FROM leavebalance");
mysql_close($dbhandle);
?>

<html>
<head>
	<title>Leave Balance</title>
	<link rel="stylesheet" type="text/css" href="Requested_Leaves.css">
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
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
<br>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
<br>
	<h1>Leave Balance</h1>
	<br>
	<table id="myTable" class="data-table">
		<thead>
			<tr class="header">
				<th>SNo</th>
				<th>User Name</th>
				<th>User Id</th>
				<th>Department</th>
				<th>Designation</th>
				<th>CL</th>
				<th>RH</th>
				<th>EL</th>
				<th>PL</th>
				<th>ML</th>
				<th>HPL</th>
				<th>CCL</th>
				<th>CCL_NO</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($row = mysql_fetch_array($sql))
			{
				echo '
				<tr>
				<td>'.$no.'</td>
				<td>'.$row['User_Name'].'</td>
				<td>'.$row['User_Id'].'</td>
				<td>'.$row['Department'].'</td>
				<td>'.$row['Designation'].'</td>
				<td>'.$row['CL'].'</td>
				<td>'.$row['RH'].'</td>
				<td>'.$row['EL'].'</td>
				<td>'.$row['PL'].'</td>
				<td>'.$row['ML'].'</td>
				<td>'.$row['HPL'].'</td>
				<td>'.$row['CCL'].'</td>
				<td>'.$row['CCL_NO'].'</td>
				</tr>';
				$no++;
			}
			?>
				
			</tbody>
	</table>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
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