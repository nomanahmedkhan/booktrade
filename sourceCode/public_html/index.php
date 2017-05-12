<?php
$user = null;
$login = 0;
session_start();
?>


<!DOCTYPE>
<html>
<head>
  <meta http-equiv="Page-Enter" content="blendTrans(Duration=2.0)">
  <meta http-equiv="Page-Exit" content="blendTrans(Duration=2.0)">
  <meta http-equiv="Site-Enter" content="blendTrans(Duration=2.0)">
  <meta http-equiv="Site-Exit" content="blendTrans(Duration=2.0)">
  <meta name="viewport" content="width-width,initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="data/css/style.css">
  <title>
  </title>
</head>
<body onload='location.href="#home"'>

    <table id="topMenu">
      <tr>
        <td colspan="4"><h1><a id="title" href="#home">Book.trade</a></h1></td>
      </tr>
      <tr id="menuItem">
        <td><a href="#loginContent">Library</a></td>
        <td><a href="#loginContent">Booklist</a></td>
        <td><a href="#registerContent">Register</a></td>
        <td><a href="#loginContent">Login</a></td>
      </tr>
    </table>



  <!--Page Content-->
  <tabel id="content">
      <tr>
        <td colspan="4">

          <div id="home">
            <p>Welcome <?php echo $_SESSION["activeuser"]?> !<br>
            </p>
          </div>

          <!--login content-->
          <div id="loginContent">
            <?php include 'login.php';?>
            <h2>Login</h2>
            <br>
            <?php if($success==0): ?>
              <h3 align="center" style="color:darkred">Invalid credentials!</h3>
            <?php endif; ?>
            <form method="post">
              <table>
                <tr>
                  <td align="right">Username:</td>  <td align="left"><input id="username"type="text" name="username" /></td>
                </tr>
                <tr>
                  <td align="right">Password:</td> <td align="left"><input id="password" type="password" name="password" /></td>
                </tr>
                <tr>
                  <td align="right"></td><td align="left"><input type="submit" name="submit" value="Submit" /></td>
                </tr>
              </table>
            </form>
          </div>


          <!--register content-->
          <div id ="registerContent">
            <?php include 'register.php';?>
            <h2>Register</h2>
            <br>
            <form method="post">
              <?php if($formValid==false): ?>
                <h3 align="center"style="color:darkred;">All fields required!</h3>
              <?php elseif($usernameValid==false): ?>
                <h3 align="center" style="color:darkred;">
                  Username must be between 4 to 12 characters!<br>
                  Username should not start with a number nor with a space!
                </h3>
              <?php elseif($passwordMissMatch == true): ?>
                <h3 align="center" style="color:darkred;">
                  Password did not match!
                </h3>
              <?php elseif($passwordValid == false): ?>
                <h3 align="center" style="color:darkred;">
                  Password invalid!<br>
                  Password must be alphanumeric containing at least one symbol!<br>
                  Password must be between 6 to 12 characters!
                </h3>
              <?php elseif($existName==1): ?>
                <h3 align="center" style="color:darkred;">
                  Given username already exists!<br>
                </h3>
              <?php elseif($existEmail==1): ?>
                <h3 align="center" style="color:darkred;">
                  Given email already exists!<br>
                </h3>
              <?php elseif($registration==1): ?>
                <h3 align="center" style="color:darkgreen;">
                  Regisrtation successful!!!<br>
                </h3>
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
        </td>
      </tr>
</body>
</html>
