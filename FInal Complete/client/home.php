<?php 
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
?>

<!DOCTYPE html>
<html>
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
		}
		.inform{
			text-align: center;
			font-size: 18px;
			font-style: italic;
		}
	</style>
</head>
<body class = "container">
	<header class="header">
		<a href="home.php" class = "header-text">
			GHAR JAGGA
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="login.php">Log Out</a>
		<?php if(!$_SESSION['is_pending']): ?>
			<a class ="btn right hide-on-down button" href="data_request.php">Request New Data</a>
		<?php endif; ?>
	</nav>
	<br/>
	<br/>
	<br/>
	<?php if(!$_SESSION['is_pending']): ?>
	<section>
		<div class = row>
			<div class = "col s6 md">
				<div class = "card">
					<div class = "card-content center">
						<a href="datas.php">
							<img src="../img/datas.png" class = "card-img">
							<label class="card-text">Submitted Datas</label>
						</a>
					</div>
				</div>
			</div>
			<div class = "col s6 md3">
				<div class = "card">
					<div class = "card-content center">
						<a href="pending_datas.php">
							<img src="../img/pending_datas.png" class = "card-img">
							<label class="card-text">Pending Datas</label>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php else: ?>
	<section class="inform">
		account verification is in process.......
	</section>
	<?php endif; ?>
</body>
</html>