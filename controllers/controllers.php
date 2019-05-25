<?php
class Controllers {
	public static function index() {
		$posts = PostRepo::getAll();

		require_once './view/main.php';
	}

	public static function postView($getArray) {
		$post = PostRepo::getPostById($getArray['id']);
		$comments =CommentRepo::getByPostID($getArray['id']);

		require_once 'view/post_view.php';
	}

	public static function createPostForm() {
		require_once './view/create_post_view.php';
	}

	public static function createPost($postArr) {
		if(empty($postArr['title']||$postArr['body'])) {
		header('location: /');
	} else {
		PostRepo::create($postArr['title'], $postArr['body'], $_SESSION['user_id']);
		header('location: /');
		}
	}

	public static function deletePost($postArr) {
		PostRepo::deletePostById($postArr['id']);
		header('location: /');
	}

	public static function logout() {
		if(!empty($_POST)) {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_email']);

		header('location: /');
		}
	}

	public static function addComment() {
		if(!empty($_POST['body'] && $_SESSION['user_id'] && $_POST['post_id'])) {
			CommentRepo::create($_POST['body'], $_SESSION['user_id'], $_POST['post_id']);	
		}

			header('location: /index.php?r=/post&id=' . $_POST['post_id']);
		}

	public static function deleteComment() {
		CommentRepo::deleteCommentById($_POST['comment_id']);
		header('location: /index.php?r=/post&id=' . $_POST['post_id']);
	}

	public static function updateComment() {
		if(!empty($_POST['new_comment'] && $_POST['comment_id'])) {
			CommentRepo::updateCommentById($_POST['new_comment'], $_POST['comment_id']);
		}

		header('location: /index.php?r=/post&id=' . $_POST['post_id']);
		}

	public static function userPosts() {
		$posts = PostRepo::getPostsByUserId($_GET['user_id']);
		$email = UserRepo::getMailById($_GET['user_id']);
		require_once './view/user_posts_view.php';
	}

	public static function loginForm() {
		require_once './view/login_view.php';
	}

	public static function login() {
		$user = UserRepo::getUser($_POST['mail'], $_POST['pass']);

		if(!$user) {
			echo "user doesn't exist!";
		} else {
			$_SESSION['user_id'] = $user->id;
			$_SESSION['user_email'] = $user->email;
			header('location: /');
			var_dump($user); 
		}
	}

	public static function registerForm() {
		require_once './view/register_view.php';
	}

	public static function register() {
		if(userRepo::getUserByEmail($_POST['mail'])) {
			echo 'user exist!';
		} else {
			UserRepo::create($_POST['mail'], $_POST['pass']);
			header('location: /');
		}
	}
}