<?php
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

// sql to create table topics
$sql = "CREATE TABLE topics(
id_topic INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(500) NOT NULL,
grade VARCHAR(8) NOT NULL,
day VARCHAR(8),
subject VARCHAR(45)
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
    REFERENCES students (id_student),
CONSTRAINT fk_students_topics_topic
    FOREIGN KEY (id_topic)
    REFERENCES topics (id_topic)
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
CONSTRAINT fk_topic
    FOREIGN KEY (id_topic)
    REFERENCES topics (id_topic)
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
    REFERENCES students (id_student),
CONSTRAINT fk_students_groups_group
    FOREIGN KEY (id_group)
    REFERENCES groups (id_group)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'students_groups' created successfully<br/>";
} else {
    echo "Error creating table 'students_groups': " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
