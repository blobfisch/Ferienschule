<?php
require('subscripts/menu.php');
?>
<hr>
<form action='subscripts/enable_access.php' target ='output' id='conf'>
	<button type='submit' class='btn btn-success'>Anmeldung öffnen</button>
</form>		
<iframe name='output' frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 2em;"></iframe>
<hr/>
<?php
echo "<h3>Maximale Anzahl erhöhen</h3>";
		
require("subscripts/increase_max_amount.php");

echo "<hr/>";
echo "<h3>Schüler löschen</h3>";

require("subscripts/delete_student.php");
?>
<hr/>
<form action='subscripts/disable_access.php' target ='output2' id='conf'>
	<button type='submit' class='btn btn-success'>Anmeldung schließen</button>
</form>		
<iframe name='output2' frameborder="0" border="0" cellspacing="0" style="border-style: none;width: 100%; height: 3em;"></iframe>
<br/>
</body>