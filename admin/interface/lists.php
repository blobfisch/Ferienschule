<?php require('subscripts/menu.php'); ?>
<div class="row">
	<div class="col-md-2">
		<form action="subscripts/write_lists.php" target="output">
			<button type='submit' class='btn btn-info'>Listen neu generieren</button>
		</form>
	</div>
	<div class="col-md-10">
		<iframe name="output" frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 150px;"></iframe>

	</div>
</div>
<hr/>
<h3>Download</h3>
<a href=<?php echo "../lists/full_student_list.xlsx"?> >Schülerliste</a><br/>
<a href=<?php echo "../lists/Raumbelegungsplan.xlsx"?> >Raumbelegungsplan</a><br/>
<a href=<?php echo "../lists/Mailadressen.xlsx"?> >Mailadressen</a><br/>
<a href=<?php echo "../lists/Statistik.xlsx"?> >Statistik</a>



</body>