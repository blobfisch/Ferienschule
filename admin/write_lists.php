<?php 
	function get_sql_result($sql){
		require_once("../php/sql_functions.php");
	
		//function in php/sql_functions.php
		$conn = build_connection();

		$result = mysqli_query($conn, $sql);
		//confirm_query($result);

		close_connection($conn);

		return $result;
	}

	function create_new_PHPexcel_obj(){
		// Create new PHPExcel object
		echo date('H:i:s') , " Create new PHPExcel object" , EOL;
		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("Website_Ferienschule")
				 ->setLastModifiedBy("Website_Ferienschule");
		return $objPHPExcel;
	}

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	/* Include PHPExcel */
	require_once '../PHPExcel/Classes/PHPExcel.php';
	//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

	$objPHPExcel = create_new_PHPexcel_obj();

	require "list_scripts/full_student_list.php";
?>
