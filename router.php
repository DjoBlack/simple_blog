<?php 
class Router {
	public function __construct($route) {
		$this->route = $route;
	}

	public function serve() {
		switch ($this->route) {
			case '/':
				Controllers::index();
				break;

			case '/register':
				if(empty($_POST)) {
					Controllers::registerForm();
				} else {
					Controllers::register($_POST);
				}
				break;

			case '/login':
				if(empty($_POST)) {
					Controllers::loginForm();
				} else {
					Controllers::login($_POST);
				}
				break;

			case '/logout':
				Controllers::logout($_POST);
				break;

			case '/post':
				Controllers::postView($_GET);
				break;

			case '/posts/user':
				Controllers::userPosts($_GET);
				break;

			case '/post/create':
				if(empty($_POST)) {
					Controllers::createPostForm();
				} else {
					Controllers::createPost($_POST);
				}
				break;

			case '/post/delete':
				if(!empty($_POST)){
					Controllers::deletePost($_POST);
				}
				break;

			case '/comment/create':
				Controllers::addComment($_POST);
				break;

			case '/comment/update':
				Controllers::updateComment($_POST);
				break;

			case '/comment/delete':
				if(!empty($_POST)) {
					Controllers::deleteComment($_POST);
				}
				break;
		}
	}
}