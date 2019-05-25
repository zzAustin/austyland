<?php 
include("includes/header.php");
/*include("includes/classes/User.php");
include("includes/classes/Post.php");*/

if(isset($_POST['post'])){
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}
?>
	<div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>

		<div class = "user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
	        <?php 
	        echo $user['first_name']. " "  .$user['last_name'];
	        ?>
	    	</a>
	    	<br>
	    	<?php
	    	echo "Posts: ". $user['num_posts']. "<br>";
	    	echo "Likes: ". $user['num_likes'];
	    	?>
    	</div>
	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id = "post_text" placeholder="Got something to say?"> </textarea>
			<input type="submit" name="post" id = "post_button" value="Post">
			<hr>

		</form>

		<div class="posts_area"></div>
		<img id="loading" src="assets/images/icons/loading.gif">
	</div>

	<div class="user_details column">
		<div class="trends">
			<h4>Popular</h4>
			<?php 
				$query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");
				foreach ($query as $row) {
					$word = $row['title'];
					$word_dot = strlen($word) >= 14 ? "..." : "";

					$trimmed_word = str_split($word, 14);
					$trimmed_word = $trimmed_word[0];

					echo "<div style'padding: 1px'>";
					echo $trimmed_word . $word_dot;
					echo "<br></div>";
				}
			 ?>
		</div>
	</div>

	<img src="">

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function(){
		$('#loading').show();

		//Original ajax request for loading first posts
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
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
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page="+ page +"&userLoggedIn=" + userLoggedIn,
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
	</div>
</body>
</html>