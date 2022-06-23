<?php 

class Signup extends Controller{
	protected $header;
	protected $footer;
	protected $getRow;
	protected $array = array();

	public function index(){
		$this->header = [
			'display' => 'd-none',
			'title' => 'Sign-up'
		];

		$this->view('templates/header', $this->header);
		$this->view('signup/index');
		$this->view('templates/footer');
	}

	public function SignupProcess(){
		$required = array('username', 'email', 'ponsel', 'password');

		$error = false;
		foreach ($required as $field) {
			if(empty($_POST[$field])){
				$error = true;
			}
		}

		if($error){
			Flasher::setFlash('Form cannot be empty', 'Sign-up Failed!', 'error', '');
			header('Location: '.BASEURL.'/Signup');
			exit;
		}else{
			$username = $this->model('Signup_model')->checkUniqueUsername($_POST);
			$email = $this->model('Signup_model')->checkUniqueEmail($_POST);
			$ponsel = $this->model('Signup_model')->checkUniquePhone($_POST);

			if($username['username'] > 0){array_push($this->array, 'username');}
			if($email['email'] > 0){array_push($this->array, 'email');}
			if($ponsel['ponsel'] > 0){array_push($this->array, 'ponsel');}

			if(!empty($this->array)){
				$implode = implode(", ", $this->array);
				Flasher::setFlash($implode.' Has been used', 'Sign-up Failed', 'error', '');
				header('Location: '.BASEURL.'/Signup');
				exit;
			}else{
				if($this->model('Signup_model')->insertEmployeeData($_POST) == 2){
					Flasher::setFlash('Successfully created an account, please sign-in', 'Sign-up Success!', 'success', '');
					header('Location: '.BASEURL.'/Signin');
					exit;
				}else{
					Flasher::setFlash('Please check your form and try again', 'Sign-up Failed!', 'error', '');
					header('Location: '.BASEURL.'/Signup');
					exit;
				}
			}
		}
	}
}