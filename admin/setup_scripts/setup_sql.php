<?php
//Setup a new database called "ferienschule"
	require 'create_database.php';
//Add the tables "students", "topics", to the database
	require 'create_tables.php';
//Fill the table "topics" with data from "data/themenliste.csv"
	//require 'import_themenliste.php';
?>
