<?php 

class App{
	protected $controller;
	protected $method;
	protected $params = [];
	protected $temp;

	public function __construct(){
		$this->temp = new Parses;
		$this->temp = $this->temp->parseUrl();
		
		if(isset($_SESSION['username'])){
			$this->controller = 'Dashboard';
			$this->method = 'index';
		}else{
			$this->controller = 'Signin';
			$this->method = 'index';
		}

		//controller
		$url = $this->temp;
		if(file_exists('../app/controllers/'.$url[0].'.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/'.$this->controller.'.php';
		$this->controller = new $this->controller;

		//method
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		//params
		if(!empty($url)){
			$this->params = array_values($url);
		}

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

}