<?
	//fills the sql_table topics with the data from data/themenliste.xlsx
	//TODO check whether table is empty

	sleep(1); //Gives MySQL some time to update tabel slots
	$conn = build_connection();

	$sql = "";
	/* Include PHPExcel */
	require_once '../../PHPExcel/Classes/PHPExcel.php';

	$inputFileName = "../data/themenliste.xlsx";
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objReader->setReadDataOnly(true);
	$objPHPExcel = $objReader->load($inputFileName);
	$objWorksheet = $objPHPExcel->getActiveSheet();

	$highestRow = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	$rows = array();
	for ($row = 2; $row <= $highestRow; ++$row) {
	  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
	    $rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
	  }
	  $query = "SELECT id_slot FROM slots WHERE day = '$rows[3]' AND slot = '$rows[4]';";
	  $slots = mysqli_query($conn, $query);
		$slot = mysqli_fetch_assoc($slots);
		$slot= $slot["id_slot"];
		if($slot){
			$sql .= "INSERT INTO topics (title, subject, grade, max_amount_of_groups, id_slot)
			VALUES ('$rows[0]', '$rows[1]', '$rows[2]', '$rows[5]','$slot');"; 
		}
		else{
			echo "Error: Data in Themenliste.xlsx false at row".$row."<br/>";
		}
	}

	if (mysqli_multi_query($conn, $sql)) {
	  echo "Update der Themenliste erfolgreich!";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	close_connection($conn);

?>