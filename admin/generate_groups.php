<?php
	//TODO check wether table is empty

	//distributes the amount of students for one topic in equal groups, that are as small as possible
	function distribute_students($number_of_students){
		$minimum_in_a_group = 3;
		$maximum_in_a_group = 5; 
		if ($number_of_students>=$minimum_in_a_group){
			//calculate the number of groups required
			$number_of_groups = (int) ceil($number_of_students/$maximum_in_a_group);
			$remainder = $number_of_students%$number_of_groups;
			$fill =($number_of_students-$remainder)/$number_of_groups;

			//Instanziate array $groups with one element for every group 
			$groups = array_fill(0, $number_of_groups, $fill);
			//distribute the rest equally
			for($j=0; $j<$number_of_groups; $j++){
				if($remainder>0){
					$groups[$j]++;
					$remainder--;
				}
			}
			return $groups;
		}
		else{
			return NULL;
		}
	}

	

	
	function add_group_to_DB($id_topic,$id_slot,$conn){
		if(mysqli_query($conn, "INSERT INTO groups (id_topic, id_slot) VALUES ('$id_topic','$id_slot');")) {
	    $id = mysqli_insert_id($conn);
	    echo "New group created successfully.<br/>";
		} else {
		    echo "Error: "  . mysqli_error($conn);
		}
		return $id;
	}

	function add_relation_students_groups($id_student,$id_group,$conn){
		if(mysqli_query($conn, "INSERT INTO students_groups (id_student, id_group) VALUES (".$id_student.",".$id_group.");")) {
		  $id = mysqli_insert_id($conn);
		  echo "New foreign key relation students_groups created successfully.<br/>";
		} else {
		  echo "Error: "  . mysqli_error($conn);
		}
	}

	function fetch_number_of_students($topic,$conn){
			//$students -> num_row was way to slow
			$sql_count_students = mysqli_fetch_assoc(
				mysqli_query($conn, "
					SELECT COUNT(*) as count FROM topics
					JOIN students_topics
					ON students_topics.id_topic=topics.id_topic
					JOIN students
					ON students.id_student=students_topics.id_student
					WHERE topics.id_topic = ".$topic['id_topic'].";"
				)
			);
			return $sql_count_students["count"];
		}

	require_once("../php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();

//TODO: make this work

//	if(mysqli_multi_query($conn,"DELETE FROM groups;
//		ALTER TABLE groups auto_increment = 1;
//		DELETE FROM students_groups;
//	")){
//	 echo "Tables cleared successfully.<br/>";
//	} else {
//	  echo "Error: "  . mysqli_error($conn);
//	}

	$topics = mysqli_query($conn,"SELECT id_topic, id_slot FROM topics;");
	while($topic = mysqli_fetch_assoc($topics)) {

		
		$number_of_students = fetch_number_of_students($topic, $conn);


		if($number_of_students>0){
			//joins id_topic with id_student returns id_student of all the students who applied for this topic
			$students = mysqli_query($conn, "
				SELECT students.id_student
				FROM topics
				JOIN students_topics
				ON students_topics.id_topic=topics.id_topic
				JOIN students
				ON students.id_student=students_topics.id_student
				WHERE topics.id_topic = ".$topic['id_topic']."
				ORDER BY students.grade, students.class;"

			); 
			$distribution = distribute_students($number_of_students);
			if($distribution){

				//add one new group
				$id = add_group_to_DB($topic['id_topic'],$topic['id_slot'],$conn);
				$i = 0;

				//put students in groups
				while($student = mysqli_fetch_assoc($students)) {
					if($distribution[$i]<=0){
						//create more groups if required
						$id = add_group_to_DB($topic['id_topic'],$topic['id_slot'],$conn);
						$i++;
					}
					add_relation_students_groups($student['id_student'],$id,$conn);
					$distribution[$i]--;
				}
			}
			else{
				//Nicht genügend Teilnehmer -> Kurs findet nicht statt!
				//TODO Handeln
			}
		}
	}

	close_connection($conn);

?>
