<?php
require 'config/config.php';
if(isset($_SESSION['username'])){//'username is set when the user has logged in'
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else
{
	header("Location: register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Swirl Feed</title>
	<!--Javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src = "assets/js/bootstrap.js"></script>

	<!--CSS-->
	<link rel = "stylesheet" type="text/css" href = "assets/css/bootstrap.css">
	<link rel = "stylesheet" type="text/css" href = "assets/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

	<div class = "top_bar">
		<div class="logo">
			<a href="index.php">Swirlfeed!</a>
		</div>
		<nav>
			<a href="#">
				<?php echo $user['first_name']; ?>
			</a>
			<a href="#">
				<i class="fas fa-home"></i>
			</a>
			<a href="#">
				<i class="fas fa-envelope"></i>
			</a>
			<a href="#">
				<i class="far fa-bell"></i>
			</a>
			<a href="#">
				<i class="fas fa-users"></i>
			</a>
			<a href="#">
				<i class="fas fa-cog"></i>
			</a>
		</nav>
	</div>