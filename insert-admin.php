<?php
require_once('main.php');
if (isset($_POST)) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $deptID = $_POST['deptID'];


    $db = Db::getInstance();
    $record = $db->first("SELECT * FROM `admin` WHERE adminUserName='$username'");
    if ($record != null) {
//    $message = _already_registered;
        header("Location: admin-profile.php?fail=existingUserName");
//    require_once('msg-fail.php');
        exit;
    }
    
    if (strlen($password1) < 3 || strlen($password2) < 3) {
//    $message = _passwords_weak;
        header("Location: admin-profile.php?fail=passwordsWeak");
//    require_once('msg-fail.php');
        exit;
    }

    if ($password1 != $password2) {
//    $message = _passwords_not_match;
        header("Location: admin-profile.php?fail=passwordsNotMatch");
//    require_once('msg-fail.php');
        exit;
    }

    $hashedPassword = encryptPassword($password1);
    $db->insert("INSERT INTO admin (adminUserName, adminPassword, deptID, adminEmail) VALUES ('$username', '$hashedPassword', '$deptID', '$email')");
}
header("Location: admin-profile.php?insert=successful");