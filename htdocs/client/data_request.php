<?php
	include 'Jagga.php';
	$dataJust = false;
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if($_SESSION['is_pending']){
		header("Location:home.php");
	}
	
	$success = "";
	if(isset($_POST['submit'])){
		$jagga = new JaggaRequestSave($_SESSION['host'],$_SESSION['client_username'],$_SESSION['client_password']);
		$dataJust = $jagga->saveData('location','area', 'price', 'description', 'owner_contact', 'files', 'type', 'user_id');
		$user_id = $_SESSION['client_id'];
		$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'property');
		$clients = $db->select('property_client',['pending_properties'],"id=$user_id"); 
		$client = $clients[0];
		$pending  = $client['pending_properties']." $dataJust";
		$db->update('property_client',['pending_properties'=>$pending],"id=$user_id");
		$success="Data is successfully submitted";
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
			color: #9F9F9F;
			text-decoration: underline;
		}
	</style>
</head>
<body class="container" style="max-width: 600px">
	<header class="header header-text" >
		REQUEST NEW DATA
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="home.php">Home</a>
	</nav>
	<label class="inform"><?php echo $success; ?></label>
	<form class="white" action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
		<div>
			<label class="label">Location:</label>
			<input type="text" name="location" required autofocus>
			<input type="hidden" name="user_id" value="<?php echo($_SESSION['client_id']);?>">
		</div>
		<div>
			<label class="label">Area:</label>
			<input type="text" name="area" required>
		</div>
		<div>
			<label class="label">Price(Rs):</label></div>
			<input type="number" name="price" required>
		</div>
		<div>
			<label class="label">Owner Contact(Not shown to clients):</label>
			<input type="text" name="owner_contact" required>
		</div>
		<div>
			<label class="label">Property Type:</label>
			<select class="select input-field col s12" name="type" value="0">
		    	<option  value="1">Land</option>
		    	<option value="0">House</option>
		    </select>
		</div>
		<div>
			 <label class="label">Description:</label>
			<textarea style="resize: none;height: 120px" name="description" required></textarea>
		</div>
		<div>
			<label class="label">Images:</label><br/>
			<input type="file" name="files[]" accept="image/*" multiple>
		</div>
		<br/>
		<input class ="btn right hide-on-down submit-button" type="submit" name="submit" value="Add Data">
	</form>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
</html>