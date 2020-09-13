<?php 
	include('Server_Database.php');

	// $server = new Server('localhost','peter','password');
	// $server->createDatabase("NT_RAYS");

	// $database = new Database('localhost','peter','password','NT_RAYS');
	// $database->createTable("Vector","id INT AUTO_INCREMENT,name CHAR(90) NOT NULL,type CHAR(90) NOT NULL,primary key(id)");

	// $datas1 = ['id'=>1,'name'=>'Dilip','type'=>'Sherlock'];
	// $datas2 = ['name'=>'Abinash','type'=>'Flash'];
	// $datas3 = ['name'=>'Adarsha','type'=>'Brilliant'];
	// $datas4 = ['name'=>'Peter','type'=>'Bekari'];
	

	// $database->insert("Vector",$datas1);
	// $database->insert("Vector",$datas2);
	// $database->insert("Vector",$datas3);
	// $database->insert("Vector",$datas4);

	// $datas = $database->select("Vector");
	
	// foreach ($datas as $data) {
	// 	print_r($data);
	// 	echo '<br/>';
	// }

	//$database->dropTable("Vector");
	//$server->dropDatabase("NT_RAYS");

	$user = new User('localhost','peter','password');
	$user->createUser('%','ganesh','password');
	//$user->revoke('ALL PRIVILEGES','jagga','jagga_table','%','ganesh');
	//$user->grant('DELETE,INSERT,SELECT,UPDATE','jagga','jagga_table','%','ganesh');
	//$user->dropUser('%','ganesh');
	// echo $user->getErrors();

?>	