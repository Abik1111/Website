<?php
	require 'Jagga.php';

	$jaggaSelect = new JaggaSelect('localhost', 'dilip', '123456789');
	//If user is redirected from seach 
	if(isset($_GET['search_keyword']) && $_GET['search_keyword']!=""){
		$key = $_GET['search_keyword'];
		$datas = $jaggaSelect->getSearchedJagga($key,'','');
		$searched = true;
	}
	else{
		$datas = $jaggaSelect->getAllJagga(6,0);
		JaggaSelect::parseToJson($datas, 'files.json', 'Names');
		//JaggaSelect::deleteJson('files.json');
		$searched = false;
	}

	if(!$datas){
		echo 'error';
	}
	
?>

<!DOCTYPE html>
<html>

	<?php include('Templates/header.php')?>
	
	<?php if($searched):?>
		<h4 class="center grey-text">Showing result for "<?php echo $key?>"</h4>
	<?php else:?>
		<h4 class="center grey-text">Available properties</h4>
	<?php endif;?>
	
	<div class="container">
		<div class="row"> 
			<?php foreach($datas as $data):?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<img src="<?php $data->echoCoverSrc();?>" height = 100>
							<div>Location: <?php $data->echoLocation();?></div>
							<div>Area :<?php $data->echoArea();?></div>
							<div>Price :<?php $data->echoprice();?></div>
						</div>
						<div class="card-action right-align">
							<a href="details.php?id=<?php $data->echoID();?>" class="brand-text">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach?>
		</div>
	</div>
	
	<?php include('Templates/footer.php')?>

</html>