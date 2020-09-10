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
		}
	}


 ?>