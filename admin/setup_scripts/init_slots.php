<?php


	$sql = "INSERT INTO slots (day, day_num, slot) VALUES ('Mo',1, 1);
	INSERT INTO slots (day, day_num, slot) VALUES ('Mo',1, 2);
	INSERT INTO slots (day, day_num, slot) VALUES ('Mo',1, 3);
	INSERT INTO slots (day, day_num, slot) VALUES ('Di',2, 1);
	INSERT INTO slots (day, day_num, slot) VALUES ('Di',2, 2);
	INSERT INTO slots (day, day_num, slot) VALUES ('Di',2, 3);
	INSERT INTO slots (day, day_num, slot) VALUES ('Mi',3, 1);
	INSERT INTO slots (day, day_num, slot) VALUES ('Mi',3, 2);
	INSERT INTO slots (day, day_num, slot) VALUES ('Mi',3, 3);
	INSERT INTO slots (day, day_num, slot) VALUES ('Do',4, 1);
	INSERT INTO slots (day, day_num, slot) VALUES ('Do',4, 2);
	INSERT INTO slots (day, day_num, slot) VALUES ('Do',4, 3);
	INSERT INTO slots (day, day_num, slot) VALUES ('Fr',5, 1);
	INSERT INTO slots (day, day_num, slot) VALUES ('Fr',5, 2);
	INSERT INTO slots (day, day_num, slot) VALUES ('Fr',5, 3);
	"; 


	if (mysqli_multi_query($conn, $sql)) {
	    echo "Slots initialiert<br/>";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}


?>