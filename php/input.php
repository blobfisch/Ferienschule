<?php session_start()?>
<?php
function send_mail($firstname, $lastname, $email, $conn){

	$sql= "SELECT * FROM topics 
					JOIN students_topics ON topics.id_topic = students_topics.id_topic
					JOIN students ON students_topics.id_student = students.id_student
					JOIN slots ON topics.id_slot = slots.id_slot
					WHERE firstname='$firstname' AND lastname = '$lastname';";
	$custom_text = "";
	$topics = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error('ferienschule'), E_USER_ERROR);

	while ($topic = mysqli_fetch_assoc($topics)) {
		  $custom_text = $custom_text."\n".$topic['day']." ".$topic['subject']." Klasse: ".$topic['grade']." ".$topic['title'];
		} 
	$subject = "Sie haben sich erfolgreich zur Ferienschule angemeldet!";

	$mail_text="Hallo $firstname $lastname, \nVielen Dank für Ihre Anmeldung, die wir hiermit wie folgt bestätigen:\n".$custom_text.
  "\n\nBitte informieren Sie uns umgehend unter elternbeirat@eg.schulen.konstanz.de, wenn Sie Ihre Anmeldung stornieren oder ändern müssen. Das Angebot der FERIENSCHULE ELLENRIEDER ist mit Blick auf die Teilnehmerzahl beschränkt. \nHinzu kommt, dass wir zur Finanzierung der Kurse 3 – 5 Schüler pro Kurs benötigen. \nKurse, die aufgrund von Absagen unterbesetzt sind, können nicht stattfinden. \nNur, wenn wir stornierte Plätze rechtzeitig vor Ablauf der Anmeldefrist wieder freischalten, haben andere Mitschüler die Chance, sich noch einbuchen zu können. \n\nVielen Dank für Ihr Verständnis!";
	require("send_mail.php");
};
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
		send_mail($firstname, $lastname, $email, $conn);
		close_connection($conn);
	}
	else{
		echo "<div class='alert alert-danger'>Anmeldung fehlgeschlagen!</div>";
	}
?> 
