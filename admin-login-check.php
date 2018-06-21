<?php
require_once('main.php');

if(!isset($_POST['uname'])){
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
    exit;
}

$stid = "";
$stid = isset($_POST['uname']) ? $_POST['uname'] : '';
$stid = $_POST['uname'];


$psw = "";
$psw = isset($_POST['pass']) ? $_POST['pass'] : '';
$psw = $_POST['pass'];




$db = Db::getInstance();
$record = $db->first("SELECT * FROM admin WHERE adminUserName='$stid' ");

//$record = $db->connection()->prepare("SELECT * FROM admin WHERE adminUserName= ? ");
//$record->bind_param('s', $stid);
//$record->execute();
//$record = $record->get_result();
//$record = $record->fetch_assoc();



if($record == null){
//    $message = _email_not_registered;
    header("Location: a-d-m-i-n-l-o-g-i-n.php?asts=anr");
//    require_once('msg-fail.php');
    exit;
}
else {

    $hashedPassword = encryptPassword($psw);
    if($hashedPassword == $record['adminPassword']){
//    if($psw == $record['adminPassword']){
        $_SESSION['admin_login'] = $record['adminUserName'];
        $_SESSION['admin_password'] = $record['adminPassword'];
        $_SESSION['adminID'] = $record['ID'];
        $_SESSION['timestamp'] = time();
        
        
        
        
//        echo "_SESSION['uname'] = record['userName'] " . $_SESSION['uname'];

//        $message = _login_welcome;


        $temp1 = $_SESSION['admin_login'];
        $_SESSION['confirmed'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=1 AND admin.adminUserName='$temp1'");
        $_SESSION['currentTerm'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=2 AND admin.adminUserName='$temp1'");
        $_SESSION['currentYear'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=3 AND admin.adminUserName='$temp1'");
        $_SESSION['maxUnit'] = $db->single_variable("SELECT opValue FROM `option-department` INNER JOIN admin WHERE `option-department`.deptID=admin.deptID and `option-department`.opID=4 AND admin.adminUserName='$temp1'");
        $_SESSION['deptID'] = $db->single_variable("SELECT deptID FROM admin WHERE admin.adminUserName='$temp1'");




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






//        var_dump($_SESSION);
        header("Location: admin-panel.php?login=true");
//        require_once('home.php');
        exit;
    }
    else{
//        $message = _password_incorrect;
        header("Location: a-d-m-i-n-l-o-g-i-n.php?asts=anr");
//        require_once('msg-fail.php');
        exit;
    }
}
