<?php
function send_mail($id_student, $conn){
	$sql= "SELECT * FROM topics 
					JOIN students_topics ON topics.id_topic = students_topics.id_topic
					JOIN students ON students_topics.id_student = students.id_student
					JOIN slots ON topics.id_slot = slots.id_slot
					WHERE firstname='$firstname' AND lastname = '$lastname';";
	$custom_text = "";
	$groups = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error('ferienschule'), E_USER_ERROR);
	$time = "";
	while ($group = mysqli_fetch_assoc($groups)) {
		  $custom_text = $custom_table."<tr><td>".$groups['day']."</td><td>".$time."</td><td>".$groups['title']."</td></tr>";
		} 
	$subject = "Ihr persönlicher Stundenplan";
	$mail_text="Hallo $firstname $lastname, \nSie haben sich vor einer Weile zur Ferienschule angemeldet.\nWir freuen uns ihnen hiermit endlich den ihren persönlichen Stundenplan mitteilen zu können.\n<table>".$custom_table.
  "</table>\n\n Wir wünschen Ihnen schöne Sommerferien und freuen uns darauf Sie zum Ende der Ferien bei uns begrüßen zu dürfen!";
	require("../../php/send_mail.php");
};
	
	require_once(__DIR__."/../../../php/sql_functions.php");
	//function in php/sql_functions.php
	$conn = build_connection();

	$sql_students = "SELECT * FROM students";
	$students = mysqli_query($conn, $sql_students) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error('ferienschule'), E_USER_ERROR);
	while($student = mysqli_fetch_assoc($students));
	{
		echo ($student['email']);
	}

	close_connection($conn);

?>