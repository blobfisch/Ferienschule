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
require 'validate_form_data.php';

if($data_ok){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ferienschule";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Create and check connection
	if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	// Change character set to utf8 (fixed encoding errors)
	mysqli_set_charset($conn, "utf8");

	/* insert user data into students */
	//prevent sql injections
	$sql = $conn->prepare("INSERT INTO Students (firstname, lastname, email, grade, class)
	VALUES (?,?,?,?,?)");
	$sql->bind_param("sssss", $firstname, $lastname, $email, $grade, $class);
	/*$sql->bindParam(':last', $lastname);
	$sql->bindParam(':email', $email);
	$sql->bindParam(':grade', $grade);
	$sql->bindParam(':class', $class);*/
	$sql->execute();
	$sql->close();

	//insert selected topics into students_topics
	$sql = $conn->prepare("INSERT INTO students_topics (id_student, id_topic)
	VALUES (:student, :topic");

	$id = mysqli_insert_id($conn);
	foreach($_POST["topics"] as $topic){
		$sql->bindParam(':student', $id);
		$sql->bindParam(':last', $topic);
		$sql->execute();
	}
	$sql->close();
	/*if (mysqli_multi_query($conn, $sql)) {
	    echo "<div class='alert alert-success'>Anmeldung erfolgreich!</div>";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}*/

	mysqli_close($conn);
}
else{
	echo "<div class='alert alert-danger'>Anmeldung fehlgeschlagen!</div>";
}
?> 