<?php 

class Validation extends Controller{
	protected $msg = false;
	protected $url;
	protected $counter;
	protected $getRow;


	public function __construct(){
		$this->url = new Parses;
		$this->url = $this->url->parseUrl();
		$this->getUrlForValidation();

		if(isset($_SERVER['HTTP_COOKIE'])){
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);

			// conditional session cookie for checked remember user if after close the browser
			if(isset($_SESSION['csid']) && isset($_SESSION['stts'])){
				if(isset($_COOKIE['csid']) && isset($_COOKIE['stts'])){
					$this->counter = 0;
					foreach($cookies as $cookie) {
				        $parts = explode('=', $cookie);
				        $name = trim($parts[0]);
				        if('csid' === $name){
				        	$this->counter = $this->counter + 1;
				        }

				        if('stts' === $name){
				        	$this->counter = $this->counter + 1;
				        }

				        if($this->counter > 2){
				        	$this->msg = true;
				        }

				    }

					if($_COOKIE['csid'] != $_SESSION['csid'] || $_COOKIE['stts'] != $_SESSION['stts']){
						$this->msg = true;
					}

				}else{
					$this->msg = true;
				}
			}

			// if msg is true then auto logout and back to the Signin page
			if($this->msg === true){
				$_SESSION = [];
				session_unset();
				session_destroy();

			    foreach($cookies as $cookie) {
			        $parts = explode('=', $cookie);
			        $name = trim($parts[0]);
			        setcookie($name, '', time()-1000);
			        setcookie($name, '', time()-1000, '/');
			    }
				
				header('Location: '.BASEURL.'/Signin');
				exit;
			}
		}
	}

	public function getUrlForValidation(){
		if($this->url[0] == 'Signin'){
			$this->getValidationSignin();
		}else{
			$this->getValidationSession();
		}
	}

	public function getValidationSignin(){ // CHECK USER REMEMBER
		if(isset($_SERVER['HTTP_COOKIE'])){

			if(isset($_COOKIE['csid']) && isset($_COOKIE['stts'])){
				if($this->model('Signin_model')->checkRowCookiesFromDatabase($_COOKIE) > 0 && $_COOKIE['stts'] == hash('sha256', 'remember')){
					$this->getRow = $this->model('Signin_model')->getUsernameFromDatabaseWithCookie($_COOKIE);

					$_SESSION['user'] = [
						'username' => $this->getRow['username'],
						'user_login_id' => $this->getRow['user_login_id']
					];
					$_SESSION['csid'] = $_COOKIE['csid'];
					$_SESSION['stts'] = $_COOKIE['stts'];
					header('Location: '.BASEURL.'/Dashboard');
				}else{
					$this->msg = true;
				}
			}

		}
	}

	public function getValidationSession(){

		// conditional session cookie for checked remember user after Signin
		if(isset($_SERVER['HTTP_COOKIE'])){
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			if(isset($_SESSION['remember']) && isset($_SESSION['csid']) && isset($_SESSION['stts'])){
				if(isset($_COOKIE['csid']) && isset($_COOKIE['stts'])){
					$this->counter = 0;

					foreach($cookies as $cookie) {
				        $parts = explode('=', $cookie);
				        $name = trim($parts[0]);
				        
				        if('csid' === $name){
				        	$this->counter = $this->counter + 1;
				        }
				        
				        if('stts' === $name){
				        	$this->counter = $this->counter + 1;
				        }

				        if($this->counter > 2){
				        	$this->msg = true;
				        }
				    }

					if($_COOKIE['csid'] != $_SESSION['csid'] || $_COOKIE['stts'] != $_SESSION['stts']){
						$this->msg = true;
					}
				}else{
					$this->msg = true;
				}
			}

			// conditional session cookie for non checked remember user
			if(!isset($_SESSION['remember']) && isset($_SESSION['csid']) && !isset($_SESSION['stts'])){
				if(isset($_COOKIE['csid']) && !empty($_COOKIE['csid'])){
					$this->counter = 0;
					
					foreach($cookies as $cookie) {
				        $parts = explode('=', $cookie);
				        $name = trim($parts[0]);
				        
				        if('csid' === $name){
				        	$this->counter = $this->counter + 1;
				        }

				        if($this->counter > 1){
				        	$this->msg = true;
				        }
				    }

					if($_COOKIE['csid'] != $_SESSION['csid']){
						$this->msg = true;
					}
				}else{
					$this->msg = true;
				}
			}

			if($this->msg === true){
				$_SESSION = [];
				session_unset();
				session_destroy();

			    foreach($cookies as $cookie) {
			        $parts = explode('=', $cookie);
			        $name = trim($parts[0]);
			        setcookie($name, '', time()-1000);
			        setcookie($name, '', time()-1000, '/');
			    }
				
				header('Location: '.BASEURL.'/Sigin');
				exit;
			}
		}

		if(!isset($_SESSION['user']['username']) && empty($_SESSION['user']['user_login_id'])){
			header('Location: '.BASEURL.'/Signin');
		}

	}

}