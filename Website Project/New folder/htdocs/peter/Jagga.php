<?php
	require 'lib/server_database.php';
	require 'lib/Image_Handler.php';
	
	//Defining the image folder for images
	define('IMAGE_LOCATION', 'Images/Property_Images');
	define('DEFAULT_HOUSE_IMAGE', 'img/DefaultHouse.png');
	define('DEFAULT_LAND_IMAGE', 'img/DefaultLand.jpg');
	
	define('JAGGA_RETURN', 'Land');
	define('HOME_RETURN', 'House');
	
	//Defining the database and table name
	define('DATABASE', 'property');
	define('TABLE', 'property_table');
	define('REQUEST_TABLE', 'REquested_property_table');
	
	//Defining the column of database
	define('ID', 'id');
	define('LOCATION', 'address');
	define('AREA', 'area');
	define('DATE_POSTED', 'date');
	define('PRICE', 'price');
	define('DESCRIPTION', 'description');
	define('AVAILABILITY', 'availability');
	define('OWNER_CONTACT', 'owner_contact');
	define('IS_JAGGA', 'is_jagga');
	define('USER_ID', 'user_id');
	//------------------------------------
	define('SRC', 'src');
	
	
	//Blueprint of object where datas to be retrieved
	Class JaggaRetrieve{
		private $id;//id of jagga
		private $location;//Location of ghar jagga
		private $area;//Area in m2
		private $price;//Price of ghar, jagga
		private $images;//Images sources
		private $description;//Description of ghar jagga
		private $available;//If the property is availabe or not
		private $postedTime;//Posted time in the website
		private $dataBase;//Database manager of jagga
		private $ownerContact;//Contact address of owner
		private $is_jagga;
		private $user_id;
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,DATABASE);
		}
		
		//Loads the data into the jagga object
		public function loadFromDatabase($id){
			$data = $this->dataBase->select(TABLE, null, "id = $id");
			if($data==null){
				return false;
			}
			//id, address, area, price, description, date, availability;
			$this->id = $id;
			$this->location = $data[0][LOCATION];
			$this->area = $data[0][AREA];
			$this->price = $data[0][PRICE];
			$this->description = $data[0][DESCRIPTION];
			$this->postedTime = $data[0][DATE_POSTED];
			$this->available = $data[0][AVAILABILITY];
			$this->ownerContact = $data[0][OWNER_CONTACT];
			$this->is_jagga = $data[0][IS_JAGGA];
			$this->user_id = $data[0][USER_ID];
			
			$handler = new ImageHandler(IMAGE_LOCATION);
			$image_names = $handler->getImagesNames($id);
			$images = array();
			foreach($image_names as $name){
				$this->images[] = $handler->getSrc($id, $name);
			}
			return true;
		}
		
		//Getter of jagga
		public function echoId(){
			echo htmlspecialchars(strVal($this->id));
		}
		
		public function echoLocation(){
			echo htmlspecialchars(strVal($this->location));
		}
		
		public function echoArea(){
			echo htmlspecialchars(strVal($this->area));
		}
		
		public function echoPrice($moneyFormat=false){
			if($moneyFormat == false){
				echo htmlspecialchars(strVal($this->price));
			}
			else{
				echo htmlspecialchars(strVal($this->price));
			}
		}
		
		public function echoDescription(){
			echo htmlspecialchars(strVal($this->description));
		}
		
		public function echoType(){
			if($this->is_jagga){
				return JAGGA_RETURN;
			}
			else{
				return HOME_RETURN;
			}
		}
		
		public function getType(){
			return $this->is_jagga;
		}
		
		public function echoPostedTime(){
			echo htmlspecialchars(strVal($this->postedTime));
		}
		
		public function echoAvailability(){
			echo htmlspecialchars(strVal($this->available));
		}
		
		public function echoOwnerContact(){
			echo htmlspecialchars(strVal($this->ownerContact));
		}
		
		public function getNumberOfImages(){
			if(is_array($this->images)){
				return sizeof($this->images);
			}
			else{
				return 0;
			}
		}
		
		public function echoImageSrc($index){
			echo $this->images[$index];
		}
		
		public function getUserId(){
			return $this->user_id;
		}
		
		public function echoUserId(){
			echo $this->user_id;
		}
	}

	//Blueprint of object where datas to be retrieved
	Class JaggaRequestedRetrieve{
		private $id;//id of jagga
		private $location;//Location of ghar jagga
		private $area;//Area in m2
		private $price;//Price of ghar, jagga
		private $images;//Images sources
		private $description;//Description of ghar jagga
		private $available;//If the property is availabe or not
		private $postedTime;//Posted time in the website
		private $dataBase;//Database manager of jagga
		private $ownerContact;//Contact address of owner
		private $is_jagga;
		private $user_id;
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,DATABASE);
		}
		
		//Loads the data into the jagga object
		public function loadFromDatabase($id){
			$data = $this->dataBase->select(REQUEST_TABLE, null, "id = $id");
			if($data==null){
				return false;
			}
			//id, address, area, price, description, date, availability;
			$this->id = $id;
			$this->location = $data[0][LOCATION];
			$this->area = $data[0][AREA];
			$this->price = $data[0][PRICE];
			$this->description = $data[0][DESCRIPTION];
			$this->postedTime = $data[0][DATE_POSTED];
			$this->available = $data[0][AVAILABILITY];
			$this->ownerContact = $data[0][OWNER_CONTACT];
			$this->is_jagga = $data[0][IS_JAGGA];
			$this->user_id = $data[0][USER_ID];
			
			$handler = new ImageHandler(IMAGE_LOCATION);
			$image_names = $handler->getImagesNames($id);
			$images = array();
			foreach($image_names as $name){
				$this->images[] = $handler->getSrc($id, $name);
			}
			return true;
		}
		
		//Getter of jagga
		public function echoId(){
			echo htmlspecialchars(strVal($this->id));
		}
		
		public function echoLocation(){
			echo htmlspecialchars(strVal($this->location));
		}
		
		public function echoArea(){
			echo htmlspecialchars(strVal($this->area));
		}
		
		public function echoPrice($moneyFormat=false){
			if($moneyFormat == false){
				echo htmlspecialchars(strVal($this->price));
			}
			else{
				echo htmlspecialchars(strVal($this->price));
			}
		}
		
		public function echoDescription(){
			echo htmlspecialchars(strVal($this->description));
		}
		
		public function echoType(){
			if($this->is_jagga){
				return JAGGA_RETURN;
			}
			else{
				return HOME_RETURN;
			}
		}
		
		public function getType(){
			return $this->is_jagga;
		}
		
		public function echoPostedTime(){
			echo htmlspecialchars(strVal($this->postedTime));
		}
		
		public function echoAvailability(){
			echo htmlspecialchars(strVal($this->available));
		}
		
		public function echoOwnerContact(){
			echo htmlspecialchars(strVal($this->ownerContact));
		}
		
		public function getNumberOfImages(){
			if(is_array($this->images)){
				return sizeof($this->images);
			}
			else{
				return 0;
			}
		}
		
		public function echoImageSrc($index){
			echo $this->images[$index];
		}
		
		public function getUserId(){
			return $this->user_id;
		}
		
		public function echoUserId(){
			echo $this->user_id;
		}
	}

	//Blueprint of object where datas to be saved
	Class JaggaSave{
		private $id;//id of jagga
		private $location;//Location of ghar jagga
		private $area;//Area in m2
		private $price;//Price of ghar, jagga
		private $images;//Variable name of image getter in post
		private $description;//Description of ghar jagga
		private $available;//If the property is availabe or not
		private $postedTime;//Posted time in the website
		private $dataBase;//Database manager of jagga
		private $ownerContact;//Contact address of owner
		private $isJagga;//Property type
		private $user_id;//Selling user
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,DATABASE);
		}
		
		//Setter for jagga datas
		public function addLocation($postName){
			$this->location = strVal($_POST[$postName]);
		}
		
		public function addArea($postName){
			$this->area = strVal($_POST[$postName]);
		}
		
		public function addPrice($postName){
			$this->price = $_POST[$postName];
		}
		
		public function addDescription($postName){
			$this->description = strVal($_POST[$postName]);
		}
		
		public function addOwnerContact($postName){
			$this->ownerContact = strVal($_POST[$postName]);
		}
		
		public function addImages($postName){
			$this->images = $postName;
		}
		
		public function addType($type){
			$this->isJagga = $type;
		}
		
		public function addUserId($id){
			$this->user_id = $id;
		}
		
		//Save the class data into the database
		public function saveToDatabase(){
			$data = array();
			$data[LOCATION] = $this->location;
			$data[AREA] = $this->area;
			$data[PRICE] = $this->price;
			$data[DESCRIPTION] = $this->description;
			$data[AVAILABILITY] = 1;
			$data[OWNER_CONTACT] = $this->ownerContact;
			$id = $this->dataBase->insert('jagga_table', $data);
			if($id == false){
				return false;
			}
			$handler = new ImageHandler(IMAGE_LOCATION);
			$handler->saveImages($id, $this->images);
			echo 'successful id = '.$id;
			return true;
		}
		
		//Save into database without saving in class
		public function saveData($arg_location, $arg_area, $arg_price, $arg_description, $arg_owner_contact, $arg_images, $arg_jagga, $user_id){
			$data = array();
			$data[LOCATION] = strVal($_POST[$arg_location]);
			$data[AREA] = $_POST[$arg_area];
			$data[PRICE] = $_POST[$arg_price];
			$data[DESCRIPTION] = strVal($_POST[$arg_description]);
			$data[AVAILABILITY] = 1;
			$data[OWNER_CONTACT] = strVal($_POST[$arg_owner_contact]);
			$data[IS_JAGGA] = ($_POST[$arg_jagga]==1)?1:0;
			$data[USER_ID] = $_POST[$user_id];
			$id = $this->dataBase->insert(TABLE, $data);
			if($id == false){
				//Error handling
				return false;
			}
			$handler = new ImageHandler(IMAGE_LOCATION);
			$handler->saveImages($id, $arg_images);
			return $id;
		}
		
		//Save into database without saving in class
		public function updateData($id, $arg_location, $arg_area, $arg_price, $arg_description, $arg_owner_contact, $arg_images, $is_jagga, $delete_prev){
			$data = array();
			$data[LOCATION] = strVal($_POST[$arg_location]);
			$data[AREA] = $_POST[$arg_area];
			$data[PRICE] = $_POST[$arg_price];
			$data[DESCRIPTION] = strVal($_POST[$arg_description]);
			$data[AVAILABILITY] = 1;
			$data[OWNER_CONTACT] = strVal($_POST[$arg_owner_contact]);
			$data[IS_JAGGA] = ($_POST[$is_jagga]==1)?1:0;
			$this->dataBase->update(TABLE, $data, ID."=$id");
			$handler = new ImageHandler(IMAGE_LOCATION);
			$_POST[$delete_prev] = ($_POST[$delete_prev]==1)?1:0;
			if($_POST[$delete_prev] == 1){
				$handler->deleteAllImages($id);
			}
			$handler->saveImages($id, $arg_images);
			return $id;
		}
		
	}

	//Class just to delete Jagga
	Class JaggaDelete{
		private $dataBase;
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,DATABASE);
		}
		
		public function delete($id){
			$condition = ID." = $id";
			$result = $this->dataBase->delete(TABLE, $condition);
			if($result){
				$handler = new ImageHandler(IMAGE_LOCATION);
				$handler->deleteAllImages($id);
			}
			return $result;
		}
		
	}

	//Class containig only viewing part of jagga
	Class JaggaBlock{
		private $location;
		private $area;
		private $price;
		private $coverSrc;
		private $id;
		private $isJagga;
		
		public static function echoMoneyFormat($value){
			$number = floor($value);
			$fraction = $value-$number;
			$valueString = strVal($number);
			$digitsNum = strlen($valueString);
			$result = '';
			for($i=0; $i<strlen($valueString); $i++){
				$pos = strlen($valueString)-1-$i;
				if($i>=3 && ($i-3)%2==0){
					$result .=',';
				}
				$result .= $valueString[$pos];
			}
			echo strrev($result);
		}
		
		//Takes in associative array of data and stores in the block
		public function __construct($data, $index){
			$this->id = $data[$index][ID];
			$this->area = $data[$index][AREA];
			$this->price = $data[$index][PRICE];
			$this->location = $data[$index][LOCATION];
			$this->isJagga = $data[$index][IS_JAGGA];
			
			$handler = new ImageHandler(IMAGE_LOCATION);
			$imageNames = $handler->getImagesNames($data[$index][ID]);
			if(is_array($imageNames) && sizeof($imageNames)){
				$this->coverSrc = $handler->getSrc($data[$index][ID], $imageNames[0]);
			}
			else{
				if($this->isJagga == 1){
					$this->coverSrc = DEFAULT_LAND_IMAGE;
				}
				else{
					$this->coverSrc = DEFAULT_HOUSE_IMAGE;					
				}
			}
		}
		
		public function getLocation(){
			return $this->location;
		}
		
		public function getArea(){
			return $this->area;
		}
		
		public function getPrice(){
			return $this->price;
		}
		
		public function getCoverSrc(){
			return $this->coverSrc;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function getType(){
			return $this->isJagga;
		}		
		
		public function echoLocation(){
			echo $this->location;
		}
		
		public function echoArea(){
			echo $this->area;
		}
		
		public function echoPrice(){
			echo $this->price;
		}
		
		public function echoCoverSrc(){
			echo $this->coverSrc;
		}
		
		public function echoId(){
			echo $this->id;
		}
		
		public function echoType(){
			if($this->isJagga == 1){
				echo JAGGA_RETURN;
			}
			else{
				echo HOME_RETURN;
			}
		}
	}
	
	//Class manipulating the blocks of jagga
	Class JaggaSelect{
		private $dataBase;
	
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,DATABASE);
		}
		
		//Simply returns all the jagga details
		public function getAllJagga($numberOfJagga='', $indexOfPage=''){
			$order = DATE_POSTED.' DESC';
			$fields = array(ID,AREA,PRICE,LOCATION,IS_JAGGA);
			if(is_numeric($numberOfJagga) && is_numeric($indexOfPage)){
				$offset = $numberOfJagga*($indexOfPage-1);
				$data = $this->dataBase->select(TABLE, $fields, null, $order, $numberOfJagga, $offset);
			}
			else{
				$data = $this->dataBase->select(TABLE, $fields, null, $order);
				echo $this->dataBase->getErrors();
			}
			if(is_array($data)){
				$jaggas = array();
				for($i=0; $i<sizeof($data); $i++){ 
					$jaggas[] = new JaggaBlock($data, $i);
				}
				return $jaggas;
			}
			else{
				return false;
			}
		}
		
		//Returns the no. of page the result will have
		public function getAllPagesNo($numberOfJagga){
			$fields = array(ID);
			$data = $this->dataBase->select(TABLE, $fields);
			$number = sizeof($data);
			$number /= $numberOfJagga;
			$number = ceil($number);
			return $number;
		}
		
		//Search the jaggas depending upon keyword
		public function getSearchedJagga($keyword, $numberOfJagga, $indexOfPage){
			$keyword_upper_caps = strtoupper($keyword);
			$keyword_lower_caps = strtolower($keyword);
			$keyword_first_cap = ucfirst($keyword);
			$conditions = ID." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_upper_caps}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_lower_caps}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_first_cap}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_upper_caps}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_lower_caps}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_first_cap}%'";
			$order= DATE_POSTED.' DESC';
			
			$fields = array(ID,AREA,PRICE,LOCATION,IS_JAGGA);
			if(is_numeric($numberOfJagga) && is_numeric($indexOfPage)){
				$offset = $numberOfJagga*($indexOfPage-1);
				$data = $this->dataBase->select(TABLE, $fields, $conditions, $order, $numberOfJagga, $offset);
			}
			else{
				$data = $this->dataBase->select(TABLE, $fields, $conditions, $order);
			}
			if(is_array($data)){
				$jaggas = array();
				for($i=0; $i<sizeof($data); $i++){ 
					$jaggas[] = new JaggaBlock($data, $i);
				}
				return $jaggas;
			}
			else{
				return false;
			}
		}
		
		public function getResultsNo($keyword){
			$keyword_upper_caps = strtoupper($keyword);
			$keyword_lower_caps = strtolower($keyword);
			$keyword_first_cap = ucfirst($keyword);
			$conditions = ID." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_upper_caps}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_lower_caps}%'";
			$conditions .= 'OR '.LOCATION." LIKE '%{$keyword_first_cap}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_upper_caps}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_lower_caps}%'";
			$conditions .= 'OR '.DESCRIPTION." LIKE '%{$keyword_first_cap}%'";
			$fields = array(ID);
			$data = $this->dataBase->select(TABLE, $fields, $conditions);
			return sizeof($data);
		}
		
		//Returns the no. of page the result will have
		public function getSearchPagesNo($keyword, $numberOfJagga){
			$number = $this->getResultsNo($keyword);
			$number /= $numberOfJagga;
			$number = ceil($number);
			return $number;
		}
		
		//Takes in array of jagga block and creates json file
		public static function parseToJson($data, $fileName, $varName){
			$string = '{'."\n";
			$string .= '"'.$varName.'":[';
			if(is_array($data)){			
				for($i=0; $i<sizeof($data); $i++){
					if($i!=0){
						$string .= ', ';
					}
					$string .= '{'."\n";
					$string .= '"'.ID.'": '.strVal($data[$i]->getId()).','."\n";
					$string .= '"'.LOCATION.'": "'.strVal($data[$i]->getLocation()).'",'."\n";
					$string .= '"'.AREA.'": '.strVal($data[$i]->getArea()).','."\n";
					$string .= '"'.PRICE.'": '.strVal($data[$i]->getPrice()).','."\n";
					$string .= '"'.SRC.'": "'.strVal($data[$i]->getCoverSrc()).'"'."\n";
					$string .= '}';
				}
			}
			$string .= ']'."\n";
			$string .= '}';
			$file = fopen($fileName, 'w+');
			fwrite($file, $string);
			fclose($file);
		}
	
		public static function deleteJson($fileName){
			if(!file_exists($fileName)){
				return true;
			}
			return unlink($fileName);
		}
	}

?>