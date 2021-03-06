<?php
	include 'Jagga.php';
	
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if(!$_SESSION['is_root']){
		header("Location:home.php");
	}
	
	$id=0;
	$data_found = false;
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$jagga = new JaggaRequestRetrieve($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$result = $jagga->loadFromDatabase($id);
		$data_found = true;
	}
	else if(isset($_POST['approve']) || isset($_POST['delete'])){
		if(isset($_POST['approve'])){
			$temp = new JaggaSave($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
			$temp->saveFromRequest($_POST['id'], 'location', 'area', 'price', 'description', 'owner_contact', 'files', 'type', 'user_id', 'delete_prev');
			$user_id = $_POST['user_id'];
			if($user_id >=0){
				//TODO::Update client approved
			}
		}
		$data = new JaggaRequestDelete($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$data->delete($_POST['id']);
		header('location:pending_datas.php');
	}
	else{
		$result = 0;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Database</title>
</head>

<body>
	<a href="?link=request_data_list">View request data</a>
<br/>
<?php if($result):?>
<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
	Request Id:<?php $jagga->echoId();?><br/><input type="hidden" name="id" value="<?php $jagga->echoId();?>">
	Location:<br/><input type="text" name="location" value="<?php $jagga->echoLocation();?>"><br/>
	Area(sq.m):<br/><input type="number" name="area" value="<?php $jagga->echoArea();?>"><br/>
	Price:<br/><input type="number" name="price" value="<?php $jagga->echoPrice();?>"><br/>
	Owner Contact(Not shown to clients):<br/><input type="text" name="owner_contact"  value="<?php $jagga->echoOwnerContact();?>"><br/>
	Requesting Cliend id:<?php $jagga->echoUserId();?><br/><br/><input type="hidden" name="user_id" value="<?php $jagga->echoUserId();?>">
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
	Delete user images:<select name="delete_prev">
		<option value="0">No</option>
		<option value="1">Yes</option>
	</select><br/>
	<br/><input type="file" name="files[]" accept="image/*" multiple></br></br>
	<input type="submit" name="approve" value="Approve and upload">
	<input type="submit" name="delete" value="Reject and Delete">
</form>
<br/>
<?php endif?>
</body>
</html>