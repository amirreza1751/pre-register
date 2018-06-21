<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$user_name = $_SESSION['admin_login'];
$db = Db::getInstance();
$newEmail = $_POST['newEmail'];
$newPass1 = $_POST['npassword1'];
$newPass2 = $_POST['npassword2'];

if ($newPass1 == null){
    $db->modify("UPDATE admin SET adminEmail = '$newEmail' WHERE adminUserName = '$user_name'");
    echo "a";
    $db->close();
    header("Location: admin-profile.php");
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
$db->modify("UPDATE admin SET adminEmail = '$newEmail', adminPassword = '$hashedPassword'  WHERE adminUserName = '$user_name'");
$db->close();
header("Location: admin-profile.php");