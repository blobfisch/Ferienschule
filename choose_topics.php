<?php
	//creates the tables to be displayed in the form
	
	require_once("php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

	session_start();

	//Generate html tables with data from topics
	$days = array("Mo","Di","Mi","Do","Fr");
	$grades = array("6","7","8","9","10");
	$slots = array(1,2,3);
	echo'
	<script>
		function disableOthers(el) {
			if($(el).is(":checked")) {
				$(".group_" + $(el).data("group")).removeAttr("checked").prop("checked", false);
				$(el).removeAttr("disabled").prop("checked", true);
			} else {
				$(".group_" + $(el).data("group")).removeAttr("disabled");
			}
		}
	</script>';

	//create one table for every year
	foreach($grades as $grade){
		echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button><br/>";
		echo "<div  id='grade".$grade."' class='collapse'><table class='table table-condensed table-responsive table-striped'>"; 
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
				echo "<td><ul style='padding: 0;'>";
				$topics = mysqli_query($conn, "SELECT subject, title, id_topic  
					FROM topics
					JOIN slots
					ON topics.id_slot=slots.id_slot
					WHERE grade = '$grade' AND day = '$day' AND slot = '$slot';"
				); 
				$j=0;
				while($topic = mysqli_fetch_assoc($topics)) {
					//echo "<li style='display:table-row;'>";
					if($j>0){
						echo "<hr/>";
					}
					$j++;
					echo "<label><input type='checkbox' name='topics[]' class='group_$slot$day$grade' data-group='$slot$day$grade' value='".$topic['id_topic']."' onclick='disableOthers(this);'>".$topic["subject"] ." - ".$topic["title"]."</label>";
					$_SESSION["slots"][$topic['id_topic']] = "$slot$day$grade";
					//echo "</li>";
				}

				echo "</ui></td>";
			}

			echo"</tr>";
		}

		echo "</table></div>";
	}
	//close sql connection
	close_connection($conn);

?>
