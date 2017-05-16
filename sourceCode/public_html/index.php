<?php
session_start();
$user = null;
if(isset($_SESSION[activeuser])){
  $login=1;
}
else{
  $login=0;
}
?>


<!DOCTYPE>
<html>
<head>

  <!--Meta tag for android view-->
  <meta name="viewport" content="initial-scale=1">
  <meta name="HandheldFriendly" content="true" />
  <meta name="viewport" content="user-scalable=no, width=device-width, maximum-scale=5.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="data/css/style.css">
  <title>Book.trade</title>
  <meta name="description" content="Book trading platform for students, book-lovers and bookworms. Trading books are in physical form, not an E-Book.">
  <meta name="keywords" content="Book, trade, book trade, Physical Books, Buy Books, Sell Books, Trade Books">
</head>
<body onload='location.href="#home"'>

    <!-- Fixed Top Bar -->
    <div id="topBarWrap" class="topBarWrap">
      <div id="topBar" class="topBar">
        <ul>
          <!--<td><h1><a id="title" href="#home"><img src="data/images/WLogo.png" width="40%" height="40%"></a></h1></td>-->
          <li><h1><a id="title" href="#home">Book.trade</a></h1></li>
          <li><h3><a href="#libraryContent">Library</a></h3></li>
          <li><h3><a href="#listContent">Booklist</a></h3></li>
          <?php if($login==0):?>
            <li><h3><a href="#registerContent">Register</a></h3></li>
            <li><h3><a href="#loginContent">Login</a></h3></li>
          <?php else:?>
            <li><h3><a><?php echo $_SESSION["activeuser"]?></a></h3></li>
            <li><h3><a href="#logoutContent">Logout</a></h3></li>
          <?php endif;?>
        </ul>
      </div>
    </div>


    <!--Scrollable Page-->
    <!--Left Bar-->
    <div id="leftBar" class="leftBar">
    </div>

    <!--Middle Content-->
    <div id="content" class="content">
      <!--Welcome Page-->
      <div id="home" class="home">
        <p>Welcome <?php echo $_SESSION["activeuser"]?> !</p>
      </div>

      <!--Login-->
      <div id="loginContent" class="loginContent">
        <form method="post">
            <?php include 'login.php';?>
            <h2>Login</h2>
            <?php if(!$success==1): ?>
              <p align="center" style="color:darkred;">Invalid credentials!</p>
            <?php endif; ?>
            <table>
              <tr>
                <td align="right">Username:</td>
                <td align="left"><input id="username"type="text" name="username" /></td>
              </tr>
              <tr>
                <td align="right">Password:</td>
                <td align="left"><input id="password" type="password" name="password" /></td>
              </tr>
              <tr>
                <td align="right"></td>
                <td align="left"><input type="submit" name="submit" value="Submit" /></td>
              </tr>
            </table>
          </form>
      </div>

      <!--register content-->
      <div id="registerContent" class="registerContent" >
          <?php include 'register.php';?>
          <form method="post">
            <h2>Register</h2>
            <?php if($formValid==false): ?>
              <p align="center"style="color:darkred;">All fields required!</p>
            <?php elseif($usernameValid==false): ?>
              <p align="center" style="color:darkred;">
                Username must be between 4 to 12 characters!<br>
                Username should not start with a number nor with a space!
              </p>
            <?php elseif($passwordMissMatch == true): ?>
              <p align="center" style="color:darkred;">
                Password did not match!
              </p>
            <?php elseif($passwordValid == false): ?>
              <p align="center" style="color:darkred;">
                Password invalid!<br>
                Password must be alphanumeric containing at least one symbol!<br>
                Password must be between 6 to 12 characters!
              </p>
            <?php elseif($existName==1): ?>
              <p align="center" style="color:darkred;">
                Given username already exists!<br>
              </p>
            <?php elseif($existEmail==1): ?>
              <p align="center" style="color:darkred;">
                Given email already exists!<br>
              </p>
            <?php elseif($registration==1): ?>
              <p align="center" style="color:darkgreen;">
                Regisrtation successful!!!<br>
              </p>
            <?php endif; ?>
            <table>
              <tr>
                <td align="right">Username:</td>  <td align="left"><input id="usernamesignup"type="text" name="usernamesignup" /></td>
              </tr>
              <tr>
                <td align="right">Email:</td>    <td align="left"> <input id="emailsignup"type="text" name="emailsignup" /></td>
              </tr>
              <tr>
                <td align="right">Password:</td>  <td align="left"><input id="passwordsignup" type="password" name="passwordsignup" /></td>
              </tr>
              <tr>
                <td align="right">Confirm Password:</td>  <td align="left"><input id="passwordsignup_confirm" type="password" name="passwordsignup_confirm" /></td>
              </tr>
              <tr>
                <td align="right"></td><td align="left"><input type="submit" name="submit" value="Register!" /></td>
              </tr>
            </table>
          </form>
        </div>

      <!--Logout-->
      <div id="logoutContent" class="logoutContent">
          <?php include 'logout.php';?>
          <form method="post">
            <p>Do you really wanna logout??</p>
            <input type="submit" name="logoutYes" value="Yes!" />
            <input type="submit" name="logoutNo" value="No I wanna Stay!" />
          </form>
        </div>

      <!--Booklist Content-->
    </div>
</body>
</html>
