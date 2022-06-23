<?php 

class Signout extends Controller{

	public function __construct(){
		$_SESSION = [];
		session_unset();
		session_destroy();

		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
	        $parts = explode('=', $cookie);
	        $name = trim($parts[0]);
	        setcookie($name, '', time()-1000);
	        setcookie($name, '', time()-1000, '/');
	    }

		header('Location: '.BASEURL.'/Signin');
	}
}