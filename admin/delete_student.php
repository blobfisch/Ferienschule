<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ferienschule";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

/* delete student from database */
	if(isset($_POST['submit']))
	{
    $id_student = $_POST['student'];
    echo $id_student;
    $sql = "DELETE FROM students WHERE id_student = ".$id_student.";";

		if (mysqli_query($conn, $sql)) {
		    echo "Schüler gelöscht";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	    
	}


/* build dropdown */
	// Change character set to utf8 (fixed encoding errors)
	mysqli_set_charset($conn,"utf8");

	$students = mysqli_query($conn, "SELECT id_student, lastname, firstname FROM students GROUP BY lastname;");

	echo "<form method='post' action='".$_SERVER['PHP_SELF']."' target='_self'>" ;
	echo "<div class='form-group'><select class='form-control' id='student'>";
	while($student = mysqli_fetch_assoc($students)) {
			//echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button></br>";
		echo "<option value='".$student["id_student"]."'>".$student["lastname"].", ".$student["firstname"]."</option>";
	}
	echo "</select><br/>";
	echo "<button type='submit' class='btn btn-danger'>Löschen</button>";
	echo "</div></form>";
	

	//close sql connection
	mysqli_close($conn);

?>
