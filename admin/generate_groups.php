<?php
	//TODO check wether table is empty

	//distributes the amount of students for one topic in equal groups, that are as small as possible
	function distribute_students($number_of_students){
		$minimum_for_new_group = 3; //a new group will be formed for 3 people
		//calculate the number of groups required
		
		//check if only one group is required
		if($number_of_students < 2*$minimum_for_new_group){
			return array($number_of_students);
		}

		//!This part of the algorithm will only produce correct results for more than one group!
		//find out the number of groups required
		$number_of_groups = floor($number_of_students/$minimum_for_new_group); //floor cuts of the digits after decimal point without rounding

		//Instanziate array $groups with one element for every group and the minimum number already in the group
		$groups = array_fill(0, $number_of_groups, $minimum_for_new_group);

		//subtract the students that were already put into a group
		$number_of_students-= $minimum_for_new_group*$number_of_groups;

		//distribute the rest equally
		for($j=0; $j<$number_of_groups; $j++){
			if($number_of_students>0){
				$groups[$j]++;
				$number_of_students--;
			}
		}

		return $groups;
	}


	function add_group_to_DB($id_topic,$conn){
		if(mysqli_query($conn, "INSERT INTO groups (id_topic) VALUES ('".$id_topic."');")) {
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

	// Change character set to utf8 (fixed encoding errors)
	mysqli_set_charset($conn,"utf8");

	$topics = mysqli_query($conn,"SELECT topics.id_topic FROM topics;");
	while($topic = mysqli_fetch_assoc($topics)) {

		
		$number_of_students = fetch_number_of_students($topic, $conn);


		if($number_of_students>0){
			/*joins id_topic with id_student
			returns id_student of all the students who applied for this topic*/
			$students = mysqli_query($conn, "
				SELECT students.id_student 
				FROM topics
				JOIN students_topics
				ON students_topics.id_topic=topics.id_topic
				JOIN students
				ON students.id_student=students_topics.id_student
				WHERE topics.id_topic = ".$topic['id_topic'].";"
			); 

			$distribution = distribute_students($number_of_students);
			

			//add one new group
			$id = add_group_to_DB($topic['id_topic'],$conn);
			$i = 0;

			//put students in groups
			while($student = mysqli_fetch_assoc($students)) {
				if($distribution[$i]<=0){
					//create more groups if required
					$id = add_group_to_DB($topic['id_topic'],$conn);
					$i++;
				}
				add_relation_students_groups($student['id_student'],$id,$conn);
				$distribution[$i]--;
			}
		}
	}

	mysqli_close($conn);

?>
