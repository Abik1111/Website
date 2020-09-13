<?php 
	$errors = array('username'=>'','password'=>'','retypePassword'=>'','details'=>'');
	$newUsername = $newPassword = $retypePassword = $newDetails = '';
	$errors = array('address'=>'','area'=>'','description'=>'','owner_contact'=>'');
	$address='';$area=0.0;$price=0.0;$description='';$owner_contact='';$availability=1;


	if(isset($_POST['login'])){
		if(empty($_POST['username'])){
			$errors['username'] = 'An username is required <br/>';
		}else{
			$_SESSION['username'] = $_POST['username'];
		}

		if(empty($_POST['password'])){
			$errors['password'] = 'A password is required <br/>';
		}else{
			$_SESSION['password'] = $_POST['password'];
		}

		if(!array_filter($errors)){
			$server = new Server($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
			$connection = $server->getConnection();
			if($connection!=null){
				$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
				$temp =  $db->select("jagga_user");
				$username = $temp[0]['username'];
				if($username==$_SESSION['username']){
					clear();
					$_SESSION['connected']=true;
					$_SESSION['home']=true;
					$_SESSION['root']=true;
				}else{
					clear();
					$_SESSION['connected']=true;
					$_SESSION['datas']=true;
				}

				mysqli_close($connection);
			}else{
				$errors['password'] = 'Username and password do not match';
			}
		}
	}

	//links
	if($_SESSION['connected']==true){
		if(isset($_GET['link'])){
			if($_GET['link']=='logout'){
				clear();
				$_SESSION['username']='';
				$_SESSION['password']='';
				session_destroy();
			}else if($_GET['link']=='home'){
				clear();
				$_SESSION['connected']=true;
				$_SESSION['home']=true;
			}elseif ($_GET['link']=='data') {
				clear();
				$_SESSION['connected']=true;
				$_SESSION['datas']=true;
			}elseif ($_GET['link']=='user') {
				clear();
				$_SESSION['connected']=true;
				$_SESSION['users']=true;
			}elseif ($_GET['link']=='add_user') {
				clear();
				$_SESSION['connected']=true;
				$_SESSION['add_user']=true;
			}elseif ($_GET['link']=='add_data') {
				clear();
				$_SESSION['connected']=true;
				$_SESSION['add_data']=true;
			}
		}
	}

	//userID
	if($_SESSION['connected']==true){
		if(isset($_GET['userID'])){
			clear();
			$_SESSION['connected']=true;
			$_SESSION['users']=true;
			$_SESSION['userID']=$_GET['userID'];
		}
	}

	//dataID
	if($_SESSION['connected']==true){
		if(isset($_GET['dataID'])){
			clear();
			$_SESSION['connected']=true;
			$_SESSION['datas']=true;
			$_SESSION['dataID']=$_GET['dataID'];
		}
	}

	//delete user
	if($_SESSION['connected']==true){
		if(isset($_POST['delete_user'])){
			$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
			$id = $_SESSION['userID'];
			$temp =  $db->select("jagga_user",null,"id='$id'");
			$user = new User($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
			$user->dropUser('%',$temp[0]['username']);
			$db->delete("jagga_user","id='$id'");
			clear();
			$_SESSION['connected']=true;
			$_SESSION['users']=true;
		}
	}

	//delete data
	if($_SESSION['connected']==true){
		if(isset($_POST['delete_data'])){
			$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
			$id = $_SESSION['dataID'];
			$db->delete("jagga_table","id='$id'");
			clear();
			$_SESSION['connected']=true;
			$_SESSION['datas']=true;
		}
	}	

	//add user
	if($_SESSION['connected']==true){
		if(isset($_POST['add_user'])){
			if(empty($_POST['username'])){
				$errors['username'] = 'An username is required <br/>';
			}else{
				$newUsername = $_POST['username'];
			}

			if(empty($_POST['password'])){
				$errors['password'] = 'A password is required <br/>';
			}else{
				$newPassword = $_POST['password'];
			}

			if(empty($_POST['retypePassword'])){
				$errors['retypePassword'] = 'A password do not match!<br/>';
			}else{
				$retypePassword = $_POST['retypePassword'];
			}

			$newDetails = $_POST['details'];

			if($newPassword==$retypePassword){
				$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
				$temp =  $db->select("jagga_user",null,"username='$newUsername'");
				if(!empty($temp)){
				 	$errors['username'] = 'This username already exist<br/>';
				}
				if(!array_filter($errors)){
					$user = new User($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
					$user->createUser('%',$newUsername,$newPassword);
					$user->grant(" DELETE,INSERT,SELECT,UPDATE ",'jagga','jagga_table','%',$newUsername);
					
					$datas0 = ['username'=>$newUsername,'password'=>$newPassword,'details'=>$newDetails];
					$db->insert("jagga_user",$datas0);
					clear();
					$_SESSION['connected']=true;
					$_SESSION['users']=true;
				}
			}else{
				$errors['retypePassword'] = 'A password do not match!<br/>';
			}
		}
	}

	//add data
	if($_SESSION['connected']==true){
		if(isset($_POST['add_data'])){
			if(empty($_POST['address'])){
				$errors['address'] = 'An address is required <br/>';
			}else{
				$address = $_POST['address'];
			}

			if($_POST['area']==0){
				$errors['area'] = 'A area can not be zero <br/>';
			}else{
				$area = $_POST['area'];
			}

			if($_POST['price']==0){
				$errors['price'] = 'A price can not be zero <br/>';
			}else{
				$price = $_POST['price'];
			}

			if(empty($_POST['description'])){
				$errors['description'] = 'Description is required <br/>';
			}else{
				$description = $_POST['description'];
			}

			if(empty($_POST['owner_contact'])){
				$errors['owner_contact'] = 'Owner contact is required <br/>';
			}else{
				$owner_contact = $_POST['owner_contact'];
			}

			if(!array_filter($errors)){
				$db =  new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
				$data = ['address'=>$address,'area'=>$area,'price'=>$price,'description'=>$description,
				  		'owner_contact'=>$owner_contact,'availability'=>1];
				$db->insert('jagga_table',$data);
				clear();
				$_SESSION['connected']=true;
				$_SESSION['datas']=true;
			}
		}
	}

 ?>

<!DOCTYPE html>
<html>
	<head>
	<title>Ghar Jagga</title>
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="
		https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.header{
			background: #FFFFFF;
			height: 90px;
			text-align: center;
			font-size: 40px;
			font-weight: bold;
			padding: 10px;
			padding-left: 20px;
			text-orientation: sideways;
		}
		.brand{
			background: #cbb09c !important;
		}
		.brand-text{
			color: #cbb09c !important;
			font-weight: bold;
		}
		form{
			max-width: 460px;
			margin: 20px auto;
			padding: 20px;
		}
		.picture{
			width : 100px;
			height: 100px;
			margin :40px auto 20px;
			display: block;
			position: relative;
			top: 10px;
		}
		.group-text{
			color: #cbb09c !important;
			font-weight: bold;
			font-size: 30px;
		}
		.list{
			background-color: #FFFFFF;
			height: 80px;
			display: block;
			margin: 10px;
		}
		.list-text{
			color: #9F9F9F;
			font-size: 20px;
			padding: 20px;
			font-weight: bold;
		}
		.search{
			background-color: #cbb09c;
			font-size: 20px;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body class = "grey lighten-4">
		<header class="header">
			<a href="?link=home" class = "brand-text">ADMIN LOGIN</a>
		</header>
		<?php if($_SESSION['connected']==true): ?>
			<nav class = "white z-depth-0">
				<div class = "container">
					<ul id = "nav-mobile" class = "<?php echo($_SESSION['home']==true?'right':'left')?> hide-on-down" >
						<li>
							<?php if($_SESSION['home']!=true): ?>
							<input type="search" name="Search" class="search" placeholder="  search "
								 size="<?php echo($_SESSION['root']==true?90:103)?>">
							<?php endif; ?>
						</li>
						<?php if($_SESSION['connected']==true && $_SESSION['root']==true):?>
							<li><a href="?link=home" class ="btn brand z-depth-0">Home</a></li>
						<?php endif; ?>
						<?php if($_SESSION['connected']==true && $_SESSION['datas']==true):?>
							<li><a href="?link=add_data" class ="btn brand z-depth-0">Add Data</a></li>
						<?php elseif($_SESSION['connected']==true  && $_SESSION['users']==true && $_SESSION['root']==true):?>
							<li><a href="?link=add_user" class ="btn brand z-depth-0">Add User</a></li>
						<?php endif; ?>	
						<li><a href="?link=logout" class ="btn brand z-depth-0">log out</a></li>
					</ul>
				</div>
			</nav>
			<br/><br/><br/>
		<?php endif; ?>

	<?php if($_SESSION['connected']==true && $_SESSION['home']==true && $_SESSION['root']==true): ?>
		<div class = "container">
			<div class = row>
				<div class = "col s6 md3">
					<div class = "card z-depth-0">
					<img src="img/data.png" class = "picture">
					<div class = "card-content center">
						<a class = "group-text" href="?link=data"> Datas</a>
					</div>
					</div>
				</div>
				<div class = "col s6 md3">
					<div class = "card z-depth-0">
					<img src="img/user.png" class = "picture">
					<div class = "card-content center">
						<a class = "group-text" href="?link=user">Users</a>
					</div>
					</div>
				</div>
			</div>
		</div>
	<?php elseif($_SESSION['connected']==true && $_SESSION['users']==true && $_SESSION['root']==true): ?>
		<?php if($_SESSION['userID']!=0): ?>
			<?php 
				$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
				$temp = $_SESSION['userID'];
				$users = $db->select('jagga_user',null,"id=$temp");
				$user = $users[0];
			?>
			<div class = "container center grey-text">
 				<h4><?php echo htmlspecialchars($user['username']); ?></h4>
 				<p>Password : <?php echo htmlspecialchars($user['password']); ?></p>
 				<h5>Details:</h5>
 				<p><?php echo htmlspecialchars($user['details'])?></p>
 				<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 					<input type="submit" name="delete_user" value = "delete" class = "btn brand z-depth-0">
 				</form>
 			</div>
		<?php else: ?>
			<div>
				<?php 
					$db = new Database($_SESSION['host'],$_SESSION['username'],$_SESSION['password'],'jagga');
					$users = $db->select('jagga_user');
				?>
				<ul class="container">
				<?php foreach ($users as $user):?>
					<?php if($user['id']!=1): ?>
						<li class="list">
							<a href="?userID=<?php echo($user['id']); ?>" class="list-text">
								<?php echo $user['username']."&nbsp;(".$user['details'].")";?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php elseif($_SESSION['connected']==true && $_SESSION['datas']==true): ?>
		<?php if($_SESSION['dataID']!=0): ?>
			<?php 
				$jagga = new JaggaRetrieve($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
				$jagga->loadFromDatabase($_SESSION['dataID']);
			?>
			<div class = "container grey-text">
				<form class = "white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<label>Address:</label>
					<input type="text" name="address" value="<?php $jagga->echoLocation(); ?>">
					<div class = "red-text"><?php echo $errors['address']; ?></div>
					<label>Area(Square meter):</label>
					<input type="number" name="area" value="<?php $jagga->echoArea(); ?>">
					<div class = "red-text"><?php echo $errors['area']; ?></div>
					<label>Price(Rs):</label>
					<input type="number" name="price" value="<?php $jagga->echoPrice(); ?>">
					<div class = "red-text"><?php echo $errors['price']; ?></div>
					<label>Owner Contact(Not shown to clients):</label>
					<input type="text" name="owner_contact" value="<?php $jagga->echoOwnerContact(); ?>">
					<label>Description:</label>
					<textarea name="description" rows="20" cols="30"><?php $jagga->echoDescription(); ?></textarea>
					<div class = "red-text"><?php echo $errors['description']; ?></div>
					<div class = "red-text"><?php echo $errors['owner_contact']; ?></div>
					<div class = "center">
						<input type="submit" name="add_data" value = "Update" class="right btn brand z-depth-0">
					</div>
					<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
						<input type="submit" name="delete_data" value = "delete" class = "left btn brand z-depth-0">
					</form>
				</form>
 			</div>
		<?php else: ?>
			<div>
				<?php
					$jagga = new JaggaSelect($_SESSION['host'],$_SESSION['username'],$_SESSION['password']);
					$datas = $jagga->getAllJagga();
				?>
				<ul class="container">
				<?php foreach ($datas as $data):?>
					<li class="list">
						<img src="<?php $data->echoCoverSrc();?>" height=80 width=120>
						<a href="?dataID=<?php $data->echoId(); ?>" class="list-text">
							<?php echo $data->getLocation()."&nbsp;(".$data->getArea().
								" m2 &nbsp;&nbsp;&nbsp;Rs. ".$data->getPrice().")";?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php elseif($_SESSION['connected']==true && $_SESSION['add_user']==true && $_SESSION['root']==true): ?>
		<section class = "container grey-text">
			<h4 class = "center">Add User</h4>
			<form class = "white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Username:</label>
				<input type="text" name="username" value="<?php echo $newUsername; ?>">
				<div class = "red-text"><?php echo $errors['username']; ?></div>
				<label>Password:</label>
				<input type="password" name="password" value="<?php echo $newPassword; ?>">
				<div class = "red-text"><?php echo $errors['password']; ?></div>
				<label>Retype Password:</label>
				<input type="password" name="retypePassword" value="<?php echo $retypePassword; ?>">
				<div class = "red-text"><?php echo $errors['retypePassword']; ?></div>
				<label>Details:</label>
				<input type="text" name="details" value="<?php echo $newDetails; ?>">
				<div class = "red-text"><?php echo $errors['details']; ?></div>
				<div class = "center">
					<input type="submit" name="add_user" value = "add" class="btn brand z-depth-0">
				</div>
			</form>
		</section>
	<?php elseif($_SESSION['connected']==true && $_SESSION['add_data']==true ): ?>
		<section class = "container grey-text">
			<h4 class = "center">Add Data</h4>
			<form class = "white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Address:</label>
				<input type="text" name="address" value="<?php echo $address; ?>">
				<div class = "red-text"><?php echo $errors['address']; ?></div>
				<label>Area(Square meter):</label>
				<input type="number" name="area" value="<?php echo $area; ?>">
				<div class = "red-text"><?php echo $errors['area']; ?></div>
				<label>Price(Rs):</label>
				<input type="number" name="price" value="<?php echo $price; ?>">
				<div class = "red-text"><?php echo $errors['price']; ?></div>
				<label>Owner Contact(Not shown to clients):</label>
				<input type="text" name="owner_contact" value="<?php echo $owner_contact; ?>">
				<label>Description:</label>
				<textarea name="description" rows="20" cols="30"><?php echo $description; ?></textarea>
				<div class = "red-text"><?php echo $errors['description']; ?></div>
				<div class = "red-text"><?php echo $errors['owner_contact']; ?></div>
				<div class = "center">
					<input type="submit" name="add_data" value = "add" class="btn brand z-depth-0">
				</div>
			</form>
		</section>
	<?php else: ?>
		<section class = "container grey-text">
			<h4 class = "center" class="brand-text">Login to continue... </h4>
			<form class = "white" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Username:</label>
				<input type="text" name="username" value="<?php echo $_SESSION['username'] ?>">
				<div class = "red-text"><?php echo $errors['username']; ?></div>
				<label>Password:</label>
				<input type="password" name="password" value="<?php echo $_SESSION['password'] ?>">
				<div class = "red-text"><?php echo $errors['password']; ?></div>
				<div class = "center">
					<input type="submit" name="login" value = "login" class="btn brand z-depth-0">
				</div>
			</form>
		</section>
	<?php endif; ?>
	<footer class = "section">
 		<div class = "center grey-text">@Copyright 2020 Ghar Jagga</div>
	</footer>
</body>

</html>