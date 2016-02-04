<?php	

	$objPHPExcel->getProperties()->setTitle("Schülerliste")
				 ->setSubject("Ferienschule")
				 ->setDescription("Liste mit den Daten aller Angemeldeten Schüler");

	$sql = "SELECT students.lastname, students.firstname, students.grade, students.class, topics.day,
	topics.subject, topics.title
	FROM students
	JOIN students_topics
	ON students.id_student=students_topics.id_student
	JOIN topics
	ON topics.id_topic=students_topics.id_topic
	order by students.grade, students.class, students.lastname, students.firstname;";


	$result = get_sql_result($sql);
	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->setActiveSheetIndex(0); 

	$rowCount = 1; 
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'Nachname');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'Vorname');
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'Stufe');
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'Klasse');
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'Tag');
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,'Fach');
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,'Thema');
	while($row = mysqli_fetch_array($result)){ 
	$rowCount++;
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['0']);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['1']);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['2']);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['3']);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['4']);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['5']);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['6']);

	} 

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('lists/full_student_list.xlsx'); 
?>