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
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
    <style type="text/css">
    	.bd-placeholder-img {
	        font-size: 1.125rem;
	        text-anchor: middle;
	        -webkit-user-select: none;
	        -moz-user-select: none;
	        -ms-user-select: none;
	        user-select: none;
      	}

	     @media (min-width: 768px) {
	        .bd-placeholder-img-lg {
	          font-size: 3.5rem;
	        }
	    }
	    .error-text{
	    	color:red;
	    }
    </style>
</head>
  <body class="text-center" >
    <form class="form-signin" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<img class="mb-4" src="logo.jpg" alt="" width="72" height="72">
  		<h1 class="h3 mb-3 font-weight-normal">Sign in to continue</h1>
  		<input type="username" class="form-control" name="username" value="<?php echo $username ?>" placeholder="Username" required autofocus>
  		<div class="error-text"><?php echo $errors['username']; ?></div>
  		<input type="password" class="form-control" name="password" value="<?php echo $password ?>" placeholder="Password" required>
  		<div class="error-text"><?php echo $errors['password']; ?></div>
  		<label>
  			Don't have account sign up 
			<a href="signup.php">here</a>
		</label>

  		<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
  		<p class="mt-5 mb-3 text-muted">&copy; Copyright 2020</p>
	</form>
</body>
</html>