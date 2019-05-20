<?php
include("includes/header.php");
$username = "dummmy";
if(isset($_GET['profile_username'])){
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
	if($num_friends < 0) // think reece missed this
	{
		$num_friends = 0;
	}
}

if(isset($_POST['remove_friend'])){
	$user = new User($con, $userLoggedIn);
	$user->removeFriend($username);
}
if(isset($_POST['add_friend']))
{
	$user = new User($con, $userLoggedIn);
	$user->sendRequest($username);
}
if(isset($_POST['respond_request'])){
	header("Location: requests.php");
}

?>
	<style type="text/css">
		.wrapper{/*by experimenting I think this .wrapper is overridng the .wrapper in style.css*/
			margin-left:0px;
			padding-left:0px;
		}
	</style>

	<div class="profile_left">
		<img src="<?php echo $user_array['profile_pic']?>">

		<div class="profile_info">
			<p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
			<p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
			<p><?php echo "Friends: " . $num_friends; ?></p>
		</div>
		<form action="<?php echo $username; ?>" method="POST">
			<?php  
			$profile_user_obj = new User($con, $username);
			if($profile_user_obj->isClosed()){
				header("Location: user_closed.php");
			}

			$logged_in_user_obj = new User($con, $userLoggedIn);
			if($userLoggedIn != $username){
				if($logged_in_user_obj->isFriend($username)){
					echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
				}
				else if($logged_in_user_obj->didReceiveRequest($username)){
					echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
				}
				else if($logged_in_user_obj->didSendRequest($username)){
					echo '<input type="submit" name="" class="default" value="Respond Sent"><br>';
				}
				else
					echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';
			}
			?>		
	</form>
		<!--<input type="submit" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">--><!--don't put this input inside the form-->
		<input type="submit" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">

		<?php
			echo '<div class="profile_info_bottom">';
			echo $logged_in_user_obj->getMutualFriends($username) . " Mutual Friends";
			echo '</div>';
		?>
	</div>


	<div class="profile_main_column column">
		<div class="posts_area"></div>
		<img id="loading" src="assets/images/icons/loading.gif">
	</div>

	<!-- Modal this is the one that was broken!!!! now it's actually fixed and is the same with the following official section!!!-->
	<!--<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Post Something!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	        <p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>

	        <form class="profile_post" action="" method="POST">
	        	<div class="form-group">
	        		<textarea class="form-control" name="post_body"></textarea>
	        		<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
	        		<input type="hidden" name="user_to" value="<?php echo $username; ?>">
	        	</div>
	        </form>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
	      </div>
	    </div>
	  </div>
	</div>
    -->

	<!-- Modal -->
	<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Post Something!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>

	        <form class="profile_post" action="" method="POST">
	        	<div class="form-group">
	        		<textarea class="form-control" name="post_body"></textarea>
	        		<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
	        		<input type="hidden" name="user_to" value="<?php echo $username; ?>">
	        	</div>
		    </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
	var profileUsername = '<?php echo $username; ?>';

	$(document).ready(function(){
		$('#loading').show();

		//Original ajax request for loading first posts
		$.ajax({
			url: "includes/handlers/ajax_load_profile_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
			cache:false,

		   	success: function(data){
		   		$('#loading').hide();
		   		$('.posts_area').html(data);
		   	}
		});

		//New request when scrolled down to the bottom
		$(window).scroll(function(){
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();
			//Big question:
			//1.var height = $('.posts_area').height()/var scroll_top = $(this).scrollTop(); not referenced.
			//2.document.body.scrollTop always return 0, have to use document.documentElement.scrollTop
			//3.sometimes when I scrolled down to the bottom, document.documentElement.scrollTop + window.innerHeight is slightly bigger than document.body.scrollHeight
			//4.here is the concept, indeed this is detecting if the user has scrolled all the way down to the bottom
			//document.body.scrollHeight: the height of the the body, if there's a lot of content than it will be bigger than the window height
			//document.body.scrollTop: how much of document.body.scrollHeight is scrolled away....
			//window.innerHeight: height of the viewport/window height
			//then do the math you should understand the idea
			if((document.body.scrollHeight == /*document.body.scrollTop*/document.documentElement.scrollTop + window.innerHeight) && noMorePosts == 'false') //scrolled to the bottom of the page.
			{
				$('#loading').show();
				$.ajax({
					url: "includes/handlers/ajax_load_profile_posts.php",
					type: "POST",
					data: "page="+ page +"&userLoggedIn=" + userLoggedIn + "$profileUsername=" + profileUsername,
					cache:false,

		   			success: function(response){
		   				$('.posts_area').find('.nextPage').remove(); //Removes current. nextpage
		   				$('.posts_area').find('.noMorePosts').remove(); //Removes current. noMorePosts
		   				$('#loading').hide();
		   				$('.posts_area').append(response);
		   			}
				});
		     } // End if

		     return false;
		}); // End (window).scroll(function())
	});
	</script>
