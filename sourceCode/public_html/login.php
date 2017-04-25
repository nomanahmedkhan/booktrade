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
$success = false;
$passwordMissMatch = false;


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
    $login =true;
    header("Location: account.php?user=" . urlencode(serialize($username)));
  }else{
    $login =false;
  }
  }

 else {
  $success = null;
  $login = null;
}

?>
<html>
<head>
	<style>
	a {text-decoration:none;}
	* {margin: 0px 10px 0px 10px; color: black;}
	ul {list-style-type:  none;}
	h1 {text-align:center;}
	h2 {text-align:center;}
	h3 {text-align:center;}
	h4 {text-align:center;}
	h5 {text-align:center;}
	h6 {text-align:center;}
	</style>
<title>Login | Booktrade</title>
</head>
<body style="background-color:#ccc;">
  <a style="color:black;text-decoration:none;" href="index.html"><h1>Book.trade</h1></a>
  <h2>Login</h2>
  <br>
  <form method="post">
  Username:  <input id="username"type="text" name="username" />
  <br>
  Password:  <input id="password" type="password" name="password" />
  <br>
  <br>
  <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>
