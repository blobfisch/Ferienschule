<?php
	//creates the tables to be displayed in the form
	
	require_once("php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

	

	//Generate html tables with data from topics
	$days = array("Mo","Di","Mi","Do","Fr");
	$grades = array("6","7","8","9","10");
	$slots = array(1,2,3);
	$times = array("9:00-10:30","10:45-12:15", "12:30-14:00");
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

	function free_spots($conn, $id_topic, $max_amount_of_groups){
		$count_already_entered = mysqli_query($conn,"SELECT COUNT(*) AS free_spots 
			FROM students 
			JOIN students_topics 
			ON students.id_student=students_topics.id_student 
			WHERE id_topic = $id_topic;");
		$already_entered = mysqli_fetch_assoc($count_already_entered);
		return $free_spots = 5*$max_amount_of_groups - $already_entered["free_spots"];
	}

	//create one table for every year
	foreach($grades as $grade){
		echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button><br/>";
		echo "<div  id='grade".$grade."' class='collapse'><table class='table table-condensed table-responsive table-striped'>"; 
		$i=0;

		//print table headline with all the subjects
		echo "<tr class='bg-info text-info'><td>Zeit</td>";
		foreach($days as $day){
			echo "<td>".$day."</td>";
		}
		unset($day);

		//rows
		foreach($slots as $slot){
			echo "<tr>";
			$time=$times[$slot-1];
			echo "<td class='text-info'>".$time."</td>";
			foreach($days as $day){
				echo "<td><ul style='padding: 0;' class='topics'>";
				$topics = mysqli_query($conn, "SELECT subject, title, id_topic, max_amount_of_groups 
					FROM topics
					JOIN slots
					ON topics.id_slot=slots.id_slot
					WHERE grade = '$grade' AND day = '$day' AND slot = '$slot';"
				); 
				
				while($topic = mysqli_fetch_assoc($topics)) {	
					$free_spots = free_spots($conn, $topic["id_topic"], $topic["max_amount_of_groups"]);

					echo "<li><label><input type='checkbox' name='topics[]'"   ;
					if ($free_spots>0){
						echo "value='".$topic['id_topic']."' class='group_$slot$day$grade' data-group='$slot$day$grade' onclick='disableOthers(this);'";
					}
					else{
						echo "disabled";
					}
					echo ">".$topic["subject"] ."  <small>".$topic["title"]." </small>";
						if($topic['max_amount_of_groups']*5 -$free_spots<3){
							echo "<small class='text-success'>[Noch $free_spots von ".($topic['max_amount_of_groups']*5)." Plätzen frei -</small><small class='text-warning'> zu wenige!]</small>";
						}
						else if($free_spots>1){
							echo "<small class='text-success'>[Noch $free_spots von ".($topic['max_amount_of_groups']*5)." Plätzen frei]</small>";
						}
						else if($free_spots==1){
							echo "<small class='text-warning'>[Noch ein freier Platz]</small>";
						}
						else{
							echo "<small class='text-danger'> [Keine freien Plätze mehr]</small>";

						}

					echo "</label></li>";

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
