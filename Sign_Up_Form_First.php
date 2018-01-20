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
  <title>SignUp</title>
  <link rel="stylesheet" type="text/css" href="Sign_Up_Form.css">
</head>
<body>
<form action="Sign_Up_Form.php" method="post" onsubmit="return validate(this);">
  <div class="container">
    <label><b>User Name</b></label>
    <input type="text" placeholder="Enter Name" id="name" name="name" onkeydown="upperCaseF(this)" required>

    <label><b>User Id</b></label>
    <input type="number" maxlength="6" placeholder="Enter Id" id="id" name="id" required>

    <label><b>Designation</b></label>
    <input list="select_designation" type="text" placeholder="Designation "id="designation" name="designation" onkeydown="upperCaseF(this)" required/>
    <datalist id="select_designation">
    <option value="Scientist-B">
    <option value="Scientist-C">
    <option value="Scientist-D">
    <option value="Scientist-E">
    <option value="Scientist-F">
    <option value="Scientist-G">
    <option value="Scientist-H">
    </datalist> 

    <label><b>Department</b></label>
    <input list="select_department" type="text" placeholder="Enter Department" id="department" name="department" onkeydown="upperCaseF(this)"required>
    <datalist id="select_department">
    <option value="IT">
    <option value="MIS">
    </datalist>

    <label><b>Reporting Officer</b></label>
    <input list="select_reporting" type="text" placeholder="Reporting Officer" id="reporting" name="reporting" onkeydown="upperCaseF(this)"required>
    <datalist id="select_reporting">
    <option value="SURESH CHANDRA">
    <option value="A K UPADHYAY">
    <option value="C S BISHT">
    </datalist>

    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" id="email" name="email" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required>
    

    <label><b>Password</b></label>
    <input type="password" placeholder="Password" id="password" name="password" required>

    <label><b>Confirm Password</b></label>
    <input type="text" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>

    <input type="checkbox" name="terms" id="terms" /> Agree
    <p>By creating an account you agree to our <a href="Terms_Privacy.html" target="_blank">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="submit" class="signupbtn"><b>Sign Up</b></button>
      <button type="button" class="cancelbtn" onclick="window.location.reload()"><b>Cancel</b></button>
    </div>
  </div>
</form>

<script type="text/javascript">
    window.onload = function () {
    document.getElementById("password").onchange = validatePassword;
    document.getElementById("confirm_password").onchange = validatePassword;
}
    function validatePassword(){
        var pass2=document.getElementById("confirm_password").value;
        var pass1=document.getElementById("password").value;
        if(pass1!=pass2)
            document.getElementById("confirm_password").setCustomValidity("Passwords Don't Match");
        else
            document.getElementById("confirm_password").setCustomValidity('');   //empty string means no validation error
    }
</script>

<script type="text/javascript">
    function validate(form) {
        if(form.terms.checked==false) {
            alert('Please check the box!');
            return false;
        }
        return true;
    }
</script>

<script type="text/javascript">
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}
</script>

</body>
</html>


