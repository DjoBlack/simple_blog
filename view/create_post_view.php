<!DOCTYPE html>
<html>
<head>
	<title>Create Post</title>
</head>
<body>
	<form method="POST" action="/index.php?r=/post/create" >
		<input type="text" name="title" placeholder="Title"><br><br>
		<textarea placeholder="Post body" name="body"></textarea><br>
		
		<input type="submit" value="Create">
	</form>
</body>
</html>