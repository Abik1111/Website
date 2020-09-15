<?php
	include 'Jagga.php';
	$dataJust = false;
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if(!$_SESSION['is_pending']){
		header("Location:home.php");
	}
	
	if(isset($_POST['submit'])){
		$jagga = new JaggaRequestSave($_SESSION['client_host'],$_SESSION['client_username'],$_SESSION['client_password']);
		$dataJust = $jagga->saveData('location','area', 'price', 'description', 'owner_contact', 'files', 'type', 'user_id');
		//echo 'Data requested successfully';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Database</title>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET"><input type="submit" name="link" value="data_list"></form>

<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
	Location:<br/><input type="text" name="location"><br/>
	Area(sq.m):<br/><input type="number" name="area"><br/>
	Price:<br/><input type="number" name="price"><br/>
	Owner Contact(Your Information for this jagga):<br/><input type="text" name="owner_contact"><br/>
	<input type="hidden" name="user_id" value="1">
	Property Type:<br/><select name="type" value="0">
    <option value="1">Land</option>
    <option value="0">House</option>
    </select><br/>
	Description:<br/><textarea name="description" rows=5></textarea><br/>
	Images:<br/><input type="file" name="files[]" accept="image/*" multiple></br></br>
	<input type="submit" name="submit" value="Add Data">
</form>
</body>
</html>