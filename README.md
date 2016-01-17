structure

/* page that will be visible for the user */
form.php 
	calls choose_topics.php			//generates the tables with topics from the database
	calls php/input.php			//writes the user input to database
		calls validate_form_data			//prevent invalid data and sql injections

/* scripts for the administrator */
/admin
	setup_sql.php
		calls setup_scripts/create_database			//creates the database ferienschule
		calls setup_scripts/create_tables				//creates the tables in ferienschule
		calls setup_scripts/import_themenliste				//imports the data to topics

	generate_groups.php			//distributes students into groops and writes them to database

	write_lists.php			//outputs data to excel files using PHPExcel
		calls list_scrips/full_student_list.php
		...