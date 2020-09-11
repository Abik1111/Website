<?php  
	include('lib/server_database.php');

	class JaggaDatabase{
		private static $host;
		private static $user;
		private static $password;
		private static $database;

		public static function create($host,$user,$password){
			JaggaDatabase::$host = $host;

			$server = new Server($host,$user,$password);
			$server->createDatabase("jagga");

			JaggaDatabase::$database = new Database($host,$user,$password,'jagga');
			JaggaDatabase::$database->createTable("jagga_table","
				id INT NOT NULL AUTO_INCREMENT,
				address CHAR(255) NOT NULL,
				area FLOAT NOT NULL,
				price FLOAT NOT NULL,
				description MULTILINESTRING NOT NULL,
				date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				availability BOOLEAN NOT NULL,
				primary key(id)");
			JaggaDatabase::$database->createTable("jagga_user","
				id INT NOT NULL AUTO_INCREMENT,
				username CHAR(255) NOT NULL,
				password CHAR(255) NOT NULL,
				primary key(id)");
			$datas0 = ['id'=>'1','username'=>$user,'password'=>$password];
			JaggaDatabase::$database->insert("jagga_user",$datas0);
		}

		


	}


 ?>