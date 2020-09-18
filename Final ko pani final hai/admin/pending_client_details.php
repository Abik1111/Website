<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if(!$_SESSION['is_root']){
		header("Location:home.php");
	}

	if(isset($_GET['userID'])){
		$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$userID = $_GET['userID'];
		$pending_clients = $db->select('property_client_request',null,"id=$userID");
		if(empty($pending_clients)){
			header("Location:pending_clients.php");
		}
		$pending_client = $pending_clients[0];
	}
	
	if(isset($_POST['dismiss'])){
		$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$username = $_POST['username'];
		$db->delete("property_client_request","username='$username'");
		header("Location:pending_clients.php");
	}

	if(isset($_POST['approve'])){
		$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$username = $_POST['username'];
		$pending_clients = $db->select('property_client_request',null,"username='$username'");
		$pending_client = $pending_clients[0];
		$data = ['username'=>$pending_client['username'],'password'=>$pending_client['password'],
				'contact'=>$pending_client['contact'],'details'=>$pending_client['details']];
		$db->insert("property_client",$data);
		$db->delete("property_client_request","username='$username'");
		header("Location:pending_clients.php");
	}

	if(isset($_POST['back'])){
		header("Location:pending_clients.php");
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
			box-shadow: 0px 0px 0px 0px!important;
		}
		.label{
			color: #9F9F9F;
			font-size: 21px;
			font-weight: bold;
		}
		.data{
			color: #9F9F9F;
			font-size: 21px;
		}
		.submit-button{
			/*background: #cbb09c !important;*/
			border-radius : 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.select {
	       display: block;
      	}
      	.inform{
			text-align: center;
			font-size: 18px;
			font-style: italic;
			color: #9F9F9F;;
			text-decoration: underline;
		}
		.card{
			border-radius: 9px;
			box-shadow: 1px 1px 1px 1px!important;
			border-width: 1px !important;
			border-color:#6F6F6F !important;
			border-style: outset;
			padding: 18px;
		}
	</style>
</head>
<body class="container" style="max-width: 600px">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="<?php echo $_SERVER['HTTP_REFERER']?>">Back</a>
	</nav>
	<div class="card">
		<div>
			<label class="label">Username : </label>
			<label class="data"><?php echo htmlspecialchars($pending_client['username']);?></label>
		</div>
		<div>
			<label class="label">Contact : </label>
			<label class="data"><?php echo htmlspecialchars($pending_client['contact']);?></label>
		</div>
		<div>
			<label class="label">Details : </label>
			<label class="data"><?php echo htmlspecialchars($pending_client['details']);?></label>
		</div>
	</div>
	<br/>	
	<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="hidden" name="username" value="<?php echo $pending_client['username'] ?>">
		<input class ="btn left hide-on-down button" type="submit" name="approve" value = "Approve" >
 		<input class ="btn right hide-on-down button" type="submit" name="dismiss" value = "Dismiss" >
 	</form>
</body>
</html>