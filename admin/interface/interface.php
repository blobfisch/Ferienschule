<?php require('subscripts/menu.php'); ?>
		<div class="row">
			<div class="col-md-2">
				<form action="subscripts/generate_groups.php" target="output_1">
					<button type='submit' class='btn btn-info'>Gruppen einteilen</button>
				</form><br/>
				<form action="subscripts/write_lists.php" target="output_1">
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
				<form action="../setup_scripts/drop_db.php" target="output_2" id="conf">
					<button type='submit' class='btn btn-danger'>1. Daten des letzen Schuljahres löschen</button>
				</form><br/>
				<!-- Löschen bestätigen -->
				<script>
					$("#conf").submit(function(){
						var c = confirm("Wirklich alle Daten löschen? Nur nach der Veranstaltung!");
						return c;
					});
				</script>
				<form action="../setup_scripts/setup_sql.php" target="output_2">
					<button type='submit' class='btn btn-danger'>2. Setup für das neue Schuljahr</button>
				</form><br/>
			</div>
			<div class="col-md-8">
				<iframe name="output_2" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 100px;"></iframe>
			</div>
		</div>
		<hr/>
		<h3>Maximale Anzahl erhöhen</h3>
		<?php
		
		require("subscripts/increase_max_amount.php");

		echo "<hr/>";
		echo "<h3>Schüler löschen</h3>";
		
		require("subscripts/delete_student.php");

		echo "<hr/><h3>Tutoren und Räume zuordnen</h3>";
		
		require("subscripts/add_tutors.php");


		?>

		
	</div>
</body>