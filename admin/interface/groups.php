<?php require('subscripts/menu.php'); ?>
<div class="row">
	<div class="col-md-2">
		<form action="subscripts/generate_groups.php" target="output">
			<button type='submit' class='btn btn-info'>Gruppen einteilen</button>
		</form><br/>
	</div>
	<div class="col-md-10">
		<iframe name="output" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 150px;"></iframe>

	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-2">
		<form action="subscripts/send_timetable_to_all.php" target="output2">
			<button type='submit' class='btn btn-warning'>Stundenplan an alle Senden</button>
		</form><br/>
	</div>
	<div class="col-md-10">
		<iframe name="output2" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 150px;"></iframe>
	</div>
</div>
</body>