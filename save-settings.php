<?php
//var_dump($_POST);
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$db = Db::getInstance();
$confirm = $_POST['confirm'];
$term = $_POST['term'];
$year = $_POST['year'];
$max_unit = $_POST['max-unit'];
$deptID = $_SESSION['deptID'];

if (!$confirm == '')
{
    $db->modify("UPDATE `option-department` SET `opValue` = '$confirm' WHERE deptID = '$deptID[0]' AND opID = 1");
}

if (!$term == '')
{
    $db->modify("UPDATE `option-department` SET `opValue` = '$term' WHERE deptID = '$deptID[0]' AND opID = 2");
}

if (!$year == '')
{
    $db->modify("UPDATE `option-department` SET `opValue` = '$year' WHERE deptID = '$deptID[0]' AND opID = 3");
}

if (!$max_unit == '')
{
    $db->modify("UPDATE `option-department` SET `opValue` = '$max_unit' WHERE deptID = '$deptID[0]' AND opID = 4");
    $db->modify("UPDATE `student` SET `allowedUnit` = '$max_unit' WHERE deptID = '$deptID[0]'");
}

// in payin dobare term o sal o auto confirm ro migire ke tanzimate jadid ro dashte bashe.
$temp1 = $_SESSION['admin_login'];
$_SESSION['confirmed'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=1 AND admin.adminUserName='$temp1'");
$_SESSION['currentTerm'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=2 AND admin.adminUserName='$temp1'");
$_SESSION['currentYear'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=3 AND admin.adminUserName='$temp1'");
$_SESSION['maxUnit'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=4 AND admin.adminUserName='$temp1'");

// in payin dobare miad occupied dars ha ro az aval set mikone
$courses = $db->query("SELECT * FROM course ORDER BY courseName");
$term =  $_SESSION['currentTerm'][0];
$year =  $_SESSION['currentYear'][0];
if (isset($courses)) {
    foreach ($courses as $course1) {
        $id = $course1['ID'];
        $occupied = $db->single_variable("SELECT COUNT(*) FROM student_course where courseID = '$id' AND term = '$term' AND  `year` = '$year'");
        $db->modify("UPDATE `course` SET `courseOccupied`= $occupied[0] WHERE ID = '$id'");
    }
}




//$db->close();
header("Location: settings.php");