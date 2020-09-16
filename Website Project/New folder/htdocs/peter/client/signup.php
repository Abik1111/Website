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
</head>
<body>
	<section>
		<h4">SIGN UP</h4>
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
			<label>Contact:</label>
				<input type="number" name="contact" value="<?php echo $contact ?>">
				<div><?php echo $errors['contact']; ?></div>
			<label>Details:</label>
				<input type="text" name="details" value="<?php echo $details ?>">
			<div>
				<label>Already have account Sign in </label>
				<a href="login.php">here</a>
			</div>
			<div">
				<input type="submit" name="signup" value = "Sign Up">
			</div>
		</form>
	</section>
</body>
</html>