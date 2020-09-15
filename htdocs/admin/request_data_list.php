<?php
	define('DATAS_IN_PAGE', 5);
	$current_page = 1;
	$total_page = 1;
	$selector = new JaggaRequestSelect('localhost', 'dilip', '123456789');
	$searching = false;
	$results = 0;
	
	//Selcting the page
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	$data = $selector->getAllJagga(DATAS_IN_PAGE, $current_page);
	$total_page = $selector->getAllPagesNo(DATAS_IN_PAGE);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Available databases</title>
</head>

<body>
	<a href="?link=data_list">View all data</a><br/>
	
	<?php if($current_page!=1):?>
	 Page no. <?php echo $current_page?>
	<?php endif;?><br/>
	<?php if($searching):?>
	 Showing result for '<?php echo $_SESSION['data_search'];?>' (<?php echo ''.$results.'-';?>result/s found)
	<?php else:?>
	Showing latest properties
	<?php endif;?><br/>
	<?php foreach($data as $datum):?>
	<img src="<?php $datum->echoCoverSrc();?>" width=150 height=100>
	
	<a href="?link=request_data_approve&id=<?php $datum->echoId();?>">
	<?php
		$datum->echoId();echo '-'; 
		$datum->echoLocation();echo ' '; 
		$datum->echoArea();echo ' ';
		echo 'Rs. ';JaggaBlock::echoMoneyFormat($datum->getPrice());echo '/- ';
		$datum->echoType(); ?><br/>
	<?php endforeach;?>
	</a>
	
	<br/>
	<br/>
	
	<?php  if($current_page != 1):?>
	<a href="?link=request_data_list&page=<?php echo($current_page-1);?>">&lt&lt prev</a>
	<?php endif;?>
	
	<?php for($i=0; $i<$total_page; $i++):?>
	<a href="?link=request_data_list&page=<?php echo($i+1);?>"><?php echo ($i+1).' '?></a>
	<?php endfor;?>
	
	<?php  if($current_page != $total_page):?>
	<a href="?link=request_data_list&page=<?php echo($current_page+1);?>">next page&gt&gt</a>
	<?php endif;?>
	
</body>
</html>