<?php require('subscripts/menu.php'); ?>

<form action="#" method="post" enctype="multipart/form-data">
		 <h3>Upload themenliste.xlsx</h3>
		 <p><a href="../data/templates/themenliste.xlsx">So sollte die Datei aussehen</a><br> 
		 <input name="Datei" type="file" size="50" accept=".xlsx"> </p> 
		 <button type="button" class='btn btn-info'>Upload</button> 
</form>
<hr/>
<div class="row">
	<p class='alert alert-danger'>Achtung: alle Daten gehen verloren! </p>
	<div class='col-md-4'> 
		<!-- Löschen bestätigen -->
		<script>
			$("#conf").submit(function(){
				var c = confirm("Achtung: Dieser Schritt darf nicht wärend einer laufenden Anmeldephase durchgeführt werden!");
				return c;
			});
		</script>
		<form action="../setup_scripts/setup_sql.php" target="output_2" id="conf">
			<button type='submit' class='btn btn-danger'>Setup für das neue Schuljahr</button>
		</form><br/>
	</div>
	<div class="col-md-8">
		<iframe name="output_2" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 100px;"></iframe>
	</div>
</div>
<hr/>
<h3>Test Stundenplan <small>Hier kann überprüft werden, ob die Daten im Stundenplan stimmen, bevor dieser veröffentlicht wird</small></h3><br/>
<?php require("../test_timetable/choose_topics.php");?>
</body>