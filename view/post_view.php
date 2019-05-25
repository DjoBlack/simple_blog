<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
</head>
<body>
	<div>
		<a href="/">Home</a>
		<?php if((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] == $post->user_id)) { ?>
			<form method="POST" action="/index.php?r=/post/delete">
				<input type="hidden" name="id" value="<?php echo $post->id; ?>"><br>
				<input type="submit" value="Delete Post">
			</form>
		<?php } ?>
	</div>
	<div>
		<?php if(!empty($post)) { ?>
			<h2><?php echo $post->title; ?></h2>
			<a href="user_posts.php?user_id=<?php echo $post->user_id; ?>">
				<?php echo $post->email; ?>
			</a>
			 - 
			<?php echo $post->date; ?></h5>
			<div><?php echo $post->body; ?></div>
		<?php } else { ?>
				Post is not found!
		<?php } ?>
	</div>
	<div id="comments-section">
		<h3>Comments:</h3>
		<?php if(!empty($comments)) { ?>
			<?php foreach($comments as $comment) { ?>
				<?php echo $comment->email; ?> / 
				<?php echo $comment->timestamp; ?><br>
				<?php echo $comment->body; ?>
				<?php  if((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] == $comment->user_id)) { ?>
					<form method="POST" action="index.php?r=/comment/delete">
						<input type="hidden" name="comment_id" value="<?php echo $comment->comment_id; ?>">
						<input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
						<input type="submit" value="Delete Comment">
					</form><br>
					<form method="POST" action="index.php?r=/comment/update">
						<textarea name="new_comment"><?php echo $comment->body; ?></textarea><br>
						<input type="hidden" name="comment_id" value="<?php echo $comment->comment_id; ?>">
						<input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
						<input type="submit" value="Update Comment">
					</form> 
				<?php } ?><hr>
			<?php } ?>
		<?php } else { echo 'No comments yet, be first!'; } ?>
	</div>
	<?php  if(isset($_SESSION['user_id'])) { ?>
		<div>
			<br>
			<form method="POST" action="/index.php?r=/comment/create" >
				<textarea placeholder="Add Comment" name="body"></textarea><br>	
				<input type="hidden" name="post_id" value="<?php echo $post->id; ?>">		
							
				<input type="submit" value="Comment">
			</form>
		</div>
	<?php } else { ?>
		<br><h4>Please <a href="./view/login_view.php">login</a> to add comments!</h4>
	<?php } ?>
</body>
</html>