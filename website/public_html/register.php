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
    $query = "INSERT INTO `user` (username, password, email) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($connection, $query);

    if($result){
      $success = true;
      header('Location: http://booktrade.com/register.php#tologin/');
    }
  }
}
if(isset($_POST['username']) && isset($_POST['password'])){
  //3. If the form is submitted or not.
  //3.1 If the form is submitted
  if (isset($_POST['username']) and isset($_POST['password'])){
  //3.1.1 Assigning posted values to variables.
  $username = $_POST['username'];
  $password = $_POST['password'];
  //3.1.2 Checking the values are existing in the database or not
  $query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";

  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $count = mysqli_num_rows($result);
  //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
  if ($count == 1){
    $login =true;
    header("Location: http://booktrade.com/account.php?user=" . urlencode(serialize($username)));
  }else{
    $login =false;
  }
  }


}
 else {
  $success = null;
  $login = null;
}

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Account</title>

        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="data/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="data/css/register.css" />
		<link rel="stylesheet" type="text/css" href="data/css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
						<header id="header"><p><a href="index.html"><img src="data/images/Logo.png" width="200" height="50" alt="Book.trade" /></a></p></header>
            <section>
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump   -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">


                        <div id="login" class="animate form">
                            <form method ="post" action="data/php/login.php" >

                                <?php  if($login===false):?>
                                  <h1>Incorrect Details!</h1>
                                <?php else:?>
                                  <h1>Log in</h1>
                                <?php endif;?>
                                <p>
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="Name or E-mail"/>
                                </p>
                                <p>
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="Password" />
                                </p>
                                <p class="keeplogin">
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                <p class="login button">
                                    <input type="submit" value="Login" />
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>
                        <div id="register" class="animate form">
													<form method ="post" >
                              <h1>Sign up!</h1>
                                <p>
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="Name" />
                                </p>
                                <p>
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="E-mail"/>
                                </p>
                                <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="Confirm Password"/>
                                </p>
                                <p class="signin button">
									<input type="submit" value="Sign up"/>
								</p>
                                <p class="change_link">
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>

                     </div>
                </div>
            </section>
        </div>
    </body>
</html>
