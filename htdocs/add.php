<?php
	require 'Jagga.php';

	if(isset($_POST['submited'])){
		$jagga = new JaggaSave('localhost', 'dilip', '123456789');
		$result = $jagga->saveData('location', 'area', 'price', 'description', 'owner_contact', 'image');
		if($result){
			header("location:details.php?id=$result");
		}
		else{
			echo 'failed to save database';
		}
	}
?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<section class="container grey-text">
		<h4 class="center">Submit your property data</h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
			<label>Location:</label><input type="text" name="location">
			<label>Area :</label><input type="text" name="area">
			<label>Price :</label><input type="text" name="price">
			<label>Description :</label><input type="text" name="description">
			<label>Owner Contact(Not visible to clients) :</label><input type="text" name="owner_contact">
			<label>Reference images </label><input type="file" name="image[]" multiple>
			<div class="center">
				<input type="submit" name="submited" value="submit your data" class="btn brand z-depth-0">
			</div>
			<?php //$handler->deleteAllImages('123');?>
		</form>
	</section>
	
	
	<?php include('Templates/footer.php')?>

</html>