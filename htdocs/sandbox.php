<?php

	if(isset($_POST['submit'])){
		//Cookie for name
		setcookie('username', $_POST['username'], time()+86400);
		//Expires in a day
		
		//Staring the session and adding the session value
		session_start();
		$_SESSION['name'] = $_POST['username'];
		header('Location:index.php');
	}
	
	class User{
		private $email;
		private $name;
		
		//Constructor
		public function __construct($name='Default', $email='@username'){
			$this->name = $name;
			$this->email = $email;
		}
		
		//Body method
		public function login(){
			echo $this->name.' logged in';
		}
	}
	
	$userone = new User();
	$userone->login();
	//echo $userone->name;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Php tests</title>
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<input type="name" name="username">
		<input type="submit" name="submit" value="submit your data">
	</form>
</body>

</html>