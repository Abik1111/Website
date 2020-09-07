<?php 
	
	class AI{
		private $name;

		public function __construct($name){
			$this->name = $name;
		}

		public function speak(){
			echo "Hi it's me ";
			echo $this->name;
		}
	}

	$jarvis = new AI("jarvis");
	$jarvis->speak();

?>