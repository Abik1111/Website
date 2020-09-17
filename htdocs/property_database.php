<?php  
	include('lib/server_database.php');

	class PropertyDatabase{
		private static $host;
		private static $user;
		private static $password;
		private static $database;

		public static function create($host,$user,$password){
			PropertyDatabase::$host = $host;

			$server = new Server($host,$user,$password);
			$server->createDatabase("property");

			PropertyDatabase::$database = new Database($host,$user,$password,'property');
			PropertyDatabase::$database->createTable("property_table","
				id BIGINT NOT NULL AUTO_INCREMENT,
				address CHAR(255) NOT NULL,
				area CHAR(255) NOT NULL,
				price FLOAT NOT NULL,
				description TEXT NOT NULL,
				date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				owner_contact CHAR(255) NOT NULL,
				availability INT NOT NULL,
				is_jagga INT NOT NULL,
				user_id BIGINT NOT NULL, 
				primary key(id)");
			PropertyDatabase::$database->createTable("property_table_request","
				id BIGINT NOT NULL AUTO_INCREMENT,
				address CHAR(255) NOT NULL,
				area CHAR(255) NOT NULL,
				price FLOAT NOT NULL,
				description TEXT NOT NULL,
				date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				owner_contact CHAR(255) NOT NULL,
				availability INT NOT NULL,
				is_jagga INT NOT NULL,
				user_id BIGINT NOT NULL, 
				primary key(id)");
			PropertyDatabase::$database->createTable("property_agent","
				id BIGINT NOT NULL AUTO_INCREMENT,
				username CHAR(255) NOT NULL,
				password CHAR(255) NOT NULL,
				details CHAR(255),
				primary key(id)");
			PropertyDatabase::$database->createTable("property_client","
				id BIGINT NOT NULL AUTO_INCREMENT,
				username CHAR(255) NOT NULL,
				password CHAR(255) NOT NULL,
				contact CHAR(255) NOT NULL,
				details CHAR(255),
				approved_properties TEXT NOT NULL,
				pending_properties TEXT NOT NULL,
				primary key(id)");
			PropertyDatabase::$database->createTable("property_client_request","
				id BIGINT NOT NULL AUTO_INCREMENT,
				username CHAR(255) NOT NULL,
				password CHAR(255) NOT NULL,
				contact  CHAR(255) NOT NULL,
				details CHAR(255),
				primary key(id)");
			$datas0 = ['id'=>'1','username'=>$user,'password'=>$password];
			PropertyDatabase::$database->insert("property_agent",$datas0);
			$user = new User($host,$user,$password);
			$user->createUser('%','client','password');
			$user->grant('INSERT,SELECT','property','property_table_request','%','client');
			$user->grant('INSERT,SELECT','property','property_client','%','client');
			$user->grant('INSERT,SELECT','property','property_client_request','%','client');
			$user->grant('INSERT,SELECT','property','property_table','%','client');
		}
	}

	/////////////////
	PropertyDatabase::create('localhost','peter','password');


 ?>