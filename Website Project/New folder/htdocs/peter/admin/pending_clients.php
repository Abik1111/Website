<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();

	if(!$_SESSION['is_root']){
		header("Location:home.php");
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
</head>
<body>
	<header>ADMIN</header>
	<nav>
		<ul>
			<li>
				<a href="home.php">Home</a>
			</li>
			<li>
				<a href="logout.php">Log Out</a>
			</li>
		</ul>
	</nav>
	<section>
		<?php 
			$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
			$users = $db->select('property_client_request',['id','username']);
		?>
		<ul>
			<?php foreach ($users as $user):?>
				<li>
					<a href="?userID=<?php echo($user['id']); ?>">
						<?php echo $user['username']."&nbsp;(".$user['id'].")";?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>

</body>
</html>