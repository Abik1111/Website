<?php
	include 'Jagga.php';
	
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	
	$data_found = false;
	$id=0;
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$temp = new JaggaSave($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$temp->updateData($id, 'location', 'area', 'price', 'description', 'owner_contact', 'files', 'type', 'delete_prev');
		//Updated success fully
	}
	if(isset($_POST['delete'])){
		$data = new JaggaDelete($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$data->delete($_POST['id']);
		header('location:datas.php');
	}
	else if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	$jagga = new JaggaRetrieve($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
	$result = $jagga->loadFromDatabase($id);
	$data_found = true;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Database</title>
</head>

<body>
<a href="datas.php">go to datas</a>
<br/>
<?php if($result):?>
<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
	Id:<?php $jagga->echoId();?><br/><input type="hidden" name="id" value="<?php $jagga->echoId();?>">
	Location:<br/><input type="text" name="location" value="<?php $jagga->echoLocation();?>"><br/>
	Area(sq.m):<br/><input type="number" name="area" value="<?php $jagga->echoArea();?>"><br/>
	Price:<br/><input type="number" name="price" value="<?php $jagga->echoPrice();?>"><br/>
	Owner Contact(Not shown to clients):<br/><input type="text" name="owner_contact"  value="<?php $jagga->echoOwnerContact();?>"><br/>
	<?php if(($jagga->getUserId())>=0):?>
		Requesting Cliend id:<?php $jagga->echoUserId();?><br/>
	<?php endif?>
	Property Type:<br/><select name="type">
		<?php if($jagga->getType()==1):?>
			<option value="1">Land</option>
			<option value="0">House</option>
		<?php else:?>
			<option value="0">House</option>
			<option value="1">Land</option>
    <?php endif?></select><br/>
	Description:<br/><textarea name="description" rows=5 ><?php $jagga->echoDescription();?></textarea><br/>
	Images:<br/>
	<?php for($i=0; $i< $jagga->getNumberOfImages(); $i++):?>
		<img src="<?php $jagga->echoImageSrc($i);?>" height=150>
	<?php endfor;?><br/>
	Delete old images:<select name="delete_prev">
		<option value="0">No</option>
		<option value="1">Yes</option>
	</select><br/>
	<br/><input type="file" name="files[]" accept="image/*" multiple></br></br>
	<input type="submit" name="update" value="Update Data">
	<input type="submit" name="delete" value="Delete Data">
</form>
<br/>
<?php endif?>
</body>
</html>