<?php	

	$objPHPExcel->getProperties()->setTitle("Statistik")
				 ->setSubject("Ferienschule")
				 ->setDescription("Zahlen und Daten");

	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->setActiveSheetIndex(0); 

	$grades = array(6,7,8,9,10);

	$students_total = get_sql_result("SELECT COUNT(*) from students");
	foreach ($grades as $grade) {
		$students_per_grade = get_sql_result("SELECT COUNT(*) WHERE grade = $grade");
	}


	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('../../lists/Statistik.xlsx'); 
?>