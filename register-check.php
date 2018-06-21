<?php
require_once('main.php');
if (!isset($_POST['fname'])) {
    header("Location: login.php");
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$st_id_reg = $_POST['st-id-reg'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$deptID = $_POST['dept-id'];
$entryYear = $_POST['entry-year'];

$time = getCurrentDateTime();

$db = Db::getInstance();
//$record = $db->first("SELECT * FROM student WHERE studentID='$st_id_reg'");

$record = $db->connection()->prepare("SELECT ID FROM student WHERE studentID= ?");
$record->bind_param('s', $st_id_reg);
$record->execute();
$record->bind_result($test);
$record = $record->fetch();

if($record != null){
//    $message = _already_registered;
    header("Location: login.php?sts=ar");
//    require_once('msg-fail.php');
    exit;
}

if($email == null && $password1 == null && $password2 == null && $name == null && $st_id_reg == null){
//    $message = _all_fiels_empty;
    header("Location: login.php?sts=afae");
//    require_once('msg-fail.php');
    exit;
}

if(strlen($password1)<3 || strlen($password2)<3){
//    $message = _passwords_weak;
    header("Location: login.php?sts=pw");
//    require_once('msg-fail.php');
    exit;
}

if($password1 != $password2){
//    $message = _passwords_not_match;
    header("Location: login.php?sts=pnm");
//    require_once('msg-fail.php');
    exit;
}

$hashedPassword = encryptPassword($password1);

$confirm = $db->single_variable("SELECT opValue FROM `option-department` WHERE deptID='$deptID' AND opID=1");
//$confirm = $db->connection()->prepare("SELECT opValue FROM `option-department` WHERE deptID = ? AND opID = ?");
//$opID = 1;
//$confirm->bind_param('ii', $deptID, $opID);
//$confirm->execute();
//$confirm = $confirm->bind_result();
//$confirm = $confirm->fetch_array();


$max_unit = $db->single_variable("SELECT opValue FROM `option-department` WHERE deptID='$deptID' AND opID=4");
//$max_unit = $db->connection()->prepare("SELECT opValue FROM `option-department` WHERE deptID= ? AND opID= ?");
//$opID = 4;
//$max_unit->bind_param('ii', $deptID, $opID);
//$max_unit->execute();
//$max_unit = $max_unit->get_result();
//$max_unit = $max_unit->fetch_array();


//echo $confirm[0];
if ($confirm[0] == "ON"){
//    $db->insert("INSERT INTO student (studentID, password, firstName, lastName, email , confirmed, deptID, entryYear, registerTime, allowedUnit)
// VALUES                           ('$st_id_reg', '$hashedPassword', '$fname', '$lname', '$email', 'ON', '$deptID', '$entryYear', '$time', '$max_unit[0]')");
    $confirm = "ON";
    $insert = $db->connection()->prepare("INSERT INTO student (studentID, password, firstName, lastName, email , confirmed, deptID, entryYear, registerTime, allowedUnit)
    VALUES                           (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param('ssssssissi',$st_id_reg, $hashedPassword, $fname, $lname, $email, $confirm, $deptID, $entryYear, $time, $max_unit[0]);
    $insert->execute();



}else if ($confirm[0] == "OFF"){
//    $db->insert("INSERT INTO student (studentID, password, firstName, lastName, email , confirmed, deptID, entryYear, registerTime, allowedUnit)
// VALUES                           ('$st_id_reg', '$hashedPassword', '$fname', '$lname', '$email', 'OFF','$deptID', '$entryYear', '$time', '$max_unit[0]')");

    $confirm = "OFF";
    $insert = $db->connection()->prepare("INSERT INTO student (studentID, password, firstName, lastName, email , confirmed, deptID, entryYear, registerTime, allowedUnit)
    VALUES                           (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param('ssssssissi',$st_id_reg, $hashedPassword, $fname, $lname, $email, $confirm, $deptID, $entryYear, $time, $max_unit[0]);
    $insert->execute();

}

//$message = _successfully_registered;
//require_once('msg-success.php');
//exit;
$db->close();
 header("Location: login.php?sts=sr");
?>