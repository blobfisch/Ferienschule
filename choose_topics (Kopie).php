<?php
	//creates the tables to be displayed in the form
	
	require_once("php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

	//Generate html tables with data from topics
	$days = array("Mo","Di","Mi","Do","Fr");
	$grades = array("6","7","8","9","10");


	//create one table for every year
	foreach($grades as $grade){
		echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button><br/>";
		echo "<div  id='grade".$grade."' class='collapse'><table class='table table-condensed table-responsive' class='table-responsive'>"; 
		$i=0;

		//print table headline with all the subjects
		echo "<tr class='bg-info text-info'><td>Tag</td>";
		$subjects = mysqli_query($conn, "SELECT subject FROM topics WHERE grade = ".$grade." group by subject"); //fetches all subjects for this year
		while($subject = mysqli_fetch_assoc($subjects)) {
			echo "<td>".$subject["subject"]."</td>";	
		}
		echo "</tr>";
		//print table row for each day
		foreach($days as $day){
			echo "<tr>";
			echo "<td class='bg-info text-info'>".$day."</td>";
			$subjects = mysqli_query($conn, "SELECT subject FROM topics WHERE grade = ".$grade." group by subject"); //fetches all subjects for this year
		  while($subject = mysqli_fetch_assoc($subjects)) {
		  			$topics = mysqli_query($conn, "SELECT title, id_topic FROM topics WHERE grade = ".$grade." and day = '".$day."' and subject = '".$subject["subject"]."'"); //fetches the title of the lesson
		  			$topic = mysqli_fetch_assoc($topics);
		  			echo "<td><label><input type='checkbox' name='topics[]' value=".$topic["id_topic"].">".$topic["title"]."</label></td>"; //prints one cell with topic
		  }
		  echo "</tr>";
		}
		unset($day);
		echo "</table></div>";

	}
	//close sql connection
	close_connection($conn);

?>
