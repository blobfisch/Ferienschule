<?php	

	$objPHPExcel->getProperties()->setTitle("Raumbelegungsplan")
				 ->setSubject("Ferienschule")
				 ->setDescription("Belegungsplan für die einzelnen Räume");

	$objPHPExcel = new PHPExcel(); 
	//$objPHPExcel->setActiveSheetIndex(0); 

	$days = array("Mo","Di","Mi","Do","Fr");
	$slots = array(1,2,3);
	$times = array("9:00-\n10:30","10:45-\n12:15", "12:30-\n14:00");
	$cells = array('A', 'B', 'C', 'D', 'C', 'D', 'E', 'F', 'G');

	$sql_rooms = "SELECT * from rooms";
	//$rooms = mysqli_query($conn, $sql_rooms) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error('ferienschule'), E_USER_ERROR);
	$rooms = get_sql_result($sql_rooms);
	$sheet = 1;

	while($room = mysqli_fetch_assoc($rooms)){
		//create new worksheet for every room and make it active
    $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
    $objWorksheet->setTitle(''. $room["room_name"]);
    $objPHPExcel->addSheet($objWorksheet);
    $objPHPExcel->setActiveSheetIndex($sheet);
    $sheet++;
    $rowHeight=130;
    $columnWidth=60;
    $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
    $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight($rowHeight);
    $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight($rowHeight);
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight($rowHeight);
   	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth($columnWidth);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth($columnWidth);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth($columnWidth);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth($columnWidth);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($columnWidth);

    $rowCount = 1; 
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$room["room_name"]);

    //enter the days and times
		$rowCount++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'Zeit');
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'Montag');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'Dienstag');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'Mittwoch');
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'Donnerstag');
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,'Freitag');
		$rowCount++; $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$times[0]);
		$rowCount++; $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $times[1]);
		$rowCount++; $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $times[2]);

			$colCount = 1;

		//populate the colums with data
		foreach ($days as $day) {
			$rowCount=3;
			foreach ($slots as $slot){
				$group_string = "";
				$sql_group = "SELECT groups.id_group, topics.subject, topics.grade FROM topics
											JOIN groups ON groups.id_topic = topics.id_topic
											JOIN slots ON topics.id_slot = slots.id_slot
											WHERE slots.day = '$day' AND slots.slot = $slot AND groups.id_room = ".$room['id_room'].";";
				$groups = get_sql_result($sql_group);
				$group = mysqli_fetch_assoc($groups);
				if($group['grade']){ //<---- find the right function
					$group_string = "Klasse: ".$group['grade']." ".$group['subject']."\n\nTeilnehmer:";
					echo $group_string;
					$sql_students = "SELECT firstname, lastname FROM students
													JOIN students_groups ON students.id_student = students_groups.id_student
													JOIN groups ON groups.id_group = students_groups.id_group
													WHERE groups.id_group = '".$group['id_group']."';";
					$students = get_sql_result($sql_students);
					while($student = mysqli_fetch_assoc($students)){
						$group_string = $group_string."\n".$student['firstname']." ".$student['lastname'];
					}
					$objPHPExcel->getActiveSheet()->SetCellValue($cells[$colCount].$rowCount, $group_string);
				}
				$rowCount++;
			}
			$colCount++;
		}
	}
	

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter->save('../../lists/Raumbelegungsplan.xlsx'); 
?>
