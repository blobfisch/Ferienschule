<?php
	//fills the sql_table topics with the data from data/themenliste.cvs
	//TODO check wether table is empty

  sleep(1); //Gives MySQL some time to update tabel slots
	$conn = build_connection();

	$sql = "";
	//Open cvs file
	$file = fopen("../data/themenliste.csv", "r");
	$data = fgetcsv($file);

	//read line by line and insert into database
	//TODO: Error handeling
	//TODO: Check for empty strings
	$i=0;	while ($data) {
	  $data = fgetcsv($file,0,";");

	  $query = "SELECT id_slot FROM slots WHERE day = '$data[3]' AND slot = '$data[4]';";
	 	echo $query."<br/>";
	  $slots = mysqli_query($conn, $query);
		$slot = mysqli_fetch_assoc($slots);
		$slot= $slot["id_slot"];
		if($slot){
			echo $slot;
			$sql .= "INSERT INTO topics (title, subject, grade, max_amount_of_groups, id_slot)
			VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[5]','$slot');"; 
		}
		else{
			echo "Error: Fehler in themenliste.csv<br/>";
		}

	}
echo $sql;
	if (mysqli_multi_query($conn, $sql)) {
	    echo "Update der Themenliste erfolgreich!";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	close_connection($conn);


?>