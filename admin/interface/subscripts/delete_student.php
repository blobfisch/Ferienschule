<?php
		
	require_once("../../php/sql_functions.php");
	function send_mail($firstname, $lastname, $email){
	$subject = "Ihre Anmeldung zur Ferienschule wurde gelöscht!";
	$mail_text="Hallo $firstname $lastname, \n\nIhre Anmeldung und Kurswahl für die Ferienschule wurde soeben gelöscht.\nDanke dafür, dass sie uns rechtzeitig informiert haben. \nSie könnten sich ab sofort erneut anmelden.";
	require("../../php/send_mail.php");
};
	
	//function in php/sql_functions.php
	$conn = build_connection();


/* delete student from database */
  if(isset($_POST['student'])){
  	$id_student = $_POST['student'];
  	unset($_POST);
  	$email_details = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id_student = '".$id_student."';")) or trigger_error("Query Failed! Error: ".mysqli_error('ferienschule'), E_USER_ERROR);
 

	  $sql = "DELETE FROM students WHERE id_student = '".$id_student."';";

		if (mysqli_query($conn, $sql)) {
		    echo "<div class='alert alert-success'>Schüler gelöscht</div>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    die();
		}
		send_mail($email_details['firstname'],$email_details['lastname'], $email_details['email']);


  }

/* build dropdown */
	$students = mysqli_query($conn, "SELECT id_student, lastname, firstname FROM students ORDER BY lastname;");
	echo "<form method='post' action='".$_SERVER['PHP_SELF']."' target='_self'>";
	echo "<div class='form-group form-inline'><select name='student' class='form-control' >";
	echo "<option selected disabled hidden value=''></option>";
	while($student = mysqli_fetch_assoc($students)) {

		echo "<option value='".$student["id_student"]."'>".$student["lastname"].", ".$student["firstname"]."</option>";
	}
	echo "</select>";
	echo "<button type='submit' class='btn btn-danger'>Löschen</button>";
	echo "</div></form>";


	

	//close sql connection
	close_connection($conn);

?>
