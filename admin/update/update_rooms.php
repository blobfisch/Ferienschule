<?
	require_once("../../php/sql_functions.php");
	$conn = build_connection();

	$sql = "";
	/* Include PHPExcel */
	require_once '../../PHPExcel/Classes/PHPExcel.php';

	$inputFileName = "../data/rooms.xlsx";
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

	  $sql.="REPLACE INTO rooms(id_room, room_name) VALUES ('$rows[0]', '$rows[1]');";

	}

	if (mysqli_multi_query($conn, $sql)) {
	  echo "Update der Räume erfolgreich!";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	close_connection($conn);

?>