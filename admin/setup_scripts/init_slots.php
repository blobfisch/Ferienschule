<?php


	$sql = "INSERT INTO slots (day, slot) VALUES ('Mo', 1);
	INSERT INTO slots (day, slot) VALUES ('Mo', 2);
	INSERT INTO slots (day, slot) VALUES ('Mo', 3);
	INSERT INTO slots (day, slot) VALUES ('Di', 1);
	INSERT INTO slots (day, slot) VALUES ('Di', 2);
	INSERT INTO slots (day, slot) VALUES ('Di', 3);
	INSERT INTO slots (day, slot) VALUES ('Mi', 1);
	INSERT INTO slots (day, slot) VALUES ('Mi', 2);
	INSERT INTO slots (day, slot) VALUES ('Mi', 3);
	INSERT INTO slots (day, slot) VALUES ('Do', 1);
	INSERT INTO slots (day, slot) VALUES ('Do', 2);
	INSERT INTO slots (day, slot) VALUES ('Do', 3);
	INSERT INTO slots (day, slot) VALUES ('Fr', 1);
	INSERT INTO slots (day, slot) VALUES ('Fr', 2);
	INSERT INTO slots (day, slot) VALUES ('Fr', 3);
	"; 


	if (mysqli_multi_query($conn, $sql)) {
	    echo "Slots initialiert<br/>";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}


?>