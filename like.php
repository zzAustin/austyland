<!DOCTYPE html>
<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");


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
<html>
<head>
	<title></title>
	<link rel = "stylesheet" type="text/css" href = "assets/css/style.css">
</head>
<body>
	<?php
	//Get id of post
	if(isset($_GET['post_id'])){
		$post_id = $_GET['post_id'];
	}

	$get_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($get_likes);
	$total_likes = $row['likes'];
	$user_liked = $row['added_by'];

	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_liked'");
	$row = mysqli_fetch_array($user_details_query);

	// Like button

	// Unlike button

	// Check for previous likes
	$check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	$num_rows = mysqli_num_rows($check_query);
	if($num_rows > 0){
		echo '';
	}
	else{
		echo '';
	}

	?>

</body>
</html>