<?php
$user = unserialize(urldecode($_GET['user']));
$login = true;

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Book.trade</title>
	<link rel="stylesheet" type="text/css" href="data/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="data/css/index.css" />
</head>

<body>

	<header id="header"><p><?php if($login==true)<a href="data/php/test.php"><img src="data/images/Logo.png" width="200" height="50" alt="Book.trade" /></a></p></header>

	<div id="container">

		<main id="center" class="column">
			<article>

				<h1>Welcome <?php print_r $user; ?></h1>
				<p> I'm pleased to meet you! Well not really, it doesn't matter. By the way this is prototype for booktrade.com. please feel free to roam around until you fed up. Only User account link is working.Check out register and login layout.</p>
			</article>
		</main>

		<nav id="left" class="column">
			<h3>Operations</h3>
			<ul>
				<li><a href="register.php">User Account</a></li>
				<li><a href="#">Browse</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Search</a></li>
			</ul>
			<h3>Manage Account</h3>
			<ul>
				<li><a href="#">Setings</a></li>
				<li><a href="#">Books</a></li>
				<li><a href="#">Sold</a></li>
				<li><a href="#">Bought</a></li>
				<li><a href="#">Traded</a></li>
			</ul>

		</nav>

		<div id="right" class="column">
			<h3>News</h3>
			<p><marquee behavior="scroll" direction="left">Meeting at San's house on Saturday</marquee></p>
			<p><marquee behavior="scroll" direction="left">Noman Working on diagram and chart part.</marquee></p>
			<p><marquee behavior="scroll" direction="left">I'm playing with this YOU KNOW WHAT!</marquee></p>

		</div>

	</div>

	<div id="footer-wrapper">
		<footer id="footer"><p>Thanks for visiting!</p></footer>
	</div>

</body>

</html>
