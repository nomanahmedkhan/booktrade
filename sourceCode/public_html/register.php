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

// If the values are posted, insert them into the database.
if (isset($_POST['usernamesignup']) && isset($_POST['passwordsignup'])){

  if($_POST['passwordsignup'] !== $_POST['passwordsignup_confirm']) {
    $passwordMissMatch = true;
  } else {

    $username = $_POST['usernamesignup'];
    $email = $_POST['emailsignup'];
    $password = $_POST['passwordsignup'];
    $query = "INSERT INTO `user` (userName, userPassword, userEmail) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($connection, $query);

    if($result){
      $success = true;
      header('Location: login.php');
    }
  }
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
<title>Resgister | Booktrade</title>
</head>
<body style="background-color:#ccc;">
  <a style="color:black;text-decoration:none;" href="index.html"><h1>Book.trade</h1></a>
  <h2>Register</h2>
  <br>
  <form method="post">
  Username:  <input id="usernamesignmup"type="text" name="usernamesignup" />
  <br>
  Email:     <input id="emailsignmup"type="text" name="emailsignup" />
  <br>
  Password:  <input id="passwordsignup" type="password" name="passwordsignup" />
  <br>
  Confirm Password:  <input id="passwordsignup_confirm" type="password" name="passwordsignup_confirm" />
  <br>
  <br>
  <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>
