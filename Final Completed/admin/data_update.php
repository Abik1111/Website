<?php
	include 'Jagga.php';
	
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}

	$data_found = false;
	$id=0;
	$success="";
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$temp = new JaggaSave($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
		$temp->updateData($id, 'location', 'area', 'price', 'description', 'owner_contact', 'files', 'type', 'delete_prev');
		$success="Data is successfully updated... <br/>";
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
			font-size: 15px;
			font-weight: bold;
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
	</style>
</head>

<body class="container" style="max-width: 600px">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="datas.php">Back</a>
	</nav>
	<label class="inform"><?php echo $success; ?></label>
	<div style="text-align: center;">
		<label style="font-weight: bold; font-size: 27px;color: #9F9F9F;">UPDATE DATA</label>
	</div>
	<?php if($result):?>
	<form class="white" action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
		<label class="label">Id : <?php $jagga->echoId();?></label>
		<input type="hidden" name="id" value="<?php $jagga->echoId();?>">
		<div>
			<label class="label">Location:</label>
			<input type="text" name="location" value="<?php $jagga->echoLocation();?>" required autofocus>
		</div>
		<div>
			<label class="label">Area:</label>
			<input type="text" name="area" value="<?php $jagga->echoArea();?>" required>
		</div>
		<div>
			<label class="label">Price(Rs):</label></div>
			<input type="number" name="price" value="<?php $jagga->echoPrice();?>" required>
		</div>
		<div>
			<label class="label">Owner Contact(Not shown to clients):</label>
			<input type="text" name="owner_contact" value="<?php $jagga->echoOwnerContact();?>" required>
		</div>
		<?php if(($jagga->getUserId())>=0):?>
			<label class="label">Requesting Cliend id:<?php $jagga->echoUserId();?></label>
		<?php endif?>
		<div>
			<label class="label">Property Type:</label>
			<select class="select input-field col s12" name="type" value="0">
				<?php if($jagga->getType()==1):?>
					<option value="1">Land</option>
					<option value="0">House</option>
				<?php else:?>
					<option value="0">House</option>
					<option value="1">Land</option>
				<?php endif; ?>
		    </select>
		</div>
		<div>
			<label class="label">Description:</label>
			<textarea style="resize: none;height: 120px;" name="description" required><?php $jagga->echoDescription();?></textarea>
		</div>
		<div>
			<label class="label">Images:</label><br/>
			<?php for($i=0; $i< $jagga->getNumberOfImages(); $i++):?>
				<img src="<?php $jagga->echoImageSrc($i);?>" height=150>
			<?php endfor;?>
			<br/>
			<input type="file" name="files[]" accept="image/*" multiple>
		</div>
		<br/>
		<div>
			<label class="label">Delete old images:</label>
			<select  class="select input-field col s12" name="delete_prev">
				<option value="0">No</option>
				<option value="1">Yes</option>
		    </select>
		</div>
		<br/><br/>
		<input class="btn right hide-on-down submit-button" type="submit" name="update" value="Update Data">
		<input class="btn left hide-on-down submit-button" type="submit" name="delete" value="Delete Data">
	</form>
	<?php endif?>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
</html>
