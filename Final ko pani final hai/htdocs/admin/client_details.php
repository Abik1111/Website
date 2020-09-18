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
		$clients = $db->select('property_client',null,"id=$userID");
		$client = $clients[0];
	}
	
	if(isset($_POST['back'])){
		header("Location:clients.php");
	}

	if(isset($_POST['delete'])){
		$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$username = $_POST['username'];
		$db->delete("property_client","username='$username'");
		header("Location:clients.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
</head>
<body>
	<section>
		<h4"><?php echo htmlspecialchars($client['username']);?></h4>
		<div>
			<p>Contact : <?php echo htmlspecialchars($client['contact']); ?></p>
 			<h5>Details:</h5>
 			<p><?php echo htmlspecialchars($client['details'])?></p>
 			<h5>Approved Datas:</h5>
 			<ul>
 				<?php 
 					$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
 					$datas = $db->select('property_table',['id'],"id=$userID");
				?>
				<?php foreach ($datas as $data):?>
					<li>
						<a href="?dataID=<?php echo($data['id']); ?>"><?php echo $data['id']."," ?></a>
					</li>
				<?php endforeach; ?>
 			</ul>
 			<h5>Pending Datas:</h5>
 			<ul>
 				<?php 
 					$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
 					$datas = $db->select('property_table_request',['id'],"id=$userID");
				?>
				<?php foreach ($datas as $data):?>
					<li>
						<a href="?pending_dataID=<?php echo($data['id']); ?>"><?php echo $data['id']."," ?></a>
					</li>
				<?php endforeach; ?>
 			</ul>
 			<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 				<input type="hidden" name="username" value="<?php echo $client['username'] ?>">
 				<input type="submit" name="delete" value = "Delete" >
 				<input type="submit" name="back" value = "Back" >
 			</form>
 		</div>
	</section>
</body>
</html>