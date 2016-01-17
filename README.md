#structure
```
*page that will be visible for the user*
form.php 
	calls choose_topics.php			//generates the tables with topics from the database
	calls php/input.php			//writes the user input to database
		calls validate_form_data			//prevent invalid data and sql injections
```
*scripts for the administrator*
/admin
	interface.html //makes scrips easily accessible through buttons
```