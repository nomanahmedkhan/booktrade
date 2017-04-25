<?php
$user = unserialize(urldecode($_GET['user']));
?>


<!DOCTYPE html>
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
<title>Book.trade</title>
</head>
<body style="background-color:#ccc;">
  <table style="margin:0px 100px 0px 100px;">

      <tr>
        <td align="center" colspan="6"><a style="color:black;text-decoration:none;" href="index.html"><h1>Book.trade</h1></a></td>
      </tr>

      <tr>
          <td  valign="top" align="left" colspan="1" style="text-decoration:none;">
            <h3 align="center">Operations</h3>
        		<ul>
        			<li><a href="#">Donate</a></li>
        			<li><a href="#">Browse</a></li>
        			<li><a href="#">Categories</a></li>
        			<li><a href="#">Search</a></li>
        			<li><a href="#">Setings</a></li>
        			<li><a href="#">Bought</a></li>
        			<li><a href="#">Traded</a></li>
        		</ul>
						<br>
        		<h3>Account</h3>
        		<ul>
        			<li><a href="index.html">Log out</a></li>
        		</ul>
          </td>

          <td valign ="top" colspan="4">
            <h2 align="center">Welcome <?php echo $user; ?></h2>
        		<p align="justify" style="margin:20px;"></t>I'm pleased to meet you! Well not really, it doesn't matter. By the way this is prototype for booktrade.com. please feel free to roam around until you fed up. Only User account link is working.Check out register and login layout.</p>
          </td>

          <td valign="top" align="center" colspan="1" width="5em">
            <h3>News</h3>
        		<p><marquee behavior="scroll" direction="down">
              Software Development Project A2 has been submitted!
            </marquee></p>
          </td>
      </tr>

      <tr>
          <td valign="bottom" align="center" colspan="6">
            <p>Thanks for visiting!</p>
          </td>
      </tr>
  </table>

</body>
</html>
