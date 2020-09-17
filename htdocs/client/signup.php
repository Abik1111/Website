<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();

	$errors=['username'=>'','password'=>'','contact'=>'','retype_password'=>''];
	$username=$password=$contact=$details=$retype_password="";
	if(isset($_POST['signup'])){
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
		if(empty($_POST['retype_password'])){
			$errors['retype_password'] = 'A password is required <br/>';
		}else{
			$retype_password = $_POST['retype_password'];
		}
		if(empty($_POST['contact'])){
			$errors['contact'] = 'A contact is required <br/>';
		}else{
			$contact = $_POST['contact'];
		}

		$details =  $_POST['details'];

		if($password==$retype_password){
			$host = $_SESSION['host'];
			$db =  new Database($host,$_SESSION['client_username'],$_SESSION['client_password'],'property');
			$temp =  $db->select("property_client",null,"username='$username'");
			if(!empty($temp)){
				$errors['username'] = 'Username already exist <br/>';
			}else{
				$temp =  $db->select("property_client_request",null,"username='$username'");
				if(!empty($temp)){
					$errors['username'] = 'Username already exist <br/>';
				}
			}
			if(!array_filter($errors)){
				$data = ['username'=>$username,'password'=>$password,'contact'=>$contact,'details'=>$details];
				$db->insert("property_client_request",$data);

				header("Location:verify.php");
			}
		}else{
			$errors['retype_password'] = 'password do not match <br/>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
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
<body class="container" style="max-width: 350px">
	<br/>
	<header class="header header-text">
		REQUEST DATA
	</header>
	<div class="card">
		<div class="card-content white-text">
			<span class="card-title header-text">Sign up to request data...</span>
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
			<div>
				<label class="label">Retype Password:</label>
				<input style="border-radius: 9px;padding-left: 9px" type="password" name="retype_password" value="<?php echo $retype_password ?>" required>
				<div class="error"><?php echo $errors['retype_password']; ?></div>
			</div>
			<div>
				<label class="label">Contact:</label>
				<input style="border-radius: 9px;padding-left: 9px;" type="text" name="contact" value="<?php echo $contact ?>" required autofocus >
				<div class="error"><?php echo $errors['contact']; ?></div>
			</div>
			<div>
				<label class="label">Details:</label>
				<input style="border-radius: 9px;padding-left: 9px;" type="text" name="details" value="<?php echo $details ?>" required autofocus >
			</div>
			<label style="font-size: 16px;font-style: italic;">
		  		Already have an account Sign in
				<a href="login.php">here</a>
			</label>
			<br/><br/>
			<div class = "center">
				<input class ="btn submit-button" type="submit" name="signup" value = "Sign Up">
			</div>
			</form>
		</div>
	</div>
	<br/><br/><br/><br/><br/><br/><br/><br/>
</body>
</html>