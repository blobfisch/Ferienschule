<?php


// sql to create table sudents
$sql = "CREATE TABLE students(
id_student INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
grade INT(8),
class VARCHAR(8),
reg_date TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'students' created successfully<br/>";
} else {
    echo "Error creating table 'students': " . mysqli_error($conn);
}

// sql to create table slots
$sql = "CREATE TABLE slots(
id_slot INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
day VARCHAR(8) NOT NULL,
day_num INT(6) NOT NULL,
slot INT(6) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'slots' created successfully<br/>";
} else {
    echo "Error creating table 'slots': " . mysqli_error($conn);
}

// sql to create table topics
$sql = "CREATE TABLE topics(
id_topic INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(200) NOT NULL,
grade INT(8) NOT NULL,
subject VARCHAR(45) NOT NULL,
max_amount_of_groups INT(8) NOT NULL,
id_slot INT(6) UNSIGNED,
CONSTRAINT fk_topics_slots
    FOREIGN KEY (id_slot)
    REFERENCES slots (id_slot)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'topics' created successfully<br/>";
} else {
    echo "Error creating table 'topics': " . mysqli_error($conn);
}

// sql to create link table students_topics
$sql = "CREATE TABLE students_topics(
id_student INT(6) UNSIGNED,
id_topic INT(6) UNSIGNED,
CONSTRAINT fk_students_topics_student
    FOREIGN KEY (id_student)
    REFERENCES students (id_student)
    ON DELETE CASCADE,
CONSTRAINT fk_students_topics_topic
    FOREIGN KEY (id_topic)
    REFERENCES topics (id_topic)
    ON DELETE CASCADE
)";


if (mysqli_query($conn, $sql)) {
    echo "Table 'students_topics' created successfully<br/>";
} else {
    echo "Error creating table 'students_topics': " . mysqli_error($conn);
}

// sql to create table tutors
$sql = "CREATE TABLE tutors(
id_tutor INT(6) UNSIGNED PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'tutors' created successfully<br/>";
} else {
    echo "Error creating table 'tutors': " . mysqli_error($conn);
}

// sql to create table rooms
$sql = "CREATE TABLE rooms(
id_room INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
room_name VARCHAR(10)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'rooms' created successfully<br/>";
} else {
    echo "Error creating table 'rooms': " . mysqli_error($conn);
}

// sql to create table groups
$sql = "CREATE TABLE groups(
id_group INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_topic INT(6) UNSIGNED,
id_slot INT(6) UNSIGNED,
id_tutor INT(6) UNSIGNED,
id_room INT(6) UNSIGNED,
group_num INT(8) UNSIGNED,
CONSTRAINT fk_topic
    FOREIGN KEY (id_topic)
    REFERENCES topics (id_topic),
CONSTRAINT fk_slot
    FOREIGN KEY (id_slot)
    REFERENCES slots (id_slot),
CONSTRAINT fk_tutor
    FOREIGN KEY (id_tutor)
    REFERENCES tutors (id_tutor),
CONSTRAINT fk_room 
    FOREIGN KEY (id_room)
    REFERENCES rooms (id_room)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'groups' created successfully<br/>";
} else {
    echo "Error creating table 'groups': " . mysqli_error($conn);
}

// sql to create link table students_groups
$sql = "CREATE TABLE students_groups(
id_student INT(6) UNSIGNED,
id_group INT(6) UNSIGNED,
CONSTRAINT fk_students_groups_student
    FOREIGN KEY (id_student)
    REFERENCES students (id_student)
    ON DELETE CASCADE,
CONSTRAINT fk_students_groups_group
    FOREIGN KEY (id_group)
    REFERENCES groups (id_group)
    ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'students_groups' created successfully<br/>";
} else {
    echo "Error creating table 'students_groups': " . mysqli_error($conn);
}
/*
// sql to create link table rooms_slots
$sql = "CREATE TABLE rooms_slots(
id_room INT(6) UNSIGNED,
id_slot INT(6) UNSIGNED,
CONSTRAINT fk_rooms_slots_slot
    FOREIGN KEY (id_slot)
    REFERENCES slots (id_slot)
    ON DELETE CASCADE,
CONSTRAINT fk_rooms_slots_room
    FOREIGN KEY (id_room)
    REFERENCES rooms (id_room)
    ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'rooms_slots' created successfully<br/>";
} else {
    echo "Error creating table 'rooms_slots': " . mysqli_error($conn);
}

// sql to create link table tutors_slots
$sql = "CREATE TABLE tutors_slots(
id_tutor INT(6) UNSIGNED,
id_slot INT(6) UNSIGNED,
CONSTRAINT fk_tutors_slots_tutor
    FOREIGN KEY (id_tutor)
    REFERENCES tutors (id_tutor)
    ON DELETE CASCADE,
CONSTRAINT fk_tutors_slots_slot
    FOREIGN KEY (id_slot)
    REFERENCES slots (id_slot)
    ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'tutors_slots' created successfully<br/>";
} else {
    echo "Error creating table 'tutors_slots': " . mysqli_error($conn);
}*/


?> 
