<?php 
	if (session_status() == PHP_SESSION_NONE) {
  		session_start();
	}
	if(!array_key_exists('connected', $_SESSION)){
		$_SESSION['connected']=false;
	}
	if(!array_key_exists('home', $_SESSION)){
		$_SESSION['home']=false;
	}
	if(!array_key_exists('datas', $_SESSION)){
		$_SESSION['datas']=false;
	}
	if(!array_key_exists('users', $_SESSION)){
		$_SESSION['users']=false;
	}
	if(!array_key_exists('root', $_SESSION)){
		$_SESSION['root']=false;
	}
	if(!array_key_exists('username', $_SESSION)){
		$_SESSION['username']='';
	}
	if(!array_key_exists('password', $_SESSION)){
		$_SESSION['password']='';
	}

	include('lib/Server_Database.php');
	include('admin/admin.php');
 ?>

