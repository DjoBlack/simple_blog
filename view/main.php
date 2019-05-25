<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
</head>
<body>
	<div id="user-interactions">
		<?php if(isset($_SESSION['user_email'])) { ?>
			<?php echo $_SESSION['user_email']; ?>
			<form method="POST" action="/index.php?r=/logout">
				<input type="hidden" name="user_id" value="<?php $_SESSION['user_id'] ?>">
				<input type="submit" value="Logout">
			</form>
			<br><br><a href="/index.php?r=/post/create">Create Post</a>
		<?php } else { ?>
			<a href="/index.php?r=/login">Login</a>
			<a href="/index.php?r=/register">Register</a>
			</br></br><strong>Login to create post!</strong>
		<?php } ?>
	</div>
	<div id="content">
		<?php foreach($posts as $post) { ?>
			<div>
				<h2><?php echo $post->title; ?></h2>
				<a href="index.php?r=/posts/user&user_id=<?php echo $post->user_id; ?>">
					<?php echo $post->email; ?>
				</a>
				 - 
				<?php echo $post->date(); ?></h5>
				<div>
					Preview:
					<div>
						<?php echo $post->preview(20); ?>
					</div>
					Read full post <a href="/index.php?r=/post&id=<?php echo $post->id; ?>">here:</a>
				</div>
				<a href="post.php?id=<?php echo $post->id; ?>">Comments: <?php echo $post->count_num; ?></a>
				<hr>
			</div>
		<?php } ?>
		
	</div>
</body>
</html>