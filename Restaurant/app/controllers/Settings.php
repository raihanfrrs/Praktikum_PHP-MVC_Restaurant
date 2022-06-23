<?php 

class Settings extends Controller{
	protected $header;
	protected $body;
	protected $getRow;

	public function __construct(){
		new Validation;
	}

	public function index(){
		$this->getRow = $this->model('Employee_model')->getInnerDataEmployee($_SESSION['user']['user_login_id'], 'user_login_id', 'single');

		$this->header = [
			'title' => 'Settings'
		];

		$this->view('templates/header', $this->header);
		$this->view('settings/index', $this->getRow);
		$this->view('templates/footer');
	}

	public function EditProfile(){
		$required = array('username','pegawai_nama', 'email', 'ponsel', 'alamat');
	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    if($error){
	    	Flasher::setFlash('Form cannot be empty', 'Update Profile Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if ($this->model('Employee_model')->checkAnyEmployeeIfExist($_POST, 'username') > 0) {
	    		Flasher::setFlash('Username is already used', 'Update Profile Failed!', 'error', '');
		      	header('Location: '.SRCURL);
		      	exit;
	    	}else{
	    		if ($this->model('Employee_model')->updateDataEmployee($_POST, 'user_login_id', $_SESSION['user']['user_login_id']) > 0) {
	    			Flasher::setFlash('User has been updated', 'Update Profile Success!', 'success', '');
			      	header('Location: '.SRCURL);
			      	exit;
	    		}else{
	    			Flasher::setFlash('User cannot updated', 'Update Profile Failed!', 'error', '');
			      	header('Location: '.SRCURL);
			      	exit;
	    		}
	    	}
	    }
	}

	public function EditPassword(){
		$required = array('password');
	    $error = false;
	    foreach ($required as $field) {
	      if(empty($_POST[$field])){
	        $error = true;
	      }
	    }

	    if($error){
	    	Flasher::setFlash('Password cannot be empty', 'Update Password Failed!', 'error', '');
	      	header('Location: '.SRCURL);
	      	exit;
	    }else{
	    	if ($this->model('Employee_model')->updatePasswordEmployee($_POST, 'user_login_id',$_SESSION['user']['user_login_id']) > 0) {
	    		Flasher::setFlash('Password has been updated', 'Update Password Success!', 'success', '');
		      	header('Location: '.SRCURL);
		      	exit;
	    	}else{
	    		Flasher::setFlash('Password cannot updated', 'Update Password Failed!', 'error', '');
		      	header('Location: '.SRCURL);
		      	exit;
	    	}
	    }
	}

}