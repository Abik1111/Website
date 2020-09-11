<?php 
	$errors = array('username'=>'','password'=>'');

	if(isset($_POST['login'])){
		if(empty($_POST['username'])){
			$errors['username'] = 'An username is required <br/>';
		}else{
			$_SESSION['username'] = $_POST['username'];
		}

		if(empty($_POST['password'])){
			$errors['password'] = 'A password is required <br/>';
		}else{
			$_SESSION['password'] = $_POST['password'];
		}

		if(!array_filter($errors)){
			$_SESSION['host']='localhost';
			$server = new Server($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
			$connection = $server->getConnection();
			if($connection!=null){
				$_SESSION['connected']=true;
				$_SESSION['home']=true;
				$_SESSION['datas']=false;
				$_SESSION['users']=false;

				$db =  new Database('localhost',$_SESSION['username'],$_SESSION['password'],'jagga');
				$temp =  $db->select("jagga_user");
				$username = $temp[0]['username'];
				if($username==$_SESSION['username']){
					$_SESSION['root']=true;
				}

				mysqli_close($connection);
			}else{
				$errors['password'] = 'Username and password do not match';
			}
		}
	}

	if($_SESSION['connected']==true){
		if(isset($_GET['link'])){
		if($_GET['link']==0){
			$_SESSION['connected']=false;
			$_SESSION['home']=false;
			$_SESSION['datas']=false;
			$_SESSION['users']=false;
			$_SESSION['root']=false;
			$_SESSION['username']='';
			$_SESSION['password']='';
			session_destroy();
		}else if($_GET['link']==1){
			$_SESSION['connected']=true;
			$_SESSION['home']=true;
			$_SESSION['datas']=false;
			$_SESSION['users']=false;
		}elseif ($_GET['link']==2) {
			$_SESSION['connected']=true;
			$_SESSION['home']=false;
			$_SESSION['datas']=true;
			$_SESSION['users']=false;
		}elseif ($_GET['link']==3) {
			$_SESSION['connected']=true;
			$_SESSION['home']=false;
			$_SESSION['datas']=false;
			$_SESSION['users']=true;
		}
	}
	}

 ?>

<!DOCTYPE html>
<html>
	<head>
	<title>Ghar Jagga</title>
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="
		https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.header{
			background: #96D2DB;
			height: 90px;
			text-align: left;
			font-size: 40px;
			font-weight: bold;
			padding: 10px;
			padding-left: 20px;
			text-orientation: sideways;
		}
		.brand{
			background: #cbb09c !important;
		}
		.brand-text{
			color: #cbb09c !important;
			font-weight: bold;
		}
		form{
			max-width: 460px;
			margin: 20px auto;
			padding: 20px;
		}
		.picture{
			width : 100px;
			height: 100px;
			margin :40px auto 20px;
			display: block;
			position: relative;
			top: 10px;
		}
		.group-text{
			color: #cbb09c !important;
			font-weight: bold;
			font-size: 30px;
		}
	</style>
	</head>
	<body class = "grey lighten-4">
		<header class="header">
			<a href="?link=1" class = "header-text">GHAR JAGGA</a>
		</header>
		<?php if($_SESSION['connected']==true): ?>
			<nav class = "white z-depth-0">
				<div class = "container">
					<ul id = "nav-mobile" class = "right hide-on-small-and-down">
						<?php if($_SESSION['connected']==true && $_SESSION['datas']==true):?>
							<li><a href="#" class ="btn brand z-depth-0">Add Data</a></li>
						<?php elseif($_SESSION['connected']==true  && $_SESSION['users']==true):?>
							<li><a href="#" class ="btn brand z-depth-0">Add User</a></li>
						<?php endif; ?>	
						<li><a href="?link=0" class ="btn brand z-depth-0">log out</a></li>
					</ul>
				</div>
			</nav>
		<?php endif; ?>

	<?php if($_SESSION['connected']==true && $_SESSION['home']==true): ?>
		<div class = "container">
			<div class = row>
				<div class = "col s6 md3">
					<div class = "card z-depth-0">
					<img src="img/data.png" class = "picture">
					<div class = "card-content center">
						<a class = "group-text" href="?link=2"> Datas</a>
					</div>
					</div>
				</div>
				<?php if($_SESSION['root']==true): ?>
					<div class = "col s6 md3">
						<div class = "card z-depth-0">
						<img src="img/user.png" class = "picture">
						<div class = "card-content center">
							<a class = "group-text" href="?link=3">Users</a>
						</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php elseif($_SESSION['connected']==true && $_SESSION['datas']==true): ?>
		<div>
			
		</div>
	<?php elseif($_SESSION['connected']==true && $_SESSION['users']==true): ?>
		<div>
			<?php  ?>
			
		</div>
	<?php else: ?>
		<section class = "container grey-text">
			<h4 class = "center">Admin Details</h4>
			<form class = "white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Username:</label>
				<input type="text" name="username" value="<?php echo $_SESSION['username'] ?>">
				<div class = "red-text"><?php echo $errors['username']; ?></div>
				<label>Password:</label>
				<input type="password" name="password" value="<?php echo $_SESSION['password'] ?>">
				<div class = "red-text"><?php echo $errors['password']; ?></div>
				<div class = "center">
					<input type="submit" name="login" value = "login" class="btn brand z-depth-0">
				</div>
			</form>
		</section>
	<?php endif; ?>
	<footer class = "section">
 		<div class = "center grey-text">@Copyright 2020 Ghar Jagga</div>
	</footer>
</body>

</html>