<?php
	include 'Jagga.php';
	define('DATAS_IN_PAGE', 9);
	
	session_start();
	if(!$_SESSION['is_connected']){
		header("Location:login.php");
	}
	if($_SESSION['is_pending']){
		header("Location:home.php");
	}
	$current_page = 1;
	$total_page = 1;
	$selector = new JaggaSelect($_SESSION['host'], $_SESSION['client_username'], $_SESSION['client_password']);
	$searching = false;
	$results = 0;
	
	
	//Selcting the page
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	$data = $selector->getSelectedJagga($_SESSION['client_id'],DATAS_IN_PAGE, $current_page);
	$total_page = $selector->getSelectedPagesNo($_SESSION['client_id'],DATAS_IN_PAGE);
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
			font-size: 18px;
		}
		.check{
			text-align: center;
			font-size: 18px;
			font-style: italic;
		}
	</style>
</head>
<body class="container">
	<header class="header">
		<a href="home.php" class = "header-text">
			GHAR JAGGA
		</a>
	</header>
	<nav class = "nav">
		<a class ="btn right hide-on-down button" href="home.php">Home</a>
	</nav>
	<?php if($current_page!=1):?>
	<label class="page">Page no. <?php echo $current_page?></label>
	<?php endif;?><br/>
	<div class="label">Submitted properties</div>
	<?php if(sizeof($data)==0):?>
		<div class="check center">No Datas</div>
	<?php else: ?>
	<?php foreach($data as $datum):?>
	<a href="#?id=<?php $datum->echoId();?>">
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
			$initial = ($current_page-3);
			$initial = $initial>=0?$initial:0;
			$final = ($current_page+4);
			if($final>=$total_page){
				$final=$total_page;
				$initial = $final-7;
				$initial = $initial>=0?$initial:0;
			}
		?>

		<?php for($i=$initial; $i<$final; $i++):?>
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
