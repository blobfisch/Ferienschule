<?php
	//creates the tables to be displayed in the form
	
	require_once("php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

	//Generate html tables with data from topics
	$days = array("Mo","Di","Mi","Do","Fr");
	$grades = array("6","7","8","9","10");
	$slots = array(1,2,3);


	//create one table for every year
	foreach($grades as $grade){
		echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button><br/>";
		echo "<div  id='grade".$grade."' class='collapse'><table class='table table-condensed table-responsive' class='table-responsive'>"; 
		$i=0;

		//print table headline with all the subjects
		echo "<tr class='bg-info text-info'><td>Tag</td>";
		foreach($days as $day){
			echo "<td>".$day."</td>";
		}
		unset($day);

		//rows
		foreach($slots as $slot){
			echo "<tr>";
			echo "<td>".$slot."</td>";
			foreach($days as $day){
				//echo "<td><tr>hallo</tr><tr>hallo</tr></td>";
			}

			echo"</tr>";
		}


		echo "</table></div>";

	}
	//close sql connection
	close_connection($conn);

?>
