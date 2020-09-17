<?php 
	session_start();
	if(!$_SESSION['is_connected']){
		header("Loacation:login.php");
	}

?>

<!DOCTYPE html>
<head>
	<title>Ghar Jagga</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.header{
			background: #FFFFFF;
			height: 90px;
			text-align: center;
			padding: 10px;
			padding-left: 20px;
		}
		.header-text{
			font-weight: bold;
			font-size: 40px;
			color: rgb(39,169,157);
		}
		.nav{
			background-color: #FFFFFF;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.button{
			border-radius : 6px;
			margin-left: 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.card{
			padding: 0px !important;
			border-radius: 9px;
			box-shadow: 0px 0px 0px 0px!important;
			border-width: 0px !important;
			border-color:#6F6F6F !important;
			border-style: outset;
		}
		.card-img{
			width : 100px;
			height: 100px;
			margin :40px auto 20px;
			display: block;
			position: relative;
			top: 0px;
		}
		.card-text{
			color: #6F6F6F !important;
			font-size: 18px;
			padding: 20px;
			font-weight: bold;
			text-decoration: underline;
		}
	</style>
</head>
<body class = "container">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="logout.php">Log Out</a>
	</nav>
	<?php if($_SESSION['is_root']): ?>
	<section>
		<div class = row>
			<div class = "col s4 md">
				<div class = "card">
					<div class = "card-content center">
						<a href="agents.php">
							<img src="../img/agents.png" class = "card-img">
							<label class="card-text">Agents</label>
						</a>
					</div>
				</div>
			</div>
			<div class = "col s4 md3">
				<div class = "card">
					<div class = "card-content center">
						<a href="datas.php">
							<img src="../img/datas.png" class = "card-img">
							<label class="card-text">Datas</label>
						</a>
					</div>
				</div>
			</div>
			<div class = "col s4 md3">
				<div class = "card">
					<div class = "card-content center">
						<a href="clients.php">
							<img src="../img/client.png" class = "card-img">
							<label class="card-text">Clients</label>
						</a>
					</div>
				</div>
			</div>
			<div class = "col s4 md3">
				<div class = "card">
					<div class = "card-content center">
						<a href="pending_datas.php">
							<img src="../img/pending_datas.png" class = "card-img">
							<label class="card-text">Pending Datas</label>
						</a>

					</div>
				</div>
			</div>
			<div class = "col s4 md3">
				<div class = "card">
					<div class = "card-content center">
						<a href="pending_clients.php">
							<img src="../img/pending_clients.png" class = "card-img">
							<label class="card-text">Pending Clients</label>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<br/><br/><br/><br/><br/><br/><br/><br/>
	<?php else: ?>
	<?php header("Location:datas.php") ?>
	<?php endif; ?>
</body>
</html>