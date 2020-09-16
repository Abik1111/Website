<?php
	include 'Jagga.php';
	define('DATAS_IN_PAGE', 5);
	
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	$current_page = 1;
	$total_page = 1;
	$selector = new JaggaSelect($_SESSION['host'], $_SESSION['username'], $_SESSION['password']);
	$searching = false;
	$results = 0;
	
	
	//Set session if not exist
	if(!array_key_exists('data_search', $_SESSION)){
		$_SESSION['data_search']='';
	}
	
	//Selcting the page
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	
	if(isset($_GET['clear'])){
		$_SESSION['data_search'] = '';
	}
	
	//Getting the search data
	if(isset($_GET['search']) || $_SESSION['data_search']!=''){
		if(isset($_GET['search'])){
			$_SESSION['data_search'] = $_GET['search_key'];
		}
		$data = $selector->getSearchedJagga($_SESSION['data_search'], DATAS_IN_PAGE, $current_page);
		$total_page = $selector->getSearchPagesNo($_SESSION['data_search'], DATAS_IN_PAGE);
		$results = $selector->getResultsNo($_SESSION['data_search'], DATAS_IN_PAGE);
		if($_SESSION['data_search']!=''){
			$searching = true;
		}
	}
	else{
		$data = $selector->getAllJagga(DATAS_IN_PAGE, $current_page);
		$total_page = $selector->getAllPagesNo(DATAS_IN_PAGE);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Available databases</title>
</head>

<body>
	<a href="data_add.php">+Add new data</a>
	<br/>
	<form action = "<?php echo $_SERVER['PHP_SELF']?>" method="GET">
		<input type="text" name="search_key" value="<?php echo $_SESSION['data_search'];?>"/>
		<?php if($searching):?><a href="?link=data_list&clear=true">clear</a><?php endif;?>
		<input type="submit" name="search" value="search"/>
	</form>
	
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
	
	<a href="data_update.php?id=<?php $datum->echoId();?>">
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
	<a href="?page=<?php echo($current_page-1);?>">&lt&lt prev</a>
	<?php endif;?>
	
	<?php for($i=0; $i<$total_page; $i++):?>
	<a href="?page=<?php echo($i+1);?>"><?php echo ($i+1).' '?></a>
	<?php endfor;?>
	
	<?php  if($current_page != $total_page):?>
	<a href="?page=<?php echo($current_page+1);?>">next page&gt&gt</a>
	<?php endif;?>
	
</body>
</html>