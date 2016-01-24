<?php

	function build_connection(){
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
		return $conn;
	}

	function close_connection($conn){
		//close sql connection
		mysqli_close($conn);
	}
?>