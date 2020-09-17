<?php 
	error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();
	$_SESSION['is_connected']=false;
	$_SESSION['is_root']=false;
	$_SESSION['host']='localhost';

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
			$server = new Server($host,$username,$password);
			$connection = $server->getConnection();
			if($connection!=null){
				$db =  new Database($host,$username,$password,'property');
				$temp =  $db->select("property_agent");
				
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				$_SESSION['is_connected']=true;
				if($username== $temp[0]['username']){
					$_SESSION['is_root']=true;
				}
				mysqli_close($connection);
				header("Location:home.php");

			}else{
				$errors['password'] = 'Username and password do not match';
			}	
		}else{
			$errors['password'] = 'Username and password do not match';
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
		ADMIN LOGIN
	</header>
	<div class="card">
		<div class="card-content white-text">
			<span class="card-title header-text">Sign in to continue...</span>
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
			<br/><br/>
			<div class = "center">
				<input class ="btn submit-button" type="submit" name="login" value = "login" class="btn brand z-depth-0">
			</div>
			</form>
		</div>
	</div>
</body>
</html>