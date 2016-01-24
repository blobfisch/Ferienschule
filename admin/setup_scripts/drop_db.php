<?php

//build sql connection
require_once("../../php/sql_functions.php");
//function in php/sql_functions.php
$conn = build_connection();

$sql = "DROP DATABASE ferienschule";

if (mysqli_query($conn, $sql)) {
    echo "Database deleted successfully<br/>";
} else {
    echo "Error deleting Database: " . mysqli_error($conn);
}

close_connection($conn);
?> 
