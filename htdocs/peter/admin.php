<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'Jagga.php';
	
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
	if(!array_key_exists('link', $_SESSION)){
		$_SESSION['link']='data_list';
	}
	if(!array_key_exists('data_search', $_SESSION)){
		$_SESSION['data_search']='';
	}
	
	if($_SESSION['link'] == 'data_update'){
		if(isset($_GET['delete_id'])){
			$data = new JaggaDelete('localhost', 'dilip', '123456789');
			$data->delete($_GET['delete_id']);
		}
	}
	
	if(isset($_GET['link'])){
		$_SESSION['link'] = $_GET['link'];
	}

	if($_SESSION['link'] == 'data_add'){
		include 'admin/data_add.php';
	}
	else if($_SESSION['link'] == 'data_update'){
		include 'admin/data_update.php';
	}
	else if($_SESSION['link'] == 'data_list'){
		include 'admin/data_list.php';
	}
?>
