<?php
require_once ('main.php');
if (!isset($_SESSION['stid'])) {
    header("Location: login.php");
    exit;
}
$db = Db::getInstance();

$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];

//var_dump($_SESSION);
$st_id = $_SESSION['stid'];
$confirmed = $db->single_variable("SELECT confirmed FROM student WHERE ID='$st_id'");
$allowedUnit = $_SESSION['allowedUnit'][0];
$allowedUnit = $allowedUnit + 0;
//echo $allowedUnit;
if($confirmed[0] == "ON") {

    //echo sizeof($_POST);
    $sum = 0;
    foreach ($_POST as $post) {
        $units = $db->single_variable("SELECT courseUnit from course  WHERE course.ID = '$post'");
        $sum += $units[0];
    }
//    var_dump($_POST);
    if ($sum == 0){

    }
    if ($sum > $allowedUnit) {
        $db->close();
        header("Location: index.php?unit=$sum");
    } else {
        $db->modify("DELETE FROM `student_course` WHERE `studentID` = '$st_id' AND term = '$term' AND  `year` = '$year'");

        foreach ($_POST as $post) {
            $db->insert("INSERT INTO `student_course`(`studentID`, `courseID`, `term`, `year`) VALUES ('$st_id','$post', '$term', '$year')");
        }
        $units = $db->single_variable("SELECT SUM(courseUnit) from course  JOIN student_course ON course.ID = student_course.courseID WHERE student_course.studentID = '$st_id' AND student_course.term = '$term' AND  student_course.`year` = '$year' ;");
        $db->modify("UPDATE student SET takenUnits = '$units[0]' WHERE ID='$st_id'");
    }


    /*meghdare occupied ra check mikonad. */
    $courses = $db->query("SELECT * FROM course");

    if (isset($courses)) {
        foreach ($courses as $record) {
            $id = $record['ID'];
            $occupied = $db->single_variable("SELECT COUNT(*) FROM student_course where courseID = '$id' AND term = '$term' AND  `year` = '$year'");
            $db->modify("UPDATE `course` SET `courseOccupied`= $occupied[0] WHERE ID = '$id'");
        }
    }
    $db->close();
    header("Location: index.php");
}
else {
    $db->close();
    header("Location: index.php?sts=na");
}
