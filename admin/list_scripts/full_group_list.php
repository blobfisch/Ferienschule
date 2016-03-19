<?php	
	
	$objPHPExcel->getProperties()->setTitle("PHPExcel Test Document")
			 ->setSubject("PHPExcel Test Document")
			 ->setDescription("Test document for PHPExcel, generated using PHP classes.");

	/*$sql = "SELECT groups.id_group, topics.title, students.id_student, students.firstname, students.lastname
		FROM groups
		JOIN students_groups
		ON groups.id_group=students_groups.id_group
		JOIN students
		ON students.id_student=students_groups.id_student
		JOIN topics
		ON groups.id_topic=topics.id_topic
		order by groups.id_group;";*/
	$sql = "SELECT slots.day, slots.slot, topics.grade, topics.subject, groups.group_num, students.firstname, students.lastname FROM groups
		JOIN topics
		ON groups.id_topic = topics.id_topic
		JOIN slots
		ON topics.id_slot = slots.id_slot
		JOIN students_groups
		ON groups.id_group = students_groups.id_group
		JOIN students
		ON students_groups.id_student = students.id_student
		ORDER BY slots.day_num, slots.slot, topics.grade, topics.subject, groups.id_group, students.firstname, students.lastname;
	";
	$previous_day ="";
	$previous_slot ="";
	$previous_subject ="";
	$previous_group ="";


	$result = get_sql_result($sql);
	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->setActiveSheetIndex(0); 

	$rowCount = 1; 
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'day');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'slot');
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'grade');
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'subject');
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'group_num');
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,'firstname');
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,'lastname');


	
	while($row = mysqli_fetch_assoc($result)){ 
		$rowCount++;
	  //if($row['3']=!$previous_group){
	  	//echo $previous_group."!=".$row['3']."<br/>";
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['lastname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['firstname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['group_num']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['grade']);

			if($row['subject']!=$previous_subject){
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['subject']);
				if($row['slot']!=$previous_slot){
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['slot']);
					if($row['day']!=$previous_day){
						$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['day']);
						
					}
				}
			}
		//}
		$previous_group = $row['group_num'];
		$previous_slot = $row['slot'];
		$previous_subject = $row['subject'];
		$previous_day = $row['day'];

	} 

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('../../lists/full_groups_list.xlsx'); 
?>