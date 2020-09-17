<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();
	if(!$_SESSION['is_connected']){
		header("Loacation:login.php");
	}
	if(!$_SESSION['is_root']){
		header("Location:home.php");
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
			/*background: #cbb09c !important;*/
			border-radius : 6px;
			margin-left: 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.card{
			border-radius: 9px;
			height: 30px !important;
			box-shadow: 0px 0px 0px 0px!important;
			border-width: 1px !important;
			border-color:#6F6F6F !important;
			border-style: groove;
		}
		.card-text{
			top: 3px;
			color: #6F6F6F;
			font-size: 15px;
			padding: 18px;
			font-weight: bold;
			position: relative;
		}.page{
			text-align: center;
			font-weight: bold;
			font-size: 18px;
		}
	</style>
</head>
<body class = "container" style="max-width: 600px">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="create_agent.php">Create</a>
		<a class ="btn right hide-on-down button" href="home.php">Home</a>
	</nav>
	<section>
	<?php 
		$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$users = $db->select('property_agent',['id','username']);
	?>
	<?php foreach ($users as $user):?>
	<?php if($user['id']>1): ?>
	<div class="card">
		<a class="card-text" href="agent_details.php?userID=<?php echo($user['id']); ?>">
			<?php echo "".$user['id'].".&nbsp;".$user['username'];?>
		</a>
	</div>
	<?php endif; ?>
	<?php endforeach; ?>
	</section>

</body>
</html>