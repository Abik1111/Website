<?php 
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}

	if($_SESSION['is_pending']){
		header("Location:home.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
</head>
<body>
	<header>GHAR JAGGA</header>
	<nav>
		<ul>
			<li>
				<a href="login.php">Log Out</a>
			</li>
		</ul>
	</nav>
	pending_datas
</body>
</html>