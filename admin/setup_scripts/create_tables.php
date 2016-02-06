<?php


// sql to create table sudents
$sql = "CREATE TABLE students(
id_student INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
grade VARCHAR(8),
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
slot INT(6) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'slots' created successfully<br/>";
} else {
    echo "Error creating table 'groups': " . mysqli_error($conn);
}

// sql to create table topics
$sql = "CREATE TABLE topics(
id_topic INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(200) NOT NULL,
grade VARCHAR(8) NOT NULL,
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

// sql to create table groups
$sql = "CREATE TABLE groups(
id_group INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_topic INT(6) UNSIGNED,
id_slot INT(6) UNSIGNED,
CONSTRAINT fk_topic
    FOREIGN KEY (id_topic)
    REFERENCES topics (id_topic),
CONSTRAINT fk_slot
    FOREIGN KEY (id_slot)
    REFERENCES slots (id_slot)
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



?> 
