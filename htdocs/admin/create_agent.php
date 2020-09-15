<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();

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
</head>
<body>
	<section>
		<h4">CREATE AGENT</h4>
		<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Username:</label>
				<input type="text" name="username" value="<?php echo $username ?>">
				<div><?php echo $errors['username']; ?></div>
			<label>Password:</label>
				<input type="password" name="password" value="<?php echo $password ?>">
				<div><?php echo $errors['password']; ?></div>
			<label>Retype Password:</label>
				<input type="password" name="retype_password" value="<?php echo $retype_password ?>">
				<div><?php echo $errors['retype_password']; ?></div>
			<label>Details:</label>
				<input type="text" name="details" value="<?php echo $details ?>">
			<div>
				<label>Already have account Sign in </label>
				<a href="login.php">here</a>
			</div>
			<div>
				<input type="submit" name="create" value = "Create">
			</div>
			<div>
				<input type="submit" name="cancel" value = "Cancel">
			</div>
		</form>
	</section>
</body>
</html>