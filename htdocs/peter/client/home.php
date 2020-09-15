<?php 
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html><head>
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
	<?php if(!$_SESSION['is_pending']): ?>
	<section>
		<ul>
			<li>
				<a href="#">Datas</a>
			</li>
			<li>
				<a href="#">Pending Datas</a>
			</li>
		</ul>
	</section>
	<?php else: ?>
	<section>
		account verification is in process.......
	</section>
	<?php endif; ?>
</body>
</html>