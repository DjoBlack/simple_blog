<!DOCTYPE html>
<html>
<head>
	<title>
		Post's by <?php echo $email->email; ?>
	</title>
</head>
<body>
	<div>
		<a href="/">Home</a>
	</div>
	<div id="content">

		<?php foreach($posts as $post) { ?>
			<div>
				<h2><?php echo $post->title; ?></h2>
				<a href="index.php?r=/posts/user&user_id=<?php echo $post->user_id; ?>">
					<?php echo $post->email; ?>
				</a>
				 - 
				<?php echo $post->date; ?></h5>
				<div>
					Read the post <a href="/index.php?r=/post&id=<?php echo $post->id; ?>">here</a>
				</div>
				<hr>
			</div>
		<?php } ?>
	</div>
</body>
</html>