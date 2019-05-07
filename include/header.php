<?php
require 'config/config.php';
if(isset($_SESSION['username'])){//'username is set when the user has logged in'
	$userLoggedIn = $_SESSION['username'];
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
</head>
<body>

	<div class = "top_bar">
		<div class="logo">
			<a href="index.php">Swirlfeed!</a>
		</div>
	</div>