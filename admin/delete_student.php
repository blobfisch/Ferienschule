<?php
		
	require_once("../php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

/* delete student from database */
  if(isset($_POST['student'])){
  	$id_student = $_POST['student'];
  	unset($_POST);
	  $sql = "DELETE FROM students WHERE id_student = '".$id_student."';";

		if (mysqli_query($conn, $sql)) {
		    echo "<div class='alert alert-success'>Schüler gelöscht</div>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

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
