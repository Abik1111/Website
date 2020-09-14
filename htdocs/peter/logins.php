<?php 
	error_reporting(E_ERROR | E_PARSE);
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
	if(!array_key_exists('host', $_SESSION)){
		$_SESSION['host']='localhost';
	}
	if(!array_key_exists('username', $_SESSION)){
		$_SESSION['username']='';
	}
	if(!array_key_exists('password', $_SESSION)){
		$_SESSION['password']='';
	}
	if(!array_key_exists('userID', $_SESSION)){
		$_SESSION['userID']=1;
	}
	if(!array_key_exists('dataID', $_SESSION)){
		$_SESSION['dataID']=1;
	}
	if(!array_key_exists('add_user', $_SESSION)){
		$_SESSION['add_user']=false;
	}
	if(!array_key_exists('add_data', $_SESSION)){
		$_SESSION['add_data']=false;
	}	
	function clear(){
		$_SESSION['connected']=false;
		$_SESSION['home']=false;
		$_SESSION['datas']=false;
		$_SESSION['users']=false;
		$_SESSION['userID']=0;
		$_SESSION['dataID']=0;
		$_SESSION['add_user']=false;
		$_SESSION['add_data']=false;
	}

	include('lib/Server_Database.php');
	include('admin/admins.php');
 ?>

