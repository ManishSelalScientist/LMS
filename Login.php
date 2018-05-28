<?php
function _e($string){
    echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    //echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="Login.css">
  <h1>Welcome To <a style="display: inline; color:red" href='About.html'><b>STQC</b></a> LMS</h1>
</head>
<body>
  <div class="login-page">
  <div class="form">
    <form class="login-form" autocomplete="off" method="post" action="Login_Next.php">
      <input type="number" name="id" id="id" placeholder="User Id"/>
      <input type="password" name="password" id="password" placeholder="Password"/>
      <button><b>Login</b></button>
      <p class="message"><b><?php _e('Not registered?')?> &nbsp;</b><a href="Sign_Up_Form_First.php"><b><?php _e('Create an account')?></b></a></p>
    </form>
  </div>
</div>
</body>
<footer>
  <p><b>&copy; 2017 STQC ERTL(N)</b><p>
</footer>
</html>