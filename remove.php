<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
//var_dump($_POST);
//var_dump($_POST['5']);
$db = Db::getInstance();
$term = $_SESSION['currentTerm'];
$year = $_SESSION['currentYear'];

// var_dump($_GET);
foreach ($_GET as $get){
    $db->modify("DELETE FROM `course_term` WHERE courseID = '$get' AND term='$term[0]' AND `year`='$year[0]'");
    $db->modify("DELETE FROM `student_course` WHERE courseID = '$get' AND term='$term[0]' AND `year`='$year[0]'");
    $check_for_delete = $db->query("SELECT * FROM course_term WHERE courseID = '$get'");
    if ($check_for_delete == null){
        $db->modify("DELETE FROM course WHERE ID = '$get'");
    }

}


//for ($i = 1; $i<= count($_POST); $i++){
//    $f = ''.$i;
////    echo $_POST['5'];
//    if (isset($_POST[$i])){
//        echo $i. "<br>";
//    }
//}


//for ($i = 1; $i<= count($_GET); $i++){
//    if(isset($_GET[$i])){
//      echo $_GET[$i];
//     $db->modify("DELETE FROM course WHERE course_id = '$_GET[$i]' ");
//
//    }
//}
$db->close();
header("Location: admin-panel.php");
