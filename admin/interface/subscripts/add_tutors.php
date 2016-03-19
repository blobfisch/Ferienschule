<?php

	require_once("../../php/sql_functions.php");
	
	//function in php/sql_functions.php
	$conn = build_connection();



	if(isset($_POST['tutor_select'])){
		$data = unserialize($_POST['tutor_select']);
		$sql="UPDATE groups set id_tutor=".$data['id_tutor']." WHERE id_group = ".$data['id_group'].";";
		if (mysqli_query($conn, $sql)) {
	    echo "<div class='alert alert-success'>Tutor wurde zugeordnet</div>";
		} else {
		    echo "<div class='alert alert-warning'> Error: " . $sql . "<br>" . mysqli_error($conn)."</div>";
		}
		unset($_POST['tutor_select']);
  }
  if(isset($_POST['room_select'])){
		$data = unserialize($_POST['room_select']);
		$sql="UPDATE groups set id_room=".$data['id_room']." WHERE id_group = ".$data['id_group'].";";
		if (mysqli_query($conn, $sql)) {
	    echo "<div class='alert alert-success'>Raum wurde zugeordnet</div>";
		} else {
		    echo "<div class='alert alert-warning'> Error: " . $sql . "<br>" . mysqli_error($conn)."</div>";
		}
		unset($_POST['room_select']);
  }
  

	$groups = mysqli_query($conn,"
		SELECT id_group, grade, subject, day, slots.id_slot, slots.slot AS time, title FROM groups
		JOIN slots
		ON slots.id_slot=groups.id_slot
		JOIN topics
		ON topics.id_topic=groups.id_topic
		ORDER BY slots.id_slot, grade, subject;");

	/*if($sql_groups){
		$groups = mysqli_fetch_assoc($sql_groups);
	}
	else{
		echo "Bitte erst die Gruppen einteilen";
		//die();
	}*/

	echo "<table class='table table-condensed table-striped'>";
	while($group = mysqli_fetch_assoc($groups)){
		switch($group['time']){
			case 1:
				$time="9:00-10:30";
				break;
			case 2:
				$time="10:45-12:14";
				break;
			case 3:
				$time="12:30-14:00";
				break;
		}
		echo "<tr><td><font color=#357ab7>".$group['day']." ".$time."</font> - Klasse ".$group['grade']." - ".$group['subject']." <small><br/><b><font color=#777>".$group['title']."</font></b ><small></td>";
		
		$selected_tutors = mysqli_query($conn,"SELECT * FROM tutors
			JOIN groups
			ON tutors.id_tutor = groups.id_tutor
			WHERE id_group = ".$group['id_group'].";");
		$tutors = mysqli_query($conn, "SELECT * FROM tutors");

		echo "<td>";
		echo "<form method='post' action='".$_SERVER['PHP_SELF']."' target='_self'>";
		echo "<select name='tutor_select' class='form-control' id='tutor_select'>";
		if($selected_tutor = mysqli_fetch_assoc($selected_tutors)){
			echo "<option selected disabled style='display:none';>".$selected_tutor['firstname']." ".$selected_tutor['lastname']."</option>";
		}
		else{
			echo "<option selected disabled style='display:none';></option>";
		}
		while($tutor = mysqli_fetch_assoc($tutors)) {
			$data=serialize(array('id_group' => $group['id_group'], 'id_tutor' => $tutor['id_tutor']));
			echo "<option value='".$data."'>".$tutor['firstname']." ".$tutor['lastname']."</option>";
		}
		echo "</select></td>
		";

		$selected_rooms = mysqli_query($conn,"SELECT * FROM rooms
			JOIN groups
			ON rooms.id_room = groups.id_room
			WHERE id_group = ".$group['id_group'].";");
		$rooms = mysqli_query($conn, "SELECT * FROM rooms");
		echo "<td>";
		echo "<select name='room_select' class='form-control' id='room_select'>";
		if($selected_room = mysqli_fetch_assoc($selected_rooms)){
			echo "<option selected disabled style='display:none';>".$selected_room['room_name']."</option>";
		}
		else{
			echo "<option selected disabled style='display:none';></option>";
		}
		while($room = mysqli_fetch_assoc($rooms)) {
			$data=serialize(array('id_group' => $group['id_group'], 'id_room' => $room['id_room']));
			echo "<option value='".$data."'>".$room['room_name']."</option>";
		}
		echo "</select></td><td><button type='submit' class='btn btn-success'>Eintragen</button></td></form></tr>
		";



	}
	echo "</table>";
	close_connection($conn);

?>