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
		$users = $db->select('property_agent',null,"id=$userID");
		$user = $users[0];
	}
	
	if(isset($_POST['delete'])){
		$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$username = $_POST['username'];
		$user = new User($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$user->dropUser('%',$username);
		$db->delete("property_agent","username='$username'");
		header("Location:agents.php");
	}

	if(isset($_POST['back'])){
		header("Location:agents.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ghar Jagga</title>
</head>
<body>
	<section>
		<div>
			<h4"><?php echo htmlspecialchars($user['username']); ?></h4>
 			<p>Password : <?php echo htmlspecialchars($user['password']); ?></p>
 			<h5>Details:</h5>
 			<p><?php echo htmlspecialchars($user['details'])?></p>
 			<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 				<input type="hidden" name="username" value="<?php echo $user['username']?>">
 				<input type="submit" name="delete" value = "Delete" >
 				<input type="submit" name="back" value = "Back" >
 			</form>
 		</div>
	</section>
</body>
</html>