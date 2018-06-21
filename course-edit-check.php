<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login']) || !isset($_POST['c_id'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}

$deptID = $_SESSION['deptID'];

$course_id = $_POST['c_id'];
$course_name = $_POST['c_name'];
$course_code = $_POST['c_code'];
$course_unit = $_POST['c_unit'];
$course_type = $_POST['c_type'];

$db = Db::getInstance();
$db->modify("UPDATE `course` SET `courseName`='$course_name',`courseCode`='$course_code',`courseUnit`='$course_unit', courseType='$course_type' WHERE `ID`='$course_id' AND deptID='$deptID[0]'");
$db->close();
header("Location: admin-panel.php");