<?php
		
	require_once("../../php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

/* delete student from database */
  if(isset($_POST['increase'])){
  	$id_topic = $_POST['increase'];
  	unset($_POST);
	  $sql = "UPDATE topics SET max_amount_of_groups = max_amount_of_groups+1 WHERE id_topic = $id_topic";

		if (mysqli_query($conn, $sql)) {
		    echo "<div class='alert alert-success'>Maximale Anzahl Plätze wurde erhöht!</div>";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

  }
/* build dropdown */
	$topics = mysqli_query($conn, "SELECT id_topic, grade, subject, day FROM topics 
		JOIN slots
		ON topics.id_slot = slots.id_slot
		ORDER BY grade, subject, day_num;");
	echo "<form method='post' action='".$_SERVER['PHP_SELF']."' target='_self'>";
	echo "<div class='form-group form-inline'><select name='increase' class='form-control' >";
	echo "<option selected disabled hidden value=''></option>";
	while($topic = mysqli_fetch_assoc($topics)) {
		echo "<option value='".$topic['id_topic']."'> Klasse ".$topic['grade']." - ".$topic['subject']." - ".$topic['day']." </option>";
	}
	echo "</select>";
	echo "<button type='submit' class='btn btn-danger'>Um 5 Plätze erweitern</button>";
	echo "</div></form>";

	//close sql connection
	close_connection($conn);

?>
