<?php 
	
	// connect to database
	$conn = mysqli_connect('localhost','peter','password','ninja_pizza');

	// check connection
	if(!$conn){
		echo 'Connection error :'.mysql_connect_error();
	}

 ?>