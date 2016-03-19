<?php require('subscripts/menu.php'); ?>

<div class="row">
	<p class='alert alert-danger'>Achtung: alle Daten gehen verloren! </p>
	<div class='col-md-4'> 
		<form action="../setup_scripts/drop_db.php" target="output" id="conf">
			<button type='submit' class='btn btn-danger'>Daten des letzen Schuljahres löschen</button>
		</form><br/>
		<!-- Löschen bestätigen -->
		<script>
			$("#conf").submit(function(){
				var c = confirm("Wirklich alle Daten löschen? Nur nach der Veranstaltung!");
				return c;
			});
		</script>
	</div>
	<div class="col-md-8">
		<iframe name="output" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 100px;"></iframe>
	</div>
</div>
</body>