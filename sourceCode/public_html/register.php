<?php
$registration=0;
$existEmail=0;
$existName=0;
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

                      $query1 = "SELECT * FROM `user` WHERE userName='$username'";
                      $query2 = "SELECT * FROM `user` WHERE userEmail='$email'";
                      $result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
                      $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
                      $count1 = mysqli_num_rows($result1);
                      $count2 = mysqli_num_rows($result1);

                      if($count1==0){
                        if($count2==0){
                          $query = "INSERT INTO `user` (userName, userPassword, userEmail) VALUES ('$username', '$password', '$email')";
                          $result = mysqli_query($connection, $query);

                          if($result){
                            $registration=1;
                          }
                          }else{
                            $existEmail=1;
                        }
                      }else{
                        $existName=1;
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
