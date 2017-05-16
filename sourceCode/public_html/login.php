  <?php
  session_start();
  $success=1;
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
      $_SESSION["activeuser"]=$username;
      header('location: /#home');
    }elseif ($count ==0) {
      $success = 0;
    }
    }

  ?>
