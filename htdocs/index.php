<?php

	require('config/db_connect.php');
	//Write query for property_database
	$sql ='SELECT id,address,uploaded_time,description FROM properties ORDER BY id';
	
	//Make query and get result
	$result = mysqli_query($conn, $sql);
	
	//Check the query error
	if(!$result){
		echo "Problem in making query";
	}
	
	//Fetch the resutling rows in array
	//Making the data readable
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//Free the query result from memory
	mysqli_free_result($result);
	//Close the connection
	mysqli_close($conn);
	
	//Outputting the data
	//print_r($rows);
	

?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<h4 class="center grey-text">Available properties</h4>
	
	<div class="container">
		<div class="row"> 
			<?php foreach($rows as $each_row):?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php	echo  htmlspecialchars($each_row['address']);?></h6>
							<div><?php	echo  htmlspecialchars($each_row['uploaded_time']);?></div>
						</div>
						<div class="card-action right-align">
							<a href="details.php?id=<?php echo $each_row['id']?>" class="brand-text">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach?>
		</div>
	</div>
	
	<?php include('Templates/footer.php')?>

</html>