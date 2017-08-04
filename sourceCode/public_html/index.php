<?php
include 'login.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name = "viewport" content = "user-scalable = yes, width = device-width, maximum-scale = 1, initial-scale = 1" />
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
          <li><a href="#">Books</a>

            <ul>
              <li><a href="#bookList">Book List</a></li>
              <li><a href="#newBooks">New Books</a></li>
            </ul>

          </li>
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
      <p>Welcome!</p><br>
    </div>


    <!--Adding New Books-->
    <div id="newBooks" class="newBooks">
      <form id="newBooks" class="newBooks" method="post">

        <table>
          <tr>
            <td align="right">Book Name:</td>
            <td align="left"><input id="newbookname"type="text" name="newbookname" /></td>
          </tr>

          <tr>
            <td align="right">Book Auther:</td>
            <td align="left"> <input id="newbookauther"type="text" name="newbookauther" /></td>
          </tr>

          <tr>
            <td align="right">ISBN:</td>
            <td align="left"><input id="newbookisbn" type="text" name="newbookosbn" /></td>
          </tr>

          <tr>
            <td align="right">Book Condition:</td>
            <td align="left"><input id="bookcondition" type="text" name="bookcondition" /></td>
          </tr>

          <tr>
            <td align="right"></td>
            <td align="left"><input type="submit" name="addbook" value="Add Book" /></td>
          </tr>
        </table>

      </form>
    </div>



    <!--Login-->
    <div id="loginContent" class="loginContent">
      <form method="post">
        <h2>Login</h2>
        <p class = "warning">Invalid credentials!</p>

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

        <p class = "warning">All fields required!</p>
        <p class = "warning">
          Username must be between 4 to 12 characters!<br>
          Username should not start with a number nor with a space!
        </p>
        <p class = "warning">
          Password did not match!
        </p>
        <p class = "warning">
          Password invalid!<br>
          Password must be alphanumeric containing at least one symbol!<br>
          Password must be between 6 to 12 characters!
        </p>
        <p class = "warning">
          Given username already exists!<br>
        </p>
        <p class = "warning">
          Given email already exists!<br>
        </p>
        <p style="color:darkgreen;">
          Regisrtation successful!!!<br>
        </p>

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
        <p>Do you really wanna logout??</p>
        <input type="submit" name="logoutYes" value="Yes!" />
        <input type="submit" name="logoutNo" value="No I wanna Stay!" />
      </form>

    </div>

    <!--Current Books-->
    <div id="bookList" class="bookList">
      <form method="post" id="bookList" class="bookList">

        <table>
          <tr>
            <td align="right">List Name:</td>
            <td align="left"><input id="newlistname"type="text" name="newlistname" /></td>
          </tr>

          <tr>
            <td align="right"></td>
            <td align="left"> <input id="emailsignup" type="text" name="emailsignup" /></td>
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

  </div>
</body>
</html>
