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
</head>
<body>
	<section>
		<h4">LOGIN</h4>
		<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Username:</label>
				<input type="text" name="username" value="<?php echo $username ?>">
				<div><?php echo $errors['username']; ?></div>
			<label>Password:</label>
				<input type="password" name="password" value="<?php echo $password ?>">
				<div><?php echo $errors['password']; ?></div>
			<div>
				<label>Don't have account Sign Up </label>
				<a href="signup.php">here</a>
			</div>
			<div">
				<input type="submit" name="login" value = "login">
			</div>
		</form>
	</section>
</body>
</html>