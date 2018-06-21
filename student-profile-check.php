<?php
require_once ('main.php');
if (!isset($_SESSION['stid'])) {
    header("Location: login.php");
}
$id = $_SESSION['stid'];

$db = Db::getInstance();

$nfname = $_POST['nfname'];
$nlname = $_POST['nlname'];
$nstid = $_POST['nstid'];
$nemail = $_POST['nemail'];
$nyear = $_POST['nyear'];
$newPass1 = $_POST['nps1'];
$newPass2 = $_POST['nps2'];
//var_dump($_POST);
//var_dump($newPass1) ;

if ($newPass1 == ''){
    $db->modify("UPDATE student SET
    firstName = '$nfname',
    lastName = '$nlname',
    studentID = '$nstid',
    email = '$nemail',
    entryYear = '$nyear'
     
     WHERE ID = '$id'");
    $db->close();
    header("Location: student-profile.php?i=1");
}

if(strlen($newPass1)<3 || strlen($newPass2)<3){
//    $message = _passwords_weak;
//    require_once('msg-fail.php');
    exit;
}

if($newPass1 != $newPass2){
//    $message = _passwords_not_match;
//    require_once('msg-fail.php');
    exit;
}
$hashedPassword = encryptPassword($newPass1);
$db->modify("UPDATE student SET
    firstName = '$nfname',
    lastName = '$nlname',
    studentID = '$nstid',
    email = '$nemail',
    entryYear = '$nyear',
    password = '$hashedPassword'
     
     WHERE ID = '$id'");
$db->close();
header("Location: student-profile.php?i=2");