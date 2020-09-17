<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';
	
	
	session_start();
	$_SESSION['is_connected']=false;
	$_SESSION['is_pending']=true;
	$_SESSION['host']='localhost';
	$_SESSION['client_username']='client';
	$_SESSION['client_password']='password';

	$errors=['username'=>'','password'=>''];
	$username=$password="";
	if(isset($_POST['login'])){
		if(empty($_POST['username'])){
			$errors['username'] = 'An username is required <br/>';
		}else{
			$username = $_POST['username'];
		}
		if(empty($_POST['password'])){
			$errors['password'] = 'A password is required <br/>';
		}else{
			$password = $_POST['password'];
		}

		if(!array_filter($errors)){
			$host = $_SESSION['host'];
			$db =  new Database($host,$_SESSION['client_username'],$_SESSION['client_password'],'property');
			$temp =  $db->select("property_client",['id'],"username='$username' AND password='$password'");
			if(!empty($temp)){
				$_SESSION['is_connected']=true;
				$_SESSION['is_pending']=false;
				$_SESSION['client_id']=$temp[0]['id'];
			}else{
				$temp =  $db->select("property_client_request",null,"username='$username' AND password='$password'");
				if(!empty($temp)){
					$_SESSION['is_connected']=true;
				}
			}
			if($_SESSION['is_connected']){
				header("Location:home.php");
			}else{
				$errors['password'] = 'Username and password do not match';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.header{
			background: #FFFFFF;
			height: 50px;
			text-align: center;
		}
		.header-text{
			font-weight: bold;
			font-size: 35px;
			color: rgb(39,169,157);
		}
		.nav{
			background-color: #FFFFFF;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.button{
			/*background: #cbb09c !important;*/
			border-radius : 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.label{
			color: #9F9F9F;
			font-size: 15px;
			font-weight: bold;
		}
		.submit-button{
			/*background: #cbb09c !important;*/
			border-radius : 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.card{
			border-top-right-radius: 21px;
			border-bottom-left-radius: 21px;
		}
		.error{
			color: red;
		}
	</style>
</head>
<body class="container" style="max-width: 300px">
	<br/><br/><br/><br/><br/>
	<header class="header header-text">
		REQUEST DATA
	</header>
	<div class="card">
		<div class="card-content white-text">
			<span class="card-title header-text">Login to request data...</span>
			<form class="white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<div>
				<label class="label">Username:</label>
				<input style="border-radius: 9px;padding-left: 9px;" type="text" name="username" value="<?php echo $username ?>" required autofocus >
				<div class="error"><?php echo $errors['username']; ?></div>
			</div>
			<div>
				<label class="label">Password:</label>
				<input style="border-radius: 9px;padding-left: 9px" type="password" name="password" value="<?php echo $password ?>" required>
				<div class="error"><?php echo $errors['password']; ?></div>
			</div>
			<label style="font-size: 16px;font-style: italic;">
		  		Don't have an account sign up 
				<a href="signup.php">here</a>
			</label>
			<br/><br/>
			<div class = "center">
				<input class ="btn submit-button" type="submit" name="login" value = "login" class="btn brand z-depth-0">
			</div>
			<p>&copy; Copyright 2020</p>
			</form>
		</div>
	</div>
</body>
</html>