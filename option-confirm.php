<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$db = Db::getInstance();
//$confirm = $db->single_variable("SELECT opValue from `option` WHERE opName = 'confirmed' ");
$check = $_SESSION['confirmed'][0];
$deptID = $_SESSION['deptID'][0];
//$check = $db->single_variable("SELECT opValue FROM `option` WHERE opName = 'confirmed'");
if ($check == "ON"){
    $db->modify("update `option-department` set opValue = 'OFF' WHERE deptID = '$deptID' AND opID = 1");
    $_SESSION['confirmed'][0] = 'OFF';
}
else if ($check == "OFF"){
    $db->modify("update `option-department` set opValue = 'ON' WHERE deptID = '$deptID' AND opID = 1");
    $_SESSION['confirmed'][0] = 'ON';
}

$db->close();
header("Location: student-list.php");