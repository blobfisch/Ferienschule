
<?php require('subscripts/menu.php');
/*
echo "<pre>";
$target_dir = "../data/";
$target_file = $target_dir ."tutoren.xlsx";
//print_r($_FILES);
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES["tutors_file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["tutors_file"]["name"]). " has been uploaded.";
}
echo "</pre>";*/

?> 

<div class="row">
	<div class='col-md-6'> 
		<form action='<?php echo $_SERVER['PHP_SELF']?>' target='_self' method="post" enctype="multipart/form-data">
		 <h3>Upload tutoren.xlsx</h3>
		 <p><a href="../data/templates/tutoren.xlsx">So sollte die Datei aussehen</a><br> 
		 <input name="tutors_file" type="file" size="50" accept=".xlsx"> </p> 
		 <button type="submit" class='btn btn-info'>Upload</button> 
		</form>
	</div>
	<div class='col-md-6'> 
		<form  action='<?php echo $_SERVER['PHP_SELF']?>' target='_self' method="post" enctype="multipart/form-data">
		 <h3>Upload rooms.xlsx</h3>
		 <p><a href="../data/templates/rooms.xlsx">So sollte die Datei aussehen</a><br> 
		 <input name="rooms_file" type="file" size="50" accept=".xlsx"> </p> 
		 <button type="submit" class='btn btn-info'>Upload</button> 
		</form>
	</div>
</div>

<?php
echo "<hr/><h3>Tutoren und Räume zuordnen</h3>";
require("subscripts/add_tutors.php");
echo "</body>";
?>