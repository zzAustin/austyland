<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");

$limit = 10; //Number of posts to be loaded per call

$posts = new Post($con, $_REQUEST['userLoggedIn']);// through ajax call, we use $_REQUEST instead of $_POST or $_GET
$posts->loadPostsFriends($_REQUEST, $limit);
?>