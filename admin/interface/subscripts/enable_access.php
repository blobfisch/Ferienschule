 <?php
$source = "../../../php/form_resource.php";
$dest = "../../../form.php";
if (!copy($source, $dest)) {
    echo "copy $source schlug fehl...\n";
}
else
		echo "Anmeldung erfolgreich geöffnet";
?> 