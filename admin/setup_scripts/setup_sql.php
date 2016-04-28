<?php

//build sql connection
require_once("../../php/sql_functions.php");
$conn = build_connection();
$sql_select="SHOW TABLES LIKE 'students'";
$query = @mysqli_query($conn, $sql_select);
if(mysqli_num_rows($query)!=0){
	echo "<p style='color: red'>Die Daten aus dem Letzten Jahr wurden noch nicht gelöscht!
		Klicke unter \"Aufräumen\" auf \"Daten des letzten Schuljahres löschen\" um Platz für einen neuen Durchlauf zu schaffen.</p>";
}
else{
	close_connection($conn);

	//Setup a new database called "ferienschule"
	require 'create_database.php';

	//build sql connection
	require_once("../../php/sql_functions.php");
	//function in php/sql_functions.php
	$conn = build_connection();

	//Add the tables "students", "topics", to the database
	require 'create_tables.php';
	//Fills the table slots
	require 'init_slots.php';
	close_connection($conn);

	//Fill the table "topics" with data from "data/themenliste.csv"
	require 'import_themenliste_excel.php';
}

?>
