<?php 
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
			$server = new Server($_SESSION['host'],$username,$password);
			$connection = $server->getConnection();
			if($connection!=null){
				$db =  new Database($_SESSION['host'],$username,$password,'property');
				$temp =  $db->select("property_agent");
				$username = $temp[0]['username'];
				if($username==$_SESSION['username']){
					clear();
					$_SESSION['connected']=true;
					$_SESSION['home']=true;
					$_SESSION['root']=true;
				}else{
					clear();
					$_SESSION['connected']=true;
					$_SESSION['datas']=true;
				}

				mysqli_close($connection);
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