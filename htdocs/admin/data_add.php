<?php
	include 'Jagga.php';
	$dataJust = false;
	if(isset($_POST['submit'])){
		$jagga = new JaggaSave('localhost', 'dilip', '123456789');
		$dataJust = $jagga->saveData('location','area', 'price', 'description', 'owner_contact', 'files', 'type', 'user_id');
		//print_r($_FILES);
		echo 'Data submitted successfully';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Database</title>
</head>

<body>
<a href="datas.php">View all data</a>
<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
	Location:<br/><input type="text" name="location"><br/>
	<input type="hidden" name="user_id" value='-1'><br/>
	Area(sq.m):<br/><input type="number" name="area"><br/>
	Price:<br/><input type="number" name="price"><br/>
	Owner Contact(Not shown to clients):<br/><input type="text" name="owner_contact"><br/>
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