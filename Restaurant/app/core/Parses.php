<?php 

class Parses{

	public function parseUrl(){
		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}

	public function getUrlForNav($var1, $url1, $var2, $url2){
	    $array = array();
	    $msg = false;

	    if (!empty($var1) && !empty($url1)) {
	        if($var1 == 'Dashboard'){
	        	if(strcasecmp($var1, $url1) == 0){
		        	$msg = true;
		        }else{
		        	$msg = false;
		        }
	        }else if($var1 == 'master'){
	        	if((strcasecmp($url1, $var1) == 0) && (strcasecmp($url2, $var2) == 0)){
		        	$msg = true;
		        }else{
		        	$msg = false;
		        }
	        }else if($var1 == 'menu'){
	        	if(strcasecmp($var1, $url1) == 0){
		        	$msg = true;
		        }else{
		        	$msg = false;
		        }
	        }else if($var1 == 'transaction'){
	        	if(strcasecmp($var1, $url1) == 0){
		        	$msg = true;
		        }else{
		        	$msg = false;
		        }
	        }
	    }

	    if($msg == true){
	    	$array = [
        		'a-class' => '',
        		'a-toggle' => 'collapse',
        		'a-nav' => 'show',
        		'a-active' => 'active'
        	];
	    }else{
	    	$array = [
        		'a-class' => 'collapsed',
        		'a-toggle' => 'collapse',
        		'a-nav' => '',
        		'a-active' => ''
        	];
	    }

	    return $array;
	}
}