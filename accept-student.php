<?php
require_once ('main.php');

if (!isset($_POST['checkBox']) || !isset($_POST['allowedUnit']) || !isset($_POST['delete'])){
    header("Location: student-list.php");
}
var_dump($_POST);
$db = Db::getInstance();

$deptID = $_SESSION['deptID'][0];
$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];


$db->modify("UPDATE `student` SET `confirmed`= 'OFF' WHERE deptID='$deptID'");
foreach ($_POST['checkBox'] as $post1){
    $db->modify("UPDATE `student` SET `confirmed`= 'ON' WHERE `ID`='$post1' ");
}

foreach ($_POST['allowedUnit'] as $post2 => $post3){
    $db->modify("UPDATE `student` SET `allowedUnit`= '$post3' WHERE `ID`='$post2' ");
//    echo $post2; andis
//    echo "\n";
//    echo $post3; meghdar
}

foreach ($_POST['delete'] as $post4){
    $db->modify("DELETE FROM student_course WHERE studentID = '$post4' ");
    $db->modify("DELETE FROM student WHERE ID = '$post4'");
}

$db->close();
header("Location: student-list.php");