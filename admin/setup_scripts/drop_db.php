<?php
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

$sql = "DROP DATABASE ".$dbname;

if (mysqli_query($conn, $sql)) {
    echo "Database deleted successfully<br/>";
} else {
    echo "Error deleting Database: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
