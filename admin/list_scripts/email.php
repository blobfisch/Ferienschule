<?php	

	$objPHPExcel->getProperties()->setTitle("Emailadressen")
				 ->setSubject("Ferienschule")
				 ->setDescription("Liste mit den Mailadressen aller Angemeldeten Schüler");

	$sql = "SELECT students.lastname, students.firstname, students.email
	FROM students
	order by students.lastname, students.firstname;";


	$result = get_sql_result($sql);
	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->setActiveSheetIndex(0); 

	$rowCount = 1; 
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'Nachname');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'Vorname');
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'Email');
	while($row = mysqli_fetch_array($result)){ 
	$rowCount++;
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['0']);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['1']);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['2']);
	} 

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('../../lists/Mailadressen.xlsx'); 
?>