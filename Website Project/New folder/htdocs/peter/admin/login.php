<?php 

	//error_reporting(E_ERROR | E_PARSE);
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
	<tile>Ghar Jagga</title>
</head>
<body>
	<section>
		<h4">ADMIN LOGIN</h4>
		<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<label>Username:</label>
				<input type="text" name="username" value="<?php echo $username ?>">
				<div><?php echo $errors['username']; ?></div>
			<label>Password:</label>
				<input type="password" name="password" value="<?php echo $password ?>">
			<div><?php echo $errors['password']; ?></div>
			<div">
				<input type="submit" name="login" value = "login">
			</div>
		</form>
	</section>
</body>
</html>