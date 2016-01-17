
<?php
	
	//TODO evaluate $_POST["topics"]
	//TODO check if the name already exists?
	// define variables and set to empty values
	$firstname = $lastname = $email = $grade = $class = "";
	$data_ok = true;

	//removes space, tab and newline and avoids cross-site scripting, sql-injections etc.
	function clear_input($data, $conn) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string ($conn, $data);
		return $data;
	}	

	$firstname = clear_input($_POST["firstname"], $conn);
	$lastname = clear_input($_POST["lastname"], $conn);
	$email = clear_input($_POST["email"], $conn);
	$grade = clear_input($_POST["grade"], $conn);
	$class = clear_input($_POST["class"], $conn);

	//Check if a field was left empty
	if(empty($firstname)){
		$data_ok = false;
		echo "<div class='alert alert-warning'>Bitte gib deinen Vornamen an!</div>";
	}
	if(empty($lastname)){
		$data_ok = false;
		echo "<div class='alert alert-warning'>Bitte gib deinen Nachnamen an!</div>";
	}
	if(empty($email)){
		$data_ok = false;
		echo "<div class='alert alert-warning'>Bitte gib deine Mailadresse an!</div>";
	}
	
	//Makes sure the adress contains @ and .
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$data_ok = false;
  	echo "<div class='alert alert-warning'>Bitte gib eine echte Mailadresse an!</div>";
	}
	//Prevents Form Manipulation
	if(!($grade=="6"||$grade=="7"||$grade=="8"||$grade=="9"||$grade=="10")){
		$data_ok = false;
		echo "<div class='alert alert-warning'>Bitte wähle eine Klasse aus</div>";
	}
	if(!($class=="A"||$class=="B"||$class=="C"||$class=="D"||$class=="E")){
		$data_ok = false;
		echo "<div class='alert alert-warning'>Bitte wähle eine Klasse aus</div>";
	}
?>
