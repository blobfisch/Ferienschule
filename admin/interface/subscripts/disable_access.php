 <?php

$source = "../../../php/error_no_form.html";
$dest = "../../../form.php";
if (!copy($source, $dest)) {
    echo "copy $source schlug fehl...\n";
}
else
		echo "Anmeldung erfolgreich geschlossen";
?> 