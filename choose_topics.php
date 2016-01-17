<?php
	//creates the tables to be displayed in the form
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ferienschule";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Change character set to utf8 (fixed encoding errors)
	mysqli_set_charset($conn,"utf8");

	//Generate html tables with data from topics
	$days = array("Mo","Di","Mi","Do","Fr");
	$grades = array("6","7","8","9","10");

	//create one table for every year
	foreach($grades as $grade){
		echo "<button type='button' data-toggle='collapse' class='btn btn-info' data-target='#grade".$grade."'>Klasse: ".$grade."</button></br>";
		echo "<div  id='grade".$grade."' class='collapse'><table class='table table-condensed table-responsive' class='table-responsive'>"; 
		$i=0;
		//print table headline with all the subjects
		echo "<tr class='bg-info text-info'><td>Tag</td>";
		$subjects = mysqli_query($conn, "select subject from topics where grade = ".$grade." group by subject"); //fetches all subjects for this year
		while($subject = mysqli_fetch_assoc($subjects)) {
			echo "<td>".$subject["subject"]."</td>";	
		}
		echo "</tr>";
		//print table row for each day
		foreach($days as $day){
			echo "<tr>";
			echo "<td class='bg-info text-info'>".$day."</td>";
			$subjects = mysqli_query($conn, "select subject from topics where grade = ".$grade." group by subject"); //fetches all subjects for this year
		  while($subject = mysqli_fetch_assoc($subjects)) {
		  			$topics = mysqli_query($conn, "select title, id_topic from topics where grade = ".$grade." and day = '".$day."' and subject = '".$subject["subject"]."'"); //fetches the title of the lesson
		  			$topic = mysqli_fetch_assoc($topics);
		  			echo "<td><label><input type='checkbox' name='topics[]' value=".$topic["id_topic"].">".$topic["title"]."</label></td>"; //prints one cell with topic
		  }
		  echo "</tr>";
		}
		unset($day);
		echo "</table></div>";

	}
	//close sql connection
	mysqli_close($conn);

?>
