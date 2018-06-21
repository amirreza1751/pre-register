<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
if($_POST!= null){
    $course = $_POST['relatedCourse'];

$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];

$db = Db::getInstance();
$records = $db->query("SELECT course.courseName, c1.courseID AS otherCourses , COUNT(c1.courseID) AS tedad
FROM student_course, student_course AS c1
JOIN course ON course.ID = c1.courseID
WHERE
	student_course.studentID = c1.studentID
	AND student_course.courseID != c1.courseID
	AND student_course.courseID = '$course'
	AND c1.term = '$term'
	AND c1.`year` = '$year'
	GROUP BY otherCourses
");

//    var_dump($records);
//    echo sizeof($records);
//    $rec = http_build_query($records);
//    var_dump($rec);
    var_dump($records);
//header("Location: report.php?report=". http_build_query($records));
    $db->close();
}