<?php

	require('config/db_connect.php');
	//Check get request id parameter
	if(isset($_POST['delete'])){
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
		$sql = "SELECT * FROM properties WHERE id = $delete_id";
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($result);
		$image_src = 'images/'.htmlspecialchars($data['image_name']);
		unlink($image_src);
		
		$sql = "DELETE FROM properties WHERE id = $delete_id";
		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		}
		else{
			echo "Data couldn't be deleted";
		}
	}
	
	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		
		//Make sql request
		$sql = "SELECT * FROM properties WHERE id = $id";
		//Get query result
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Error in qyery ".mysqli_error($conn);
		}
		//Fetch the data
		$data = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($conn);
		$image_src = 'images/'.htmlspecialchars($data['image_name']);
	}
?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<div class="Container Center grey-text">
		<?php if($data):?>
			<h4> <?php echo htmlspecialchars($data['address']);?></h4>
			<h5>Price: <?php	echo htmlspecialchars($data['price']);?></h5>
			<h5>Owner Email: <?php	echo htmlspecialchars($data['owner_email']);?></h5>
			<p>Description: <?php	echo htmlspecialchars($data['description']);?></p>
			<p>Posted on: <?php	echo htmlspecialchars($data['uploaded_time']);?></p>
			<!--Delete form-->
			<img src="<?php echo $image_src;?>" width=100>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="hidden" name="delete_id" value="<?php echo $data['id'];?>">
				<input type="submit" name="delete" value="Delete This Data" class="btn brand z-depth-0">
			</form>
		
		<?php else:?>
			<h5>Data not found</h5>
			<p>It might be either removed or never existed at all</p>
		<?php endif?>
	</div>
	
	<?php include('Templates/footer.php')?>

</html>