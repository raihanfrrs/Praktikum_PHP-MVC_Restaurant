<?php 

class Signin extends Controller{
  protected $header;
  protected $footer;
  protected $getRow;

  public function __construct(){
    new Validation;
  }

  public function index(){
    $this->header = [
      'display' => 'd-none',
      'title' => 'Sign-in'
    ];

    $this->view('templates/header', $this->header);
    $this->view('signin/index');
    $this->view('templates/footer');
  }

  public function SigninProcess(){
    $required = array('username', 'password');

    $error = false;
    foreach ($required as $field) {
      if(empty($_POST[$field])){
        $error = true;
      }
    }

    if($error){
      Flasher::setFlash('Form cannot be empty', 'Sign-in Failed!', 'error', '');
      header('Location: '.BASEURL.'/Signin');
      exit;
    }else{
      $data = null;
      $where = null;
      $username = $this->model('Signin_model')->checkFormUsername($_POST['username']);
      $email = $this->model('Signin_model')->checkFormEmail($_POST['username']);
      $ponsel = $this->model('Signin_model')->checkFormPhone($_POST['username']);

      if($username['username'] > 0){ $data = 'username'; $where = 'username';}
      else if($email['email'] > 0){ $data = 'email'; $where = 'email'; }
      else if($ponsel['ponsel'] > 0){ $data = 'ponsel'; $where = 'ponsel'; }
      else{
        Flasher::setFlash('Try Again', 'Sign-in Failed!', 'error', '');

        header('Location: '.BASEURL.'/Signin');
        exit;
      }

      $this->getRow = $this->model('Signin_model')->getDataLogin($_POST['username'], 'password', $where);
      
      if(password_verify(htmlentities(htmlspecialchars($_POST['password'], ENT_QUOTES)), $this->getRow['password'])){
          $this->getRow = $this->model('Signin_model')->getDataLogin($_POST['username'], 'user_login_id', $where);

          $user_login_id = $this->getRow['user_login_id'];

          $this->getRow = $this->model('Signin_model')->getDataLogin($_POST['username'], 'username', $where);

          $username = $this->getRow['username'];

          $_SESSION['notif'] = [
            'pesan' => 'Enjoy a new experience in managing your business.',
            'aksi' => 'Welcome,',
            'tipe' => 'success',
            'user' => $this->getRow['username']
          ];

          $_SESSION['user'] = [
            'user_login_id' => $user_login_id,
            'username' => $username
          ];

          $data = [
            'user_login_id' => $user_login_id,
            'csid' => hash('sha256', session_id())
          ];


          if($this->model('Signin_model')->checkUserCookiesInDatabase($data) > 0){
              $this->model('Signin_model')->updateUserCookiesInDatabase($data);
          }else{
              $this->model('Signin_model')->insertUserCookiesInDatabase($data);
          }

          $this->getRow = $this->model('Signin_model')->getCookiesFromDatabase($data);

          if(isset($_POST['remember']) && !empty($_POST['remember'])){
    
              setcookie("csid", $this->getRow['session_id'], time() + 2592000, '/');
              setcookie("stts", hash('sha256', 'remember'), time() + 2592000, '/');

              $_SESSION['remember'] = $_POST['remember'];
              $_SESSION['csid'] = $this->getRow['session_id'];
              $_SESSION['stts'] = hash('sha256', 'remember');
          }else if(!isset($_POST['remember']) && empty($_POST['remember'])){

            setcookie("csid", $this->getRow['session_id'], 0, '/');

            $_SESSION['csid'] = $this->getRow['session_id'];
          }

          header('Location: '.BASEURL.'/Dashboard');
          exit;
      }else{
        Flasher::setFlash('Try Again', 'Sign-in Failed!', 'error', '');

        header('Location: '.BASEURL.'/Signin');
        exit;
      }
    }

  }

}