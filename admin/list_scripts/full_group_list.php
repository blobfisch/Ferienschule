<?php	
	
	$objPHPExcel->getProperties()->setTitle("PHPExcel Test Document")
			 ->setSubject("PHPExcel Test Document")
			 ->setDescription("Test document for PHPExcel, generated using PHP classes.");

	$sql = "SELECT groups.id_group, topics.title, students.id_student, students.firstname, students.lastname
		FROM groups
		JOIN students_groups
		ON groups.id_group=students_groups.id_group
		JOIN students
		ON students.id_student=students_groups.id_student
		JOIN topics
		ON groups.id_topic=topics.id_topic
		order by groups.id_group;";


	$result = get_sql_result($sql);
	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->setActiveSheetIndex(0); 

	$rowCount = 1; 
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'id_group');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'topic');
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'id_student');
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'firstname');
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'lastname');
	while($row = mysqli_fetch_array($result)){ 
	$rowCount++;
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['0']);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['1']);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['2']);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['3']);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['4']);
	} 

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('lists/full_groups_list.xlsx'); 
?>