<?php
	//fills the sql_table topics with the data from data/themenliste.cvs
	//TODO check wether table is empty


	//Setup database connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ferienschule";
	$sql = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connectionlast
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Change character set to utf8 (fixed encoding errors)
	mysqli_set_charset($conn,"utf8");


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

	mysqli_close($conn);

?>