<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if(!$_SESSION['is_root']){
		header("Location:home.php");
	}

	$errors=['username'=>'','password'=>'','contact'=>'','retype_password'=>''];
	$username=$password=$details=$retype_password="";
	if(isset($_POST['create'])){
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

		$details =  $_POST['details'];

		if($password==$retype_password){
			$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
			$temp =  $db->select("property_agent",null,"username='$username'");
			if(!empty($temp)){
			 	$errors['username'] = 'This username already exist<br/>';
			}
			if(!array_filter($errors)){
				$user = new User($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
				$user->createUser('%',$username,$password);
				$user->grant(" DELETE,INSERT,SELECT,UPDATE ",'property','property_table','%',$username);
				$user->grant(" DELETE,INSERT,SELECT,UPDATE ",'property','property_table_request','%',$username);
				
				$datas = ['username'=>$username,'password'=>$password,'details'=>$details];
				$db->insert("property_agent",$datas);

				header("Location:agents.php");

			}
		}else{
			$errors['retype_password'] = 'password do not match <br/>';
		}
	}

	if(isset($_POST['cancel'])){
		header("Location:agents.php");
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
			height: 90px;
			text-align: center;
			padding: 10px;
			padding-left: 20px;
		}
		.header-text{
			font-weight: bold;
			font-size: 40px;
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
		.select {
	       display: block;
      	}
      	.inform{
			text-align: center;
			font-size: 18px;
			font-style: italic;
			color: #9F9F9F;;
			text-decoration: underline;
		}
		.error{
			color: red;
		}
	</style>
</head>
<body class="container" style="max-width: 600px">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="agents.php">View All Agents</a>
	</nav>
	<div style="text-align: center;">
		<label style="font-weight: bold; font-size: 27px;color: #9F9F9F;">CREATE AGENT</label>
	</div>

	<form class="white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div>
			<label class="label">Username:</label>
			<input type="text" name="username" value="<?php echo $username ?>" required autofocus >
			<div class="error"><?php echo $errors['username']; ?></div>
		</div>
		<div>
			<label class="label">Password:</label>
			<input type="password" name="password" value="<?php echo $password ?>" required>
			<div class="error"><?php echo $errors['password']; ?></div>
		</div>
		<div>
			<label class="label">Retype Password:</label>
			<input type="password" name="retype_password" value="<?php echo $retype_password ?>" required>
			<div class="error"><?php echo $errors['retype_password']; ?></div>
		</div>
		<div>
			<label class="label">Details:</label>
			<input type="text" name="details" value="<?php echo $details ?>" required>
		</div>
		<input class ="btn right hide-on-down submit-button" type="submit" name="create" value = "Create">
	</form>
</body>
</html>