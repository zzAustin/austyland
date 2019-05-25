<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");

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
	<script src = "assets/js/bootbox.min.js"></script>
	<script src = "assets/js/austyland.js"></script>
	<script src = "assets/js/jquery.jcrop.js"></script>
	<script src = "assets/js/jcrop_bits.js"></script>


	<!--CSS-->
	<link rel = "stylesheet" type="text/css" href = "assets/css/bootstrap.css">
	<link rel = "stylesheet" type="text/css" href = "assets/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link  rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css">
</head>
<body>

	<div class = "top_bar">
		<div class="logo">
			<a href="index.php">Swirlfeed!</a>
		</div>

		<div class="search">
			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

				<div class = "button_holder">
					<img src="assets/images/icons/magnifying_glass.png">
				</div>
				
			</form>

			<div class="search_results">
				
			</div>

			<div class="search_results_footer_empty">
				
			</div>
			
		</div>
		<nav>
			<?php 	
			// Unread messages
			$messages = new Message($con, $userLoggedIn);
			$num_messages = $messages->getUnreadNumber();

			// Unread notifications
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();

			// Unread notifications
			$user_obj = new User($con, $userLoggedIn);
			$num_requests = $user_obj->getNumberOfFriendRequests();
			 ?>

			<a href="<?php echo $userLoggedIn; ?>">
				<?php echo $user['first_name']; ?>
			</a>
			<a href="#">
				<i class="fas fa-home"></i>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
				<i class="fas fa-envelope"></i>
				<?php
				if($num_messages > 0)
					echo '<span class="notification_badge" id="unread_message">'.$num_messages.'</span>';
				?>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
				<i class="far fa-bell"></i>
				<?php
				if($num_notifications > 0)
					echo '<span class="notification_badge" id="unread_notification">'.$num_notifications.'</span>';
				?>
			</a>
			<a href="requests.php">
				<i class="fas fa-users"></i>
				<?php
				if($num_requests > 0)
					echo '<span class="notification_badge" id="unread_requests">'.$num_requests.'</span>';
				?>
			</a>
			<a href="settings.php">
				<i class="fas fa-cog"></i>
			</a>
			<a href="includes/handlers/logout.php">
				<i class="fas fa-sign-out-alt"></i>
			</a>
		</nav>

		<div class="dropdown_data_window" style="height:0px; border:none;"></div><!--note the message drop down is dependant on this height property.. and border will affect it too-->
		<input type="hidden" id="dropdown_data_type" value="">
	</div>

	 <script>
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';

		$(document).ready(function(){
			//New request when scrolled down to the bottom
			$('.dropdown_data_window').scroll(function(){
				var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing posts
				var scroll_top = $('.dropdown_data_window').scrollTop();
				var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
				var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();
				//Big question:
				//1.var height = $('.posts_area').height()/var scroll_top = $(this).scrollTop(); not referenced.
				//2.document.body.scrollTop always return 0, have to use document.documentElement.scrollTop
				//3.sometimes when I scrolled down to the bottom, document.documentElement.scrollTop + window.innerHeight is slightly bigger than document.body.scrollHeight
				//4.here is the concept, indeed this is detecting if the user has scrolled all the way down to the bottom
				//document.body.scrollHeight: the height of the the body, if there's a lot of content than it will be bigger than the window height
				//document.body.scrollTop: how much of document.body.scrollHeight is scrolled away....
				//window.innerHeight: height of the viewport/window height
				//then do the math you should understand the idea
				//console.log("scroll_top:" + scroll_top+",inner_height:"+inner_height+",dropdownscrollheight:"+$('.dropdown_data_window')[0].scrollHeight);
				if((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') //scrolled to the bottom of the page.
				{
					//unsovled problem here: when you scroll, we can enter here several times before the first ajax response, then the loaded content will have issues!!!
					//console.log("Page:"+page+",NomoreData:"+noMoreData);
					//console.log("scroll_top:" + scroll_top+",inner_height:"+inner_height+",dropdownscrollheight:"+$('.dropdown_data_window')[0].scrollHeight);
					
					var pageName; //Holds name of page to send ajax request to
					var type = $('#dropdown_data_type').val();

					if(type == 'notification')
						pageName = "ajax_load_notifications.php";
					else if(type == 'message' )
						pageName = "ajax_load_messages.php";

					var ajaxReq = $.ajax({
						url: "includes/handlers/" + pageName,
						type: "POST",
						data: "page="+ page +"&userLoggedIn=" + userLoggedIn,
						cache:false,

			   			success: function(response){
			   				$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current. nextpage
			   				$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current. noMorePosts

			   				$('.dropdown_data_window').append(response);
			   			}
					});
			     } // End if

			     return false;
			}); // End (window).scroll(function())
		});
	</script>
	<div class="wrapper"> <!--this div is closed in index.php-->