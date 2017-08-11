<?php
include_once 'globalVars.php';
include_once 'functions.php';
include_once 'login.php';
include_once 'register.php';
include_once 'logout.php';
include_once 'booklist.php';
include_once 'addbooks.php';
include_once 'deletebook.php';
include_once 'library.php';

SESSION_START();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name = "viewport" content = "user-scalable = yes, width = device-width, maximum-scale = 2, initial-scale = 1" />
  <meta name = "apple-mobile-web-app-capable" content = "yes" />
  <meta name = "description" content = "Book trading platform for students, book-lovers and bookworms. Trading books are in physical form, not an E-Book.">
  <meta name = "keywords" content = "Book, trade, book trade, Physical Books, Buy Books, Sell Books, Trade Books">

  <link rel = "stylesheet" type = "text/css" href = "data/css/style.css">
  <title>Book.trade</title>
</head>
<body>

  <!--Fixed Top Bar-->
  <div id="topBar" class="topBar">
    <a id="title" href="#home">Book.trade</a>

    <ul>
      <li><a href="#libraryContent">Library</a></li>
      <li><a href="#">Books</a>

        <ul>
          <li><a href="#bookList">Book List</a></li>
          <li><a href="#newBooks">New Books</a></li>
        </ul>

      </li>
      <li><a>Account</a>

        <ul>
          <li><a href="#registerContent">Register</a></li>
          <li><a href="#loginContent">Login</a></li>
        </ul>

      </li>
      <li><a>user</a>

        <ul>
          <li><a href="#logoutContent">Logout</a></li>
        </ul>

      </li>
    </ul>

  </div>


  <!--Scrollable Page-->
  <div id="content" class="content">

    <!--Welcome Page-->
    <div id="home" class="home">
      <p>Welcome!
        <?php if(isset($_SESSION["username"])){echo $_SESSION["username"];}?></p><br>
    </div>


    <!--Library Content-->
    <div id="libraryContent" class="libraryContent">
      <table>
        <thead>
        <tr>
          <th >User</th>
          <th >Book Name</th>
          <th >Book Price</th>
          <th >Trade Condition</th>
        </tr>
      </thead>
      <form>
      <tbody>
        <?php foreach ($library as $library1){ ?>
        <tr>
          <td ><?php echo $library1['userName'];?></td>
          <td ><?php echo $library1['bookName'];?></td>
          <td ><?php echo $library1['bookPrice'];?></td>
          <td ><?php echo $library1['tradeCondition'];?></td>
        </tr>
        <?php }?>
      </tbody>
    </form>
      </table>
    </div>


    <!--Adding New Books-->
    <div id="newBooks" class="newBooks">
      <form id="newBooks" class="newBooks" method="post">
        <h2>Add New Books</h2>
        <table>
          <tr>
            <td align="right">Book Name:</td>
            <td align="left"><input id="newBookName"type="text" name="newBookName" /></td>
          </tr>

          <tr>
            <td align="right">Book Price:</td>
            <td align="left"> <input id="newBookPrice"type="text" name="newBookPrice" /></td>
          </tr>


          <tr>
            <td align="right">Book Trade Condition:</td>
            <td align="left"><input id="bookTradeCondition" type="text"  name="bookTradeCondition" /></td>
          </tr>

          <tr>
            <td align="right"></td>
            <td align="left"><input id="addbook" type="submit" name="addbook" value="Add Book" /></td>
          </tr>
        </table>

      </form>
    </div>



    <!--Login-->
    <div id="loginContent" class="loginContent">
      <form method="post">
        <h2>Login</h2>
        <?php if($loginFailed===true):?><p class = "warning">Invalid credentials!</p><?php endif;?>

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
      <form method="post">
        <h2>Register</h2>

        <?php if($emptyRegisterFields === TRUE):?><p class = "warning">All fields required!</p><?php endif;?>

        <?php if(1===2):?><p class = "warning">
          Username must be between 4 to 12 characters!<br>
          Username should not start with a number nor with a space!
        </p><?php endif;?>

        <?php if($passwordMatched === FALSE):?>
          <p class = "warning">
          Password did not match!
        </p><?php endif;?>


        <?php if(1===2):?>
        <p class = "warning">
          Password invalid!<br>
          Password must be alphanumeric containing at least one symbol!<br>
          Password must be between 6 to 12 characters!
        </p><?php endif;?>

        <?php if($userNameExists === TRUE):?>
        <p class = "warning">
          Given username already exists!<br>
        </p><?php endif;?>

        <?php if($emailExists === TRUE):?>
        <p class = "warning">
          Given email already exists!<br>
        </p><?php endif;?>


        <?php if($registrationSuccessful === TRUE):?>
        <p style="color:darkgreen;">
          Regisrtation successful!!!<br>
        </p><?php endif;?>

        <table>
          <tr>
            <td align="right">Username:</td>
            <td align="left"><input id="usernamesignup"type="text" name="usernamesignup" /></td>
          </tr>

          <tr>
            <td align="right">Email:</td>
            <td align="left"> <input id="emailsignup"type="text" name="emailsignup" /></td>
          </tr>

          <tr>
            <td align="right">Password:</td>
            <td align="left"><input id="passwordsignup" type="password" name="passwordsignup" /></td>
          </tr>

          <tr>
            <td align="right">Confirm Password:</td>
            <td align="left"><input id="passwordsignup_confirm" type="password" name="passwordsignup_confirm" /></td>
          </tr>

          <tr>
            <td align="right"></td>
            <td align="left"><input type="submit" name="submit" value="Register!" /></td>
          </tr>
        </table>

      </form>
    </div>



    <!--Logout-->
    <div id="logoutContent" class="logoutContent">

      <form method="post">
        <h2>Log Out</h2>
        <p>Do you really wanna logout??</p>
        <input type="submit" id="logoutYes" name="logoutYes" value="Yes!" />
        <input type="submit" id="logoutNo" name="logoutNo" value="No I wanna Stay!" />
      </form>

    </div>

    <!--Current Books-->
    <div id="bookList" class="bookList">
      <table>
        <thead>
        <tr>
          <th >Book Name</th>
          <th >Book Price</th>
          <th >Trade Condition</th>
          <th >Action</th>
        </tr>
      </thead>
      <form method="post">
      <tbody>
        <?php foreach ($bookList as $book) {?>
        <tr>
          <td ><?php echo $book['bookName'];?></td>
          <td ><?php echo $book['bookPrice'];?></td>
          <td ><?php echo $book['tradeCondition'];?></td>
          <td ><button type="submit" name="delete" id="delete" value='<?php echo htmlspecialchars($count)?>'>Delete!</button></td>
        </tr>
        <?php $count=$count+1;}?>
      </tbody>
    </form>
      </table>
    </div>

  </div>
</body>
</html>
