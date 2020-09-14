<?php 
	//error_reporting(E_ERROR | E_PARSE);
	
	if (session_status() == PHP_SESSION_NONE) {
  		session_start();
	}
	if(!array_key_exists('is_connected', $_SESSION)){
		
	}
	if(!array_key_exists('host', $_SESSION)){
		$_SESSION['host']='localhost';
	}
	if(!array_key_exists('username', $_SESSION)){
		$_SESSION['username']='';
	}
	if(!array_key_exists('password', $_SESSION)){
		$_SESSION['password']='';
	}
	if(!array_key_exists('is_root', $_SESSION)){
		$_SESSION['is_root']=false;
	}

?>
