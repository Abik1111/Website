<?php
	class ImageHandler{
		private $absPath;//Absolute path of folder
		private $relPath;//Relative path of folder
		
		//Sets up folder where images are to be stored
		public function __construct($imagePath){
			//Create folder if doesn't exist already
			if(!file_exists($imagePath)){
				mkdir($imagePath);	
			}
			
			$this->relPath =$imagePath.'/';
			$this->absPath = '';
			//Current absolute location of page
			$currentName = $_SERVER['SCRIPT_FILENAME'];//Current file name
			$directories = explode('/', $currentName);//Splitting the each directory name
			for($i=0; $i<(sizeof($directories)-1); $i++){
				$this->absPath .= $directories[$i].'/';//Regenerating the directory location
			}
			$this->absPath .= $this->relPath;//Specifying the location to the created directory
		}
		
		//Saves the image inside imageFolder inside imagePath
		public function saveImage($imageFolder, $nameInForm){
			$folder_name = strVal($imageFolder);
			
			//Making new directory inside images folder if doesn't exist
			if(!file_exists($this->relPath.$folder_name)){
				mkdir($this->relPath.$folder_name);	
			}
			//Getting the name of image
			$image_name = $_FILES[$nameInForm]['name'];
			$image_src = $folder_name.'/'.$image_name;
			
			//Adding copy- prefix if file already exists
			if(file_exists($this->relPath.$image_src)){
				$image_src = $folder_name.'/'.'copy-'.$image_name;
			}
			
			//Transferring the image from temp. location to required location
			move_uploaded_file($_FILES[$nameInForm]['tmp_name'], $this->absPath.$image_src);
		}
		
		//Saves the images inside imageFolder inside imagePath
		public function saveImages($imageFolder, $nameInForm){
			$folder_name = strVal($imageFolder);
			
			//Making new directory inside images folder if doesn't exist
			if(!file_exists($this->relPath.$folder_name)){
				mkdir($this->relPath.$folder_name);	
			}
			
			for($i=0; $i<sizeof($_FILES[$nameInForm]['name']); $i++){
				//Getting the name of image
				$image_name = $_FILES[$nameInForm]['name'][$i];
				$image_src = $folder_name.'/'.$image_name;
				
				//Adding copy- prefix if file already exists
				if(file_exists($this->relPath.$image_src)){
					$image_src = $folder_name.'/'.'copy-'.$image_name;
				}
				
				//Transferring the image from temp. location to required location
				move_uploaded_file($_FILES[$nameInForm]['tmp_name'][$i], $this->absPath.$image_src);
			}
		}
		
		//Return the names of images in the folder passed in alphabetical ascending order
		public function getImagesNames($imageFolder){
			$folder_name = strVal($imageFolder);
			if(file_exists($this->relPath.$folder_name)){
				$result = array();
				foreach(scandir($this->relPath.$folder_name) as $data){
					if($data=='.' || $data=='..')//Dummy data exists
						continue;
					$result[] = $data;
				}
				return $result;
			}
			else{
				$dummy =array();
				return $dummy;
			}
		}
		
		//Returns src location of image in image folder with image name
		public function getSrc($imageFolder, $imageName){
			$folder_name = strVal($imageFolder);
			$fileSrc = $this->relPath.$folder_name.'/'.$imageName;
			if(file_exists($fileSrc)){
				return $fileSrc;
			}
			else{
				//Return src of default image
				return '';
			}
		}
		
		//Deletes the images of name in specific folder
		public function deleteImage($imageFolder, $imageName){
			$folder_name = strVal($imageFolder);
			//Delete the file if exists
			if(file_exists($this->relPath.$folder_name.'/'.$imageName)){
				unlink(($this->relPath.$folder_name.'/'.$imageName));
			}
		}
		
		//Delete the folder
		public function deleteAllImages($imageFolder){
			$folder_name = strVal($imageFolder);
			//Delete the folder if exists
			if(file_exists($this->relPath.$folder_name)){
				$image_names = $this->getImagesNames($folder_name);
				//Deleting all images inside folder
				foreach($image_names as $name){
					$this->deleteImage($folder_name, $name);
				}
				//Deleting the folder
				rmdir(($this->relPath.$folder_name));
			}
		}
	}
?>