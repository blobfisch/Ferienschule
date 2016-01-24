<!DOCTYPE html>
<html lang="de">
<head>
	<title>Ferienschule des Ellenrieder Gymnasiums</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<!-- Latest compiled and minified CSS -->
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.min.css">  
	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
	<script src="../bootstrap-3.3.5-dist/jquery-1.11.3.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
	<script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>
<body>
	<div class="container-fluid">
		<h1>Administration der Ferienschule</h1><br/>
		<div class="row">
			<div class="col-md-2">
				<form action="generate_groups.php" target="output_1">
					<button type='submit' class='btn btn-info'>Gruppen einteilen</button>
				</form><br/>
				<form action="write_lists.php" target="output_1">
					<button type='submit' class='btn btn-info'>Listen neu generieren</button>
				</form>
			</div>
			<div class="col-md-10">
				<iframe name="output_1" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 150px;"></iframe>

			</div>
		</div>
		<hr/>
		<h3>Setup</h3>
		<div class="row">
			<div class='col-md-4'> <p class='alert alert-danger'>Achtung: alle Daten gehen verloren! </p>
				<form action="setup_scripts/drop_db.php" target="output_2">
					<button type='submit' class='btn btn-danger'>Daten löschen</button>
				</form><br/>
				<form action="setup_scripts/setup_sql.php" target="output_2">
					<button type='submit' class='btn btn-danger'>Setup für das neue Schuljahr</button>
				</form><br/>
				<form action="setup_scripts/import_themenliste.php" target="output_2">
					<button type='submit' class='btn btn-danger'>Themenliste Aktualisieren</button>
				</form>
			</div>
			<div class="col-md-8">
				<iframe name="output_2" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 100px;"></iframe>
			</div>
		</div>
		<hr/>
		<h3>Schüler löschen</h3>
		<?php
		
		require("delete_student.php");

		?>

		
	</div>
</body>