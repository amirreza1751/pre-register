<?php
require_once('main.php');

if(!isset($_POST['stid'])){
    header("Location: login.php");
    exit;
}

$stid = "";
$stid = isset($_POST['stid']) ? $_POST['stid'] : '';
$stid = $_POST['stid'];


$psw = "";
$psw = isset($_POST['psw']) ? $_POST['psw'] : '';
$psw = $_POST['psw'];




$db = Db::getInstance();
$record = $db->first("SELECT * FROM student WHERE studentID='$stid' ");

//$record = $db->connection()->prepare("SELECT ID FROM student WHERE studentID= ?");
//$record->bind_param('s', $stid);
//$record->execute();
//$record->bind_result($test);
//$record = $record->fetch();


if($record == null){
//    $message = _email_not_registered;
//    require_once('msg-fail.php');
    header("Location: login.php?sts=pi");
    exit;
}
else {
    global $config;
    $hashedPassword = encryptPassword($psw);
//    if($hashedPassword == $record['password']){
    if($hashedPassword == $record['password']){
        $_SESSION['stid'] = $record['ID'];
        $_SESSION['stUsername'] = $record['firstName'] . " " . $record['lastName'];
//        $_SESSION['password'] = $record['password'];
//        echo "_SESSION['uname'] = record['userName'] " . $_SESSION['uname'];
        $temp1 = $_SESSION['stid'];

        $_SESSION['confirmed'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN student WHERE `option-department`.deptID=student.deptID and `option-department`.opID=1 AND student.ID='$temp1'");
        $_SESSION['currentTerm'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN student WHERE `option-department`.deptID=student.deptID and `option-department`.opID=2 AND student.ID='$temp1'");
        $_SESSION['currentYear'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN student WHERE `option-department`.deptID=student.deptID and `option-department`.opID=3 AND student.ID='$temp1'");
        $_SESSION['deptID'] = $db->single_variable("SELECT deptID FROM `student` WHERE ID='$temp1'");
        $_SESSION['allowedUnit'] = $db->single_variable("SELECT allowedUnit FROM student WHERE ID = '$temp1 ' ");

        // in ghesmate code miad baraye avalin bar
        // occupied ro baraye dars ha por mikone ke meghdare eshtebah nade.
        // code payin ro migam


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

        // ta inja ^^^^^^



//        var_dump($_settings);
//        echo $_settings['confirmed'][0];

//        $message = _login_welcome;

        header("Location: index.php?userLogin=true");
//        require_once('home.php');
        exit;
    }
    else{
        header("Location: login.php?sts=pi");
//        $message = _password_incorrect;
//        require_once('msg-fail.php');
        exit;
    }
}
