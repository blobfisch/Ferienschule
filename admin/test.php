<?php
require_once("../php/sql_functions.php");
$conn = build_connection();
$tabelle='students';
$sql_select="SHOW TABLES LIKE '".$tabelle."'";
$query = @mysqli_query($conn, $sql_select);
if(mysqli_num_rows( $query)!=0){
echo 'Die Tabelle '.$tabelle.' gibt es!';
} else {
echo 'Die Tabelle '.$tabelle.' gibt nicht!';
} 

?>