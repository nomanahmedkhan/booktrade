<?php include 'defaultStyle.php'; ?>
  <?php
  // Same as error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);
  // Same as error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $connection = mysqli_connect('localhost', 'root', 'Godonly1');
  if (!$connection){
      die("Database Connection Failed" . mysqli_error($connection));
  }

  $select_db = mysqli_select_db($connection, 'booktrade');
  if (!$select_db){
      die("Database Selection Failed" . mysqli_error($connection));
  }
  $login=1;

    //3. If the form is submitted or not.
    //3.1 If the form is submitted
    if (isset($_POST['username']) and isset($_POST['password'])){
    //3.1.1 Assigning posted values to variables.
    $username = $_POST['username'];
    $password = $_POST['password'];
    //3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM `user` WHERE userName='$username' and userPassword='$password'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1){
      header("Location: account.php?user=" . urlencode(serialize($username)));
    }elseif ($count ==0) {
      $login = 0;
    }
    }

  ?>
  <html>
  <head>
  <title>Login | Booktrade</title>
  </head>
  <body style="background-color:#ccc;">
    <a style="color:black;text-decoration:none;" href="index.html"><h1>Book.trade</h1></a>
    <h2>Login</h2>
    <br>
    <?php if($login==0): ?>
    <h3 style="color:darkred">Invalid credentials!</h3>
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
    </table>
    </form>
  </body>
  </html>
