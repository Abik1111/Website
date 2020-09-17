<html>
<body>
<?php
	$message = "Congratulation!!";
	$number = 3000+300+30+3;
	
	echo "Hello ".$_POST["username"]."<br/>";
	echo "How is your ".$_POST["occupation"]." life going??<br/>";
	echo "Being bored?? See some more boring stuff ;)<br/>";
	echo "Remember today is ".date("d/m/y")."<br/>";
	echo "I repeat today is ".date("d-M-Y")."<br/>";
	
	//Simple if else statements 
	if($number == 3334){
		echo $message." ".$number." !!!";
	}
	else if($number == 3333){
		echo "Close one";
	}
	else{
		echo "Not even close";
	}
	echo "<br/>";	
	
	//Switch cases
	switch($number){
		case 3333:
			echo "3333";
			break;
		case 3344:
			echo "3334";
			break;
		default:
			echo "No case found";
			break;
	}
	echo "<br/>";

	//Simple while loop
	while($number>=3330){
		echo $number."<br/>";
		$number--;
	}

	//Simple do loop
	do{
		echo $number."<br/>";
		$number++;
	}while($number<=3333);

	//Simple for loop
	for($i=0; $i<10; $i++){
		echo "for loop".($i+1)."<br/>";
	}

	//Array data type :"" can be replaced by ''
	$names = array("Ram", "Hari", "Shyam");
	
	//Adding the element in array
	//Can also be used as $names[3]
	$names[] = "Peter";
	$names[] = "Harry";
	
	//Using for loop to access each element of array
	for($i=0; $i<sizeof($names); $i++){
		echo $names[$i]."<br/>";
	}
	
	//Using for each loop to access each element
	foreach($names as $name){
		echo $name."<br/>";
	}
	
	//Defining funtion
	//Taadaa!! did you ever think you will have function definition here
	function printNothing(){
		echo "nothing to print";
	}
	
	//Function with parameter
	function printNames($parameter){
		foreach($parameter as $each){
			echo $each."<br/>";
		}
	}
		
	//Function with return values
	function concatenate($first, $second){
		$result = $first.$second;
		return $result;
	}
	
	echo "I have ";
	printNothing();
	echo "<br/>Names :<br/>";
	printNames($names);
	echo concatenate("Bye"," World");
	
	//Associative array
	//Not working for some reason
	//$students = array('Topper'=>'Abinash','Smart'=>'Adarsha','Genious'=>'Peter');
	//$students["Topper"] = "Abinash";
	//$students["Smart"] = "Adarsha";
	//$students["Genious"] = "peter";
	//echo students["Topper"]."<br/>";
	//echo students["Smart"]."<br/>";
	//echo students["Genious"]."<br/>";
?>
</html>
</body>