<?php session_start()?>
<?php/*function send_mail($firstname,$lastname,$id_topic,$conn){
	$sql = "SELECT * FROM topics WHERE id_topic=$id_topics";

		if (mysqli_query($conn, $sql)) {
		    
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	$mail_text="Hallo $firstname $lastname,
  du hast dich erfolgreich zur Ferienschule angemeldet!";
  
	require("send_mail.php");
}*/;
?>

<!-- Import Bootstrap to make errormessages in iframe look nice -->
<head>
	<title>Ferienschule des Ellenrieder Gymnasiums</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
		
	require_once("sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

	require ('validate_form_data.php');

	
	
	if($data_ok){
		//insert user data into students
		$sql = "INSERT INTO students (firstname, lastname, email, grade, class) VALUES ('$firstname', '$lastname', '$email','$grade','$class');"; //the variables are created and checked in validate_form_data.php

		if (mysqli_query($conn, $sql)) {
		    //echo "Anmeldung erfolgreich!";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		//insert selected topics into students_topics
		$sql = "";
		$id = mysqli_insert_id($conn);
		foreach($_POST["topics"] as $topic){
			$sql .= "INSERT INTO students_topics (id_student, id_topic) VALUES ('$id','$topic');";
		}

		if (mysqli_multi_query($conn, $sql)) {
		    echo "<div class='alert alert-success'>Anmeldung erfolgreich! Die Website kann nun geschlossen werden</div>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		/*send_mail($firstname,$lastname,$id_topic);*/
		close_connection($conn);
	}
	else{
		echo "<div class='alert alert-danger'>Anmeldung fehlgeschlagen!</div>";
	}
?> 
