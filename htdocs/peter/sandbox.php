
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
				$this->errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = "SELECT 1 FROM ".$table_name;
			$exist =  mysqli_query($connection,$sql);
			if($exist != false){
				$this->errors = "Already Exist: " ;
				return false;
			}

			$sql = "CREATE TABLE ".$table_name."(".$columns.")";

			if(!mysqli_query($connection,$sql)){
				$this->errors = "Error creating table: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$this->errors="";
			$this->close($connection);
			return true;
		}

		public function dropTable($table_name){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = "DROP TABLE ".$table_name;

			if(!mysqli_query($connection,$sql)){
				$this->errors = "Error deleting table: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$this->errors="";
			$this->close($connection);
			return true;
		}

		public function insert($table_name,$datas_associative_array){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$fields = implode(", ", array_keys($datas_associative_array));
			$values = array_values($datas_associative_array);
			for($i=0;$i<count($values);$i++){
				$value = filter_var($values[$i], FILTER_SANITIZE_STRING);
				$value = mysqli_real_escape_string($connection, $value);
				$values[$i] = "'$value'";
			}
			$values =  implode(", ", $values);

			$sql = "INSERT INTO ".$table_name."(".$fields.") VALUES (".$values.")";

			if(!mysqli_query($connection,$sql)){
				$this->errors = "Error inserting datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$last_id = mysqli_insert_id($connection);
			$this->errors="";
			$this->close($connection);
			return $last_id;
		}

		public function select($table_name,$fields_array=null,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
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
			if(!$result){
				$this->errors ="Query Error".mysqli_connect_error($connection);
				return null;
			}

			$datas = mysqli_fetch_all($result,MYSQLI_ASSOC);

			mysqli_free_result($result);
			
			$this->close($connection);
			
			return $datas;
		}

		public function update($table_name,$datas_associative_array,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
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
				$this->errors = "Error updating datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$this->errors="";
			$this->close($connection);
			return true;
		}

		public function delete($table_name,$conditions="true"){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
				return false;
			}

			$sql = " DELETE FROM ".$table_name." WHERE ".$conditions;

			if(!mysqli_query($connection,$sql)){
				$this->errors = "Error Deleting datas: " . mysqli_error($connection);
				$this->close($connection);
				return false;
			}
			$this->errors="";
			$this->close($connection);
			return true;
		}

		public function getConnection(){
			$connection = $this->connect();
			if(!$connection){
				$this->errors ="Connection Error".mysqli_connect_error();
				return null;
			}
			return $connection;
		}

		public function getErrors(){
			return $this->errors;
		}
	}
