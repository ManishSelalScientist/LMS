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

    <label><b>Gender</b></label>
    <input list="select_Gender" type="text" placeholder="Gender" id="gender" name="gender" required/>
    <datalist id="select_Gender">
    <option value="MALE">
    <option value="FEMALE">
    </datalist> 

    <label><b>Designation</b></label>
    <input list="select_designation" type="text" placeholder="Designation" id="designation" name="designation" required/>
    <datalist id="select_designation">
    <option value="Scientist-B">
    <option value="Scientist-C">
    <option value="Scientist-D">
    <option value="Scientist-E">
    <option value="Scientist-F">
    <option value="Scientist-G">
    <option value="SO-SB">
    <option value="SA-B">
    <option value="SA-A">
    <option value="TM-A">
    <option value="TM-B">
    <option value="TM-C">
    <option value="TM-D">
    <option value="TM-E">
    <option value="TM-F">
    <option value="TM-G">
    <option value="TM-H">
    <option value="TM-I">
    <option value="ASSITANT">
    <option value="ASSITANT-A">
    <option value="ASSITANT-B">
    <option value="ASSITANT-C">
    <option value="PA">
    <option value="SCD">
    <option value="JHT">
    <option value="DEPUTY DIRECTOR">
    <option value="DIRECTOR">
    <option value="STENO">
    <option value="LA-A">
    <option value="LA-B">
    </datalist>

    <label><b>Department</b></label>
    <input list="select_department" type="text" placeholder="Enter Department" id="department" name="department" required>
    <datalist id="select_department">
    <option value="ADMINISTRATION">
    <option value="COMPONENT">
    <option value="CSC">
    <option value="DIRECTOR OFFICE">
    <option value="E CAL">
    <option value="EMI/EMC">
    <option value="ENV">
    <option value="QA">
    <option value="NE CAL">
    <option value="SAFETY">
    <option value="SYSTEM">
    </datalist>

    <label><b>Reporting Officer</b></label>
    <input list="select_reporting" type="text" placeholder="Reporting Officer" id="reporting" name="reporting" required>
    <datalist id="select_reporting">
    <option value="C S BISHT">
    <option value="SURESH CHANDRA">
    <option value="A K UPADHYAY">
    <option value="ASHOK KUMAR ROHILLA">
    <option value="A U KHAN">
    <option value="JITENDER SAIGAL">
    <option value="SANJEEV KUMAR">
    <option value="MANJULA BHATI">
    <option value="RAJNI YADAV">
    <option value="V K MITTAL">
    <option value="DHARAMVEER SINGH">
    <option value="PRAHLAD GUPTA">
    <option value="MANOJ KUMAR SAXENA">
    <option value="SHEO PRASHAD">
    <option value="R M AMARYA">
    <option value="PRADEEP GUNJAYAL">
    <option value="RAM SNEHI">
    <option value="ASHOK KUMAR">
    <option value="VIVEK KASHYAP">
    <option value="PRAKASH MOTWANI">
    <option value="MAHAVEER PRASHAD">
    <option value="PARVEEN JAHAN">
    <option value="FINAL">
    </datalist>

    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" id="email" name="email" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required>
    

    <label><b>Password</b></label>
    <input type="password" placeholder="Password" id="password" name="password" required>

    <label><b>Confirm Password</b></label>
    <input type="text" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>

    <input type="checkbox" name="terms" id="terms" /> Agree
    <p>By creating an account you agree to our <a href="Terms_And_Conditions.html" target="_blank">Terms & Conditions</a>.</p>

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


