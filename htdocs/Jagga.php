<?php
	require 'lib/server_database.php';
	require 'lib/Image_Handler.php';
	
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
		private $handler;//Image handler of jagga
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,'jagga');
			$this->handler = new ImageHandler('Images');
		}
		
		//Loads the data into the jagga object
		public function loadFromDatabase($id){
			$data = $this->dataBase->select('jagga_table', null, "id = $id");
			if($data==null){
				return false;
			}
			//id, address, area, price, description, date, availability;
			$this->id = $id;
			$this->location = $data[0]['address'];
			$this->area = $data[0]['area'];
			$this->price = $data[0]['price'];
			$this->description = $data[0]['description'];
			$this->postedTime = $data[0]['date'];
			$this->available = $data[0]['availability'];
			$this->ownerContact = $data[0]['owner_contact'];
			
			$handler = new ImageHandler('Images');
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
		
		public function echoPrice(){
			echo htmlspecialchars(strVal($this->price));
		}
		
		public function echoDescription(){
			echo htmlspecialchars(strVal($this->description));
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
			return sizeof($this->images);
		}
		
		public function echoImageSrc($index){
			echo $this->images[$index];
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
		private $handler;//Image handler of jagga
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,'jagga');
			$this->handler = new ImageHandler('Images');
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
		
		//Save the class data into the database
		public function saveToDatabase(){
			$data = array();
			$data['address'] = $this->location;
			$data['area'] = $this->area;
			$data['price'] = $this->price;
			$data['description'] = $this->description;
			$data['availability'] = 1;
			$data['owner_contact'] = $this->ownerContact;
			$id = $this->dataBase->insert('jagga_table', $data);
			if($id == false){
				return false;
			}
			$this->handler->saveImages($id, $this->images);
			echo 'successful id = '.$id;
			return true;
		}
		
		//Save into database without saving in class
		public function saveData($arg_location, $arg_area, $arg_price, $arg_description, $arg_owner_contact, $arg_images){
			$data = array();
			$data['address'] = strVal($_POST[$arg_location]);
			$data['area'] = $_POST[$arg_area];
			$data['price'] = $_POST[$arg_price];
			$data['description'] = strVal($_POST[$arg_description]);
			$data['availability'] = 1;
			$data['owner_contact'] = strVal($_POST[$arg_owner_contact]);
			$id = $this->dataBase->insert('jagga_table', $data);
			if($id == false){
				//Error handling
				return false;
			}
			$this->handler->saveImages($id, $arg_images);
			return $id;
		}
		
		
	}

	//Class just to delete Jagga
	Class JaggaDelete{
		private $dataBase;
		private $handler;
		
		//Connects to database and image handler class
		public function __construct($host,$username,$password){
			$this->dataBase = new Database($host,$username,$password,'jagga');
			$this->handler = new ImageHandler('Images');
		}
		
		public function delete($id){
			$condition = "id = $id";
			$result = $this->dataBase->delete('jagga_table', $condition);
			if($result){
				$this->handler->deleteAllImages($id);
			}
			return $result;
		}
		
	}

	//Blueprint of object where datas to be searched
	Class JaggaSearch{
		//takes in search keywords and returns 
	}

?>