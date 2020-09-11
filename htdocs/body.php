<?php

	require('config/db_connect.php');
	require 'Image_Handler.php';
	$handler = new ImageHandler('hello_folder');
	
	//If this page is visited and submited data 
	if(isset($_POST['submited'])){
		//echo "suprise welcome back";
		//We can check error in data here
		
		$email = mysqli_real_escape_string($conn,$_POST['owner_email']);
		$description =  mysqli_real_escape_string($conn,$_POST['description']);
		$address = mysqli_real_escape_string($conn,$_POST['address']);
		$price = mysqli_real_escape_string($conn,$_POST['price']);
		
		//Save Image in server location
		$handler->saveImage(123, 'cover_image');
		
		//$sql = "INSERT INTO properties(owner_email, description, address, price, image_location, image_name) VALUES('$email', '$description', '$address', '$price', '$folder', '$image_name')";
		//Create sql
		//Save to database
		//if(mysqli_query($conn, $sql)){
			//header('Location:index.php');
		//}
		//else{
			//echo "problem in storing : ".mysqli_error($conn);
		//}
		
	}
	else{
		//User just visited this site
		//Welcome them
	}
	$images = $handler->getImagesNames(123);
?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<section class="container grey-text">
		<h4 class="center">Submit your property data</h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
			<label>Email :</label><input type="text" name="owner_email">
			<label>Description :</label><input type="text" name="description">
			<label>Address(Saperate by comma) :</label><input type="text" name="address">
			<label>Price :</label><input type="text" name="price">
			<label>Upload Image </label><input type="file" name="cover_image">
			<?php foreach($images as $image):?>
			<p><img src="<?php echo $handler->getSrc(123, $image); ?>" width= 420></p>
			<?php endforeach?>
			<div class="center">
				<input type="submit" name="submited" value="submit your data" class="btn brand z-depth-0">
			</div>
			<?php //$handler->deleteAllImages('123');?>
			
			
		</form>
	</section>
	
	
	<?php include('Templates/footer.php')?>

</html>