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

$passwordMissMatch = false;
$usernameValid = true;
$passwordValid = true;
$formValid = true;
// If the values are posted, insert them into the database.
if (isset($_POST['usernamesignup']) && isset($_POST['passwordsignup']) && isset($_POST['emailsignup'])){

  if (($_POST['usernamesignup']!= null) &&
      ($_POST['passwordsignup']!=null) &&
      ($_POST['emailsignup']!=null)){

        if((strlen($_POST['usernamesignup'])<21) &&
           (strlen($_POST['usernamesignup'])>3) &&
           (preg_match("/".mb_substr($_POST['usernamesignup'],0,1)."/",('/[0-9]/')))!= 1){

             if((strlen($_POST['passwordsignup'])<21) &&
                (strlen($_POST['passwordsignup'])>5) &&
                (preg_match('/[A-Z]/',$_POST['passwordsignup'])) &&
                (preg_match('/[a-z]/',$_POST['passwordsignup'])) &&
                (preg_match('/[0-9]/',$_POST['passwordsignup'])) &&
                (preg_match('/[\W]+/',$_POST['passwordsignup']))){

                  if($_POST['passwordsignup'] == $_POST['passwordsignup_confirm']) {

                      $username = $_POST['usernamesignup'];
                      $email = $_POST['emailsignup'];
                      $password = $_POST['passwordsignup'];
                      $query = "INSERT INTO `user` (userName, userPassword, userEmail) VALUES ('$username', '$password', '$email')";
                      $result = mysqli_query($connection, $query);

                      if($result){
                        header('Location: login.php');
                      }

}else{
  $passwordMissMatch = true;
}
}else{
  $passwordValid = false;
}
}else {
    $usernameValid = false;
}
}else{
  $formValid =false;
}
}
?>

<html>
<head>
<title>Resgister | Booktrade</title>
</head>
<body style="background-color:#ccc;">
  <a style="color:black;text-decoration:none;" href="index.html"><h1>Book.trade</h1></a>
  <h2>Register</h2>
  <br>
  <form method="post">
    <?php if($formValid==false): ?>
      <h3 style="color:darkred;">All fields required!</h3>
    <?php elseif($usernameValid==false): ?>
        <h3 style="color:darkred;">
          Username not available!<br>
          Username must be between 4 to 12 characters!<br>
          Username should not start with a number nor with a space!
        </h3>
    <?php elseif($passwordMissMatch == true): ?>
        <h3 style="color:darkred;">
          Password did not match!
        </h3>
    <?php elseif($passwordValid == false): ?>
        <h3 style="color:darkred;">
          Password invalid!<br>
          Password must be alphanumeric containing at least one symbol!<br>
          Password must be between 6 to 12 characters!
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
    <td align="right"></td><td align="left"><input type="submit" name="submit" value="Submit" /></td>
  </table>
  </form>
</body>
</html>
