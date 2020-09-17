<?php
	include 'Jagga.php';
	define('DATAS_IN_PAGE', 9);
	
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
			border-radius : 6px;
			margin-left: 6px;
			box-shadow: 0px 0px 0px 0px!important;
		}
		.search-text{
			color: #9F9F9F;
			font-size: 18px;
		}
		.label{
			font-size: 24px;
			color:#6F6F6F;
			font-weight: bolder;
		}
		.card{
			border-radius: 9px;
			height: 100px !important;
			box-shadow: 0px 0px 0px 0px!important;
			border-width: 1px !important;
			border-color:#6F6F6F !important;
			border-style: groove;
		}
		.card-img{
			width : 150px;
			height: 100px;
			padding: 3px;
			border-radius: 9px;
			position: relative;
			border-width: 3px;
			/*border-style: groove;*/
		}
		.card-text{
			color: #6F6F6F;
			font-size: 15px;
			font-weight: bold;
			position: relative;
			top: -103px;
			left: 160px;
		}.page{
			text-align: center;
			font-weight: bold;
			font-size: 18px;
		}
		.page a{
			color: #6F6F6F;
		}
	</style>
</head>
<body class="container">
	<header class="header">
		<a href="home.php" class = "header-text">
			ADMIN
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="data_add.php">+Add new data </a>
		<?php if($_SESSION['is_root']): ?>
		<a class ="btn right hide-on-down button" href="home.php">Home</a>
		<?php else: ?>
		<a class ="btn right hide-on-down button" href="logout.php">Log Out</a>
		<?php endif; ?>
	</nav>
	<form action = "<?php echo $_SERVER['PHP_SELF']?>" method="GET">
		<input class="search-text" type="text" name="search_key" placeholder="Enter Keyword Here" value="<?php echo $_SESSION['data_search'];?>"/>
		<input class = "btn button right hide-on-down" type="submit" name="search" value="search"/>
		<?php if($searching):?><a class = "btn button right hide-on-down" href="?link=data_list&clear=true">clear</a><?php endif;?>
	</form>
	<br/>
	
	<?php if($current_page!=1):?>
	<label class="page">Page no. <?php echo $current_page?></label>
	<?php endif;?><br/>
	<?php if(sizeof($data)==0):?>
		<div class="check center">No Datas</div>
	<?php else: ?>
	<?php if($searching):?>
	<div class="label">
	 Showing result for '<?php echo $_SESSION['data_search'];?>' (<?php echo ''.$results.'-';?>result/s found)
	</div>
	<?php else:?>
	<div class="label">Showing latest properties</div>
	<?php endif;?>
	<?php foreach($data as $datum):?>
	<a href="data_update.php?id=<?php $datum->echoId();?>">
		<div class="card">
			<img src="<?php $datum->echoCoverSrc();?>" class="card-img">
			<div class="card-text">
				<?php
					echo "ID : ";$datum->echoId();echo " (";$datum->echoType();echo ")";echo '<br/>'; 
					echo "Location : ";$datum->echoLocation();echo '<br/>'; 
					echo "Area : ";$datum->echoArea();echo '<br/>';
					echo "Price(Rs) : ";echo 'Rs. ';JaggaBlock::echoMoneyFormat($datum->getPrice());echo '/- ';?>
			</div>
		</div>
	</a>
	<?php endforeach;?>
	<br/>
	<br/>
	
	<div class="page">
		<?php  if($current_page != 1):?>
		<a href="?page=<?php echo($current_page-1);?>">&lt&lt prev</a>
		<?php endif;?>
		
		<?php 
			
		?>

		<?php for($i=0; $i<$total_page; $i++):?>
		<a href="?page=<?php echo($i+1);?>"><?php echo ($i+1).' '?></a>
		<?php endfor;?>
		
		<?php  if($current_page != $total_page):?>
		<a href="?page=<?php echo($current_page+1);?>">next page&gt&gt</a>
		<?php endif;?>
	</div>
	<br/><br/><br/><br/><br/><br/>
	<?php endif; ?>
</body>
</html>
