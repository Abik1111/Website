<?php 
	session_start();

	if(!$_SESSION['is_connected']){
		header("Loacation:login.php");
	}
?>

<!DOCTYPE html>
<head>
	<title>Ghar Jagga</title>
</head>
<body>
	<header>ADMIN</header>
	<nav>
		<ul>
			<li>
				<a href="logout.php">Log Out</a>
			</li>
		</ul>
	</nav>
	<?php if($_SESSION['is_root']): ?>
	<section>
		<ul>
			<li>
				<a href="agents.php">Agents</a>
			</li>
			<li>
				<a href="datas.php">Datas</a>
			</li>
			<li>
				<a href="pending_datas.php">Pending Datas</a>
			</li>
			<li>
				<a href="clients.php">Clients</a>
			</li>
			<li>
				<a href="pending_clients.php">Pending Clients</a>
			</li>
		</ul>
	</section>
	<?php else: ?>
	<section>
		<ul>
			<li>
				<a href="datas.php">Datas</a>
			</li>
			<li>
				<a href="pending_datas.php">Pending Datas</a>
			</li>
		</ul>
	</section>
	<?php endif; ?>
</body>
</html>