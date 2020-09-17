<?php 
	//error_reporting(E_ERROR | E_PARSE);
	include 'lib/server_database.php';

	session_start();

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
</head>
<body>
	<section>
		<h4"><?php echo htmlspecialchars($pending_client['username']);?></h4>
		<div>
			<p>Contact : <?php echo htmlspecialchars($pending_client['contact']); ?></p>
 			<h5>Details:</h5>
 			<p><?php echo htmlspecialchars($pending_client['details'])?></p>
 			<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 				<input type="hidden" name="username" value="<?php echo $pending_client['username'] ?>">
 				<input type="submit" name="approve" value = "Approve" >
 				<input type="submit" name="dismiss" value = "Dismiss" >
 				<input type="submit" name="back" value = "Back" >
 			</form>
 		</div>
	</section>
</body>
</html>