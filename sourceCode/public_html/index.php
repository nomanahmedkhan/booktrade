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
include_once 'adminusers.php';
include_once 'deleteuser.php';
include_once 'deletelibrary.php';
include_once 'sendproposal.php';
include_once 'retrieveproposal.php';
include_once 'deleteMessage.php';
include_once 'nomanIndex.php';
SESSION_START();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
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
    <a id="title" active="active" href="#home">Book.trade</a>
    <ul>
      <li><a href="#libraryContent">Library</a></li>
      <?php if(isset($_SESSION["userLoggedin"])):?>


        <li><a href="#">Books</a>

          <ul>
            <li><a href="#userBooks">Book List</a></li>
            <li><a href="#newBooks">New Books</a></li>
          </ul>

        </li>
        <li><a>User</a>

          <ul>
            <li><a href="#logoutContent">Logout</a></li>
            <?php if(isset($_SESSION["username"])):?>
              <?php if($_SESSION["username"] === "noman"):?>
                <li><a href ="#adminPage">Admin Tool</a></li>
              <?php endif; ?>
            <?php endif; ?>
          </ul>

        </li>
      <li><a href="#inbox">Inbox</a></li>
      <?php else:?>
        <li><a>Account</a>

          <ul>
            <li><a href="#registerContent">Register</a></li>
            <li><a href="#loginContent">Login</a></li>
          </ul>

        </li>
      <?php endif;?>
    </ul>

  </div>


  <!--SideBar-->
  <div id="sideBar" class="sideBar">

    <!--Library filter-->
    <div id="libraryFilter" class="libraryFilter">
      <form id="filter" method = "post">
        <table align="center">
          <tr><td><h3>Filter Books</h3></td></tr>
          <tr><td><button type="submit" name="filterLibrary"  value="all"> All</button></td></tr>
          <tr><td><button type="submit" name="filterLibrary" value="trade"> Trade</button></td></tr>
          <tr><td><button type="submit" name="filterLibrary" value="buy"> Purchase</button></td></tr>
        </table>
      </form>
    </div>




  </div>

  <!--Scrollable Page-->
  <div id="content" class="content">


      <!--Admin's control page-->
      <div id="adminPage" class="adminPage">
        <form method = "post" >
          <table>
            <thead>
              <tr>
                <th >Username</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user){ ?>
                <tr>
                  <td ><?php echo $user['userName'];?></td>
                  <td ><button type="submit" name="deleteUser" id="deleteUser" value='<?php echo htmlspecialchars($count2)?>'>Delete!</button></td>
                </tr>
                <?php $count2 = $count2 + 1; }?>
              </tbody>
            </table>
          </form>
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

                <?php if(isset($_SESSION["username"])):?>
                  <?php if($_SESSION["username"] === "noman"):?>
                    <th >Admin Action</th>
                  <?php endif; ?>
                <?php endif; ?>
                  <th colspan="2">Action</th>

              </tr>
            </thead>

            <tbody>
              <form method="post">
                <?php foreach ($library as $library1){ ?>
                  <tr>
                    <td ><?php echo $library1['userName'];?></td>
                    <td ><?php echo $library1['bookName'];?></td>
                    <td ><?php echo $library1['bookPrice'];?></td>
                    <td ><?php echo $library1['tradeCondition'];?></td>


                    <?php if(isset($_SESSION["username"])):?>
                      <?php if($_SESSION["username"] === "noman"):?>
                        <td><button type="submit" name="adminDeleteBook" id="adminDeleteBook" value='<?php echo htmlspecialchars($count3)?>'>Delete!</button></td>
                      <?php endif; ?>
                    <?php endif; ?>

                      <td>
                      <?php if($library1['bookPrice'] > 0 ):?>
                        <button type="submit"  name="buyBook" id="buyBook" value='<?php echo htmlspecialchars($count3)?>'>BUY!</button>
                      <?php endif; ?>
                      </td>

                      <td>
                      <?php if(strcmp($library1['tradeCondition'],"none") !== 0 ):?>
                        <form id="tradeForm" method="post">
                            <button type="submit" name="proposalButton" value='<?php echo htmlspecialchars($count3)?>'>Trade!</button>
                          </form>
                        <?php endif; ?>
                      </td>


                  </tr>
                  <?php $count3 = $count3 + 1; }?>
                </form>
              </tbody>
            </table>
          </div>

          <!-- Retrieve Proposal -->
          <div id="inbox" class="inbox">
          <p class="titleLine">Inbox</p>
          <table>
          <thead>
          <tr>
          <?php if(isset($_POST['reply'])):?>
            <th>To</th>
            <th>Message</th>
            <th>Action</th>
          <?php elseif(isset($_POST['sendReply'])):?>
            <th>From</th>
            <th>Message</th>
            <th colspan="2">Action</th>
          <?php else:?>
            <th>From</th>
            <th>Message</th>
            <th colspan="2">Action</th>
          <?php endif;?>
          </tr>
          </thead>


          <form method="post">
            <tbody>
              <?php foreach ($messages as $msg) {?>
                <tr>
                  <?php if(isset($_POST['reply'])):?>
                    <?php if($_POST['reply']+1  === $count5 || $_POST['reply']  === $count5):?>
                      <td><input type="text" name="replyToUsername" id="replyToUsername"  value='<?php echo $replyToUsername[$oldCount1] ?>'/></td>
                      <td><input type="text" name="replyMessage" id="replyMessage"/></td>
                      <td ><button type="submit" name="sendReply" id="sendReply" value='<?php echo htmlspecialchars($count5)?>'>Send</button></td>
                    <?php endif;?>

                  <?php elseif(isset($_POST['sendReply'])):?>
                    <td ><?php echo $msg['fromUsername'];?></td>
                    <td ><?php echo $msg['message'];?></td>
                    <td ><button type="submit" name="reply" id="reply" value='<?php echo htmlspecialchars($count5)?>'>Reply</button></td>
                    <td ><button type="submit" name="deleteMessage" id="deleteMessage" value='<?php echo htmlspecialchars($count5)?>'>Delete!</button></td>

                  <?php else:?>
                    <td ><?php echo $msg['fromUsername'];?></td>
                    <td ><?php echo $msg['message'];?></td>
                    <td ><button type="submit" name="reply" id="reply" value='<?php echo htmlspecialchars($count5)?>'>Reply</button></td>
                    <td ><button type="submit" name="deleteMessage" id="deleteMessage" value='<?php echo htmlspecialchars($count5)?>'>Delete!</button></td>
                  <?php endif;?>
                </tr>
                <?php $replyToUsername[$count5] = $msg['fromUsername'] ?>
                <?php $oldCount1 = $count5; $count5=$count5+1;}?>
              </tbody>
            </form>
          </table>
          </div>



            <!--Adding New Books-->
            <div id="newBooks" class="newBooks">
              <form id="newBooks" class="newBooks" method="post">
                <table>
                  <p class="titleLine">Add New Books</p>
                  <tbody>
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
                    <td align="left"><button id="addbook" type="submit" name="addbook" />Add Book</button></td>
                  </tr>
                </tbody>
                </table>

              </form>
            </div>

            <!-- Send trade propsal -->
            <div id="tradePage" class="tradePage">
              <form method="post">
                <table>
                  <p class="titleLine">Send Trade Proposal</p>
                  <tbody>
                  <tr>
                    <td align="right">To User:</td>
                    <td align="left"><?php echo $library['userName']?></td>
                  </tr>

                  <tr>
                    <td align="right">For Book:</td>
                    <td align="left"> <?php echo $library['bookName']?></td>
                  </tr>


                  <tr>
                    <td align="right">Enter Your Book Trade Condition:</td>
                    <td align="left"><input id="bookTradeCondition" type="text"  name="bookTradeCondition" /></td>
                  </tr>

                  <tr>
                    <td align="right"></td>
                    <td align="left"><button id="addbook" type="submit" name="addbook" />Send</button></td>
                  </tr>
                </tbody>
                </table>

              </form>
            </div>



            <!--Login-->
            <div id="loginContent" class="loginContent">
              <form method="post">
                <p id="titleLine" class="titleLine">Login</p>
                <?php if($loginFailed===true):?><p class = "warning">Invalid credentials!</p><?php endif;?>
                <table>
                  <thead>
                  </thead>
                  <tbody>
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
                      <td align="left"><button type="submit" name="submit" value="Submit" >Submit</button></td>
                    </tr>
                  </tbody>
                </table>

              </form>
            </div>




            <!--register content-->
            <div id="registerContent" class="registerContent" >
              <form method="post">
                <p class="titleLine">Register</p>

                <?php if($emptyRegisterFields === TRUE):?>
                  <p class = "warning">All fields required!</p>
                <?php endif;?>

                <?php if($userNameLengthValid === FALSE):?>
                  <p class = "warning">Username must be between 4 to 12 characters!<br></p>
                <?php endif;?>

                <?php if($userFirstCharValid === FALSE):?>
                  <p class = "warning">Username should not start with a number nor with a space!</p>
                <?php endif;?>

                <?php if($passwordMatched === FALSE):?>
                  <p class = "warning">Password did not match!</p>
                <?php endif;?>

                <?php if($passwordValid === FALSE):?>
                  <p class = "warning">
                    Password must be alphanumeric containing at least one symbol!<br>
                  </p><?php endif;?>

                  <?php if($passwordLengthValid === FALSE):?>
                    <p class = "warning">Password must be between 6 to 12 characters!</p>
                  <?php endif;?>

                  <?php if($userNameExists === TRUE):?>
                    <p class = "warning">Given username already exists!<br></p>
                  <?php endif;?>

                  <?php if($emailExists === TRUE):?>
                    <p class = "warning">Given email already exists!<br></p>
                  <?php endif;?>

                  <?php if($registrationSuccessful === TRUE):?>
                    <p style="color:darkgreen;">Regisrtation successful!!!<br></p>
                  <?php endif;?>

                  <?php if($isMailDone === TRUE):?>
                    <p style="color:darkgreen;">An email is sent to your account please check to verify your registration.<br></p>
                  <?php elseif($isMailDone === FALSE):?>
                    <p class = "warning">Email not valid!<br></p>
                  <?php endif;?>

                  <table>
                    <thead></thead>
                    <tbody>
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
                        <td align="left"><button type="submit" name="submit"/>Register</button></td>
                      </tr>
                    </tbody>
                  </table>

                </form>
              </div>



              <!--Logout-->
              <div id="logoutContent" class="logoutContent">

                <form method="post">
                  <p class="titleLine">Log Out</p>
                  <table>
                    <thead>
                    </thead>
                    <tbody>
                      <tr><td><button type="submit" id="logoutYes" name="logoutYes" >Yes!</button>
                        <button type="submit" id="logoutNo" name="logoutNo" >No!</button></td></tr>
                      </form>
                    </tbody>
                  </table>

                    </div>

                    <!--Current Books-->
                    <div id="userBooks" class="userBooks">
                      <table>
                        <thead>
                          <tr>
                            <th >Book Name</th>
                            <th >Book Price</th>
                            <th >Trade Condition</th>
                            <?php if(isset($_POST['edit'])):?>
                              <th >Action</th>
                              <?php elseif(isset($_POST['updateBook'])):?>
                             <th colspan="2">Action</th>
                            <?php else:?>
                              <th colspan="2">Action</th>
                             <?php endif;?>

                          </tr>
                        </thead>
                        <form method="post">
                          <tbody>
                            <?php foreach ($bookList as $book) {?>
                              <tr>
                                <?php if(isset($_POST['edit'])):?>
                                  <?php if($_POST['edit']+1  === $count || $_POST['edit']  === $count):?>
                                    <td><input type="text" name="editedBookName" id="editedBookName" value='<?php echo $oldBookName[$oldCount] ?>' /></td>
                                    <td><input type="text" name="editedBookPrice" id="editedBookPrice" value='<?php echo $oldBookPrice[$oldCount] ?>' /></td>
                                    <td><input type="text" name="editedBookCondition" id="editedBookCondition" value='<?php echo $oldBookTradeCondition[$oldCount] ?>' /></td>
                                    <td ><button type="submit" name="updateBook" id="updateBook" value='<?php echo htmlspecialchars($count)?>'>Save</button></td>
                                  <?php endif;?>
                                <?php elseif(isset($_POST['updateBook']) and strcmp($book['bookName'],"") !== 0 and strcmp($book['bookPrice'],"") !== 0 and strcmp($book['tradeCondition'],"") !== 0 ):?>
                                  <td ><?php echo $book['bookName'];?></td>
                                  <td ><?php echo $book['bookPrice'];?></td>
                                  <td ><?php echo $book['tradeCondition'];?></td>
                                  <td ><button type="submit" name="delete" id="delete" value='<?php echo htmlspecialchars($count)?>'>Delete</button></td>
                                  <td ><button type="submit" name="edit" id="edit" value='<?php echo htmlspecialchars($count)?>'>Edit</button></td>
                                <?php elseif(strcmp($book['bookName'],"") !== 0 and strcmp($book['bookPrice'],"") !== 0 and strcmp($book['tradeCondition'],"") !== 0):?>
                                <td ><?php echo $book['bookName'];?></td>
                                <td ><?php echo $book['bookPrice'];?></td>
                                <td ><?php echo $book['tradeCondition'];?></td>
                                <td ><button type="submit" name="delete" id="delete" value='<?php echo htmlspecialchars($count)?>'>Delete</button></td>
                                <td ><button type="submit" name="edit" id="edit" value='<?php echo htmlspecialchars($count)?>'>Edit</button></td>
                                <?php endif;?>
                              </tr>
                              <?php $oldBookName[$count] = $book['bookName']; $oldBookPrice[$count] = $book['bookPrice']; $oldBookTradeCondition[$count] = $book['tradeCondition']; ?>
                              <?php $oldCount=$count; $count=$count+1;}?>
                            </tbody>
                          </form>
                        </table>
                      </div>

                      <!--Welcome Page-->
                      <div id="home" class="home">
                        <p id="welcomeLine">Welcome to the Book.Trade! <?php if(isset($_SESSION["username"])){echo $_SESSION["username"];}?></p><br>
                        </div>





                    </div>
                  </body>
                  </html>
