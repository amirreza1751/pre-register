<?php
require_once ('db.php');
require_once ('config.php');
require_once ('common.php');


$db = Db::getInstance();

$newPass1 = $_POST['npassword1'];
$newPass2 = $_POST['npassword2'];
$adminUserName = $_POST['adminUserName'];

if ($newPass1 == ''){
    $db->close();
    header("Location: admin-forgot-pass2.php");
}

if(strlen($newPass1)<3 || strlen($newPass2)<3){
//    $message = _passwords_weak;
//    require_once('msg-fail.php');
    header("Location: admin-forgot-pass2.php?sts=pw");
    exit;
}

if($newPass1 != $newPass2){
//    $message = _passwords_not_match;
//    require_once('msg-fail.php');
    header("Location: admin-forgot-pass2.php?sts=pnm");
    exit;
}
$hashedPassword = encryptPassword($newPass1);
//$db->modify("UPDATE admin SET
//    adminPassword = '$hashedPassword'
//     WHERE adminUserName = '$adminUserName'");

$modify = $db->connection()->prepare("UPDATE admin SET adminPassword = ? WHERE adminUserName = ? ");
$modify->bind_param('ss', $hashedPassword, $adminUserName);
$modify->execute();


$db->close();
header("Location: admin-forgot-pass2.php?sts=pch");