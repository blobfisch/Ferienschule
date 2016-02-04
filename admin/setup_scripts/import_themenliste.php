<?php
	//fills the sql_table topics with the data from data/themenliste.cvs
	//TODO check wether table is empty

	$sql = "";
	//Open cvs file
	$file = fopen("../data/themenliste.csv", "r");
	$data = fgetcsv($file);

	//read line by line and insert into database
	//TODO: Error handeling
	//TODO: Check for empty strings
	while ($data) {
	  $data = fgetcsv($file,0,";");
	  //print_r($data); test content of array
		$sql .= "INSERT INTO topics (title, subject, grade, day)
		VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]');"; 
	}


	if (mysqli_multi_query($conn, $sql)) {
	    echo "Update der Themenliste erfolgreich!";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}


?>