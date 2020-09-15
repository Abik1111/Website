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
		if(isset($_POST['delete'])){
			$data = new JaggaDelete('localhost', 'dilip', '123456789');
			$data->delete($_POST['id']);
			$_SESSION['link'] = 'data_list';
		}
	}
	else if($_SESSION['link'] == 'request_data_approve'){
		if(isset($_POST['approve']) || isset($_POST['delete'])){
			if(isset($_POST['approve'])){
				$temp = new JaggaSave('localhost', 'dilip', '123456789');
				$temp->saveFromRequest($_POST['id'], 'location', 'area', 'price', 'description', 'owner_contact', 'files', 'type', 'user_id', 'delete_prev');
			}
			$data = new JaggaRequestDelete('localhost', 'dilip', '123456789');
			$data->delete($_POST['id']);
			$_SESSION['link'] = 'request_data_list';
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
	else if($_SESSION['link'] == 'request_data_list'){
		include 'admin/request_data_list.php';
	}
	else if($_SESSION['link'] == 'request_data_approve'){
		include 'admin/request_data_approve.php';
	}
?>
