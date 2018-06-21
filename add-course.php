<?php
require_once ('main.php');
if (!isset($_POST[$c_name]) || !isset($_SESSION['deptID'])){
    header("Location: student-list.php");
}
$deptID = $_SESSION['deptID'][0];
$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];

$c_name = $_POST['c_name'];
$c_code = $_POST['c_code'];
$c_unit = $_POST['c_unit'];
$c_type = $_POST['c_type'];

$db = Db::getInstance();

$first_duplicate_check = $db->single_variable("SELECT ID FROM course INNER JOIN course_term
WHERE course_term.courseID=course.ID 
AND course_term.term = '$term' 
AND course_term.`year` = '$year' 
AND course.deptID = '$deptID' 
AND course.courseCode = '$c_code'");

if (isset($first_duplicate_check)){
     header("Location: admin-panel.php?duplicate=y");
}

else {
 $duplicate_check = $db->single_variable("SELECT ID FROM course WHERE courseCode='$c_code' AND deptID = '$deptID';");
 if (!isset($duplicate_check)) {
  $db->insert("INSERT INTO course (courseName, courseCode, courseUnit, deptID, courseType)
    VALUES                         ('$c_name', '$c_code', '$c_unit', '$deptID', '$c_type')");
 }

 $recently_added_course_id = $db->single_variable("SELECT ID FROM `course` WHERE courseCode = '$c_code' AND deptID = '$deptID'");

 $db->insert("INSERT INTO course_term (courseID, term , `year`) VALUES ($recently_added_course_id[0], '$term' , '$year') ;");

//$db->insert("INSERT INTO `pre-register`.`course` (`course_id`, `course_name`, `course_code`, `course_occupied`, `course_unit`, `course_requirement`) VALUES (NULL, 'jgkjg', '24', '0', '2', 'jfjyfghdhf');");
//exit;
 $db->close();
header("Location: admin-panel.php");
}
?>

