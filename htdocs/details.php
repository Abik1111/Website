<?php

	require('Jagga.php');
	
	if(isset($_POST['delete'])){
		$jagga = new JaggaDelete('localhost', 'dilip', '123456789');
		$result = $jagga->delete($_POST['delete_id']);
		if($result){
			echo 'success';
		}
	}
	
	if(isset($_GET['id'])){
		$jagga = new JaggaRetrieve('localhost', 'dilip', '123456789');
		$data_exists = $jagga->loadFromDatabase($_GET['id']);
	}
	else{
		$data_exists = false;
	}
?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<div class="Container Center grey-text">
		<?php if($data_exists):?>
			<h4> <?php $jagga->echoLocation();?></h4>
			<h5>Price: <?php $jagga->echoPrice();?></h5>
			<h5>Owner Email: <?php	$jagga->echoOwnerContact();;?></h5>
			<p>Description: <?php $jagga->echoDescription();?></p>
			<p>Area: <?php $jagga->echoArea();?></p>
			<p>Available: <?php $jagga->echoAvailability();?></p>
			<p>Posted on: <?php	$jagga->echoPostedTime();?></p>
			<!--Delete form-->
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="hidden" name="delete_id" value="<?php $jagga->echoID();?>">
				<input type="submit" name="delete" value="Delete This Data" class="btn brand z-depth-0">
			</form>
			<?php for($i=0; $i<$jagga->getNumberOfImages(); $i++):?>
				<p><img src="<?php $jagga->echoImageSrc($i);?>" width=900></p>
			<?php endfor?>
		<?php else:?>
			<h5>Data not found</h5>
			<p>It might be either removed or never existed at all</p>
		<?php endif?>
	</div>
	
	<?php include('Templates/footer.php')?>

</html>