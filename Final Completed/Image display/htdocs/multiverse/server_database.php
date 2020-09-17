<?php 
	

	/**
		***Documentation***

		class Server
			__construct(String host,String username,String password);
			boolean createDatabase(String datbase_name);
			boolean dropDatabase(String database_name);
			connection getConnection();
			String getError();
		
		class Database
			__construct(String host,String username,String password,String database_name);
			boolean createTable(String table_name,String columns_and_columns_type);//columns include sql command
				e.g:- columns_and_columns_type = "id INT AUTO_INCREMENT,name CHAR(90) NOT NULL,job CHAR(90) NOT NULL,primary key(id)";
			boolean dropTable(String table_name);
			boolean insert(String table_name,Associative_array_1D datas);
				e.g:- datas = {'name'='Sparrow','job'='pirates'};
			Associative_array_2D select(String table_name,Array_1D fields=null,String conditions="true");conditions include sql command
				e.g:- fields = {'name','job'};
				e.g:- conditions = "id = '0' AND job = 'pirates'";
				output datas as e.g:- datas = {{'name'='Sparrow','job'='pirates'}};
			boolean update(String table_name,Associative_array_1D datas,String conditions="true");conditions include sql command
				e.g:- datas = {'name'='Sparrow','job'='pirates'};
				e.g:- conditions = "id = '0' AND job = 'pirates'";
			boolean delete(String table_name,String conditions="true");conditions include sql command
				e.g:- conditions = "id = '0' AND job = 'pirates'";
			connection getConnection();//for good practice at end of program close connections
				e.g:- connection conn = database.getConnection();
							//TODO
							mysqli_close(conn);
			String getError();

	**/



	class Server{
		private $host;
		private $username;
		private $password;
		private $errors;

		private function connect(){
			return mysqli_connect($this->host,$this->username,$this->password);
		}

		private function close($connection){
			mysqli_close($connection);
		}

		public function __construct($host,$username,$password){
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;			
		}

		public function createDatabase($database_name){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = "CREATE DATABASE IF NOT EXISTS ".$database_name;

			if(!mysqli_query($connection,$sql)){
				$errors = "Error creating database: " . mysqli_error($connection);
				$this->close(connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function dropDatabase($database_name){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysql_connect_error();
				return false;
			}

			$sql = "DROP DATABASE ".$database_name;

			if(!mysqli_query($connection,$sql)){
				$errors = "Error deleting record: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function getConnection(){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return null;
			}
			return $connection;
		}

		public function getErrors(){
			return $errors;
		}
	}

	class Database{
		private $host;
		private $username;
		private $password;
		private $database_name;
		private $errors;

		private function connect(){
			return mysqli_connect($this->host,$this->username,$this->password,$this->database_name);
		}

		private function close($connection){
			mysqli_close($connection);
		}		

		public function __construct($host,$username,$password,$database_name){
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database_name = $database_name;
		}

		public function createTable($table_name,$columns){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = "SELECT 1 FROM ".$table_name;
			$exist =  mysqli_query($connection,$sql);
			if($exist != false){
				$errors = "Already Exist: " ;
				return false;
			}

			$sql = "CREATE TABLE ".$table_name."(".$columns.")";

			if(!mysqli_query($connection,$sql)){
				$errors = "Error creating table: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function dropTable($table_name){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = "DROP TABLE ".$table_name;

			if(!mysqli_query($connection,$sql)){
				$errors = "Error deleting table: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function insert($table_name,$datas_associative_array){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$fields = implode(", ", array_keys($datas_associative_array));
			$values = array_values($datas_associative_array);
			for($i=0;$i<count($values);$i++){
				$values[$i] = "'$values[$i]'";
			}
			$values =  implode(", ", $values);

			$sql = "INSERT INTO ".$table_name."(".$fields.") VALUES (".$values.")";

			if(!mysqli_query($connection,$sql)){
				$errors = "Error inserting datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function select($table_name,$fields_array=null,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return null;
			}

			if($fields_array==null){
				$sql = "SELECT * FROM ".$table_name;
			}else{
				$fields = implode(", ",$fields_array);
				$sql = "SELECT ".$fields." FROM ".$table_name;
			}

			if($conditions!="true"){
				$sql=$sql." WHERE ".$conditions;
			}

			$result = mysqli_query($connection,$sql);

			$datas = mysqli_fetch_all($result,MYSQLI_ASSOC);

			mysqli_free_result($result);
			
			$this->close($connection);
			
			return $datas;
		}

		public function update($table_name,$datas_associative_array,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}
			$fields = array_keys($datas_associative_array);
			$values = array_values($datas_associative_array);
			for($i=0;$i<count($fields);$i++){
				$values[$i] = $fields[$i]."="."'".$values[$i]."'";
			}
			$values =  implode(", ", $values);

			$sql = " UPDATE ".$table_name." SET ".$values." WHERE ".$conditions;

			if(!mysqli_query($connection,$sql)){
				$errors = "Error updating datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function delete($table_name,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = " DELETE FROM ".$table_name." WHERE ".$conditions;

			if(!mysqli_query($connection,$sql)){
				$errors = "Error Deleting datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$errors="";
			$this->close($connection);
			return true;
		}

		public function getConnection(){
			$connection = $this->connect();
			if(!$connection){
				$errors ="Connection Error".mysqli_connect_error();
				return null;
			}
			return $connection;
		}

		public function getErrors(){
			return $errors;
		}
	}

 ?>