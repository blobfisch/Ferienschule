<?php

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
	$conn = build_connection();
	//Fill the table "topics" with data from "data/themenliste.csv"
	require 'import_themenliste.php';

	close_connection($conn);
?>
