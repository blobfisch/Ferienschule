<!DOCTYPE html>
<html lang="de">
<head>
	<title>Ferienschule des Ellenrieder Gymnasiums</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<!-- Latest compiled and minified CSS -->
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css">  
	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
	<script src="bootstrap-3.3.5-dist/jquery-1.11.3.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
	<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>
<body>
	<div>
		<form action="php/input.php" method="post" target="error_m">
			<div class="form-group" >
				<label for="firstname">Vorname:</label>
				<input type="text" name="firstname" class="form-control" maxlength="45">
			</div><br/>
			<div class="form-group" class="form-inline">
				<label for="lastname">Nachname:</label>
				<input type="text" name="lastname" class="form-control" maxlength="45">
			</div><br/>
			<div class="form-group" class="form-inline">
				<label for="email">Email:</label>
				<input type="text" name="email" class="form-control" maxlength="45">
			</div><br/>
			<div class="form-group" class="form-inline">
				<label for="grade">Klasse:</label>
				<select name="grade" class="form-control">
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
				<label class="radio-inline"><input type="radio" name="class" value="A" checked>A</label>
				<label class="radio-inline"><input type="radio" name="class" value="B">B</label>
				<label class="radio-inline"><input type="radio" name="class" value="C">C</label>
				<label class="radio-inline"><input type="radio" name="class" value="D">D</label>
				<label class="radio-inline"><input type="radio" name="class" value="E">E</label>
			</div><br/>

			<div class="form-group form-inline">

				<?php require 'choose_topics.php' ?><br/>
			</div>
			<div class="form-group" class="form-inline">
			<button type="submit" class="btn btn-primary">Daten absenden</button>
		</form><br/>
		<iframe name="error_m" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 300px;"></iframe>
	</div>
</body>
</html> 
