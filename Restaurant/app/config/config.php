<?php 

if(!isset($_SERVER['HTTP_REFERER'])){
	$_SERVER['HTTP_REFERER'] = "http://localhost/restaurant/page";
}

define('BASEURL', 'http://localhost/restaurant/page');
define('SRCURL', $_SERVER['HTTP_REFERER']);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'restaurant');