<?php
require_once ('main.php');
$db = Db::getInstance();
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}

if (isset($_GET['studentID'])){
    $term = $_SESSION['currentTerm'][0];
    $year = $_SESSION['currentYear'][0];
    $id = $_GET['studentID']; // id e db e. shomare daneshjuyi nist.
    $fname = $_GET['stname'];
    $lname = $_GET['stfamily'];
    $courses_taken_by_student = $db->query("SELECT course.courseName, course.courseCode FROM course INNER JOIN student_course ON student_course.courseID=course.ID WHERE student_course.studentID = '$id' AND student_course.term = '$term' AND student_course.`year` = '$year'");
    $information = $fname . " " . $lname;

}
?>
<html lang="en">
<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>سامانه ی پیش ثبت نام گروه کامپیوتر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>
</head>
<body class="dir style-1">
<nav class="w3-sidenav w3-black w3-card-2 w3-xlarge" onmouseleave="w3_close()" style="display:none; opacity:0.9">
    <a href="javascript:void(0)" onclick="w3_close()"
       class="w3-closenav w3-xlarge w3-right w3-padding-right w3-hover-text-red w3-hover-none" >&times;</a><br>
    <a href="admin-panel.php" class="w3-hover-text-red w3-hover-none">لیست دروس</a>
    <a href="student-list.php" class="w3-hover-text-red w3-hover-none">لیست دانشجویان</a>
    <a href="settings.php" class="w3-hover-text-red w3-hover-none">تنظیمات</a>
    <a href="admin-profile.php" class="w3-hover-text-red w3-hover-none">حساب کاربری</a>
    <a href="query.php" class="w3-hover-text-red w3-hover-none">پرس و جو</a>
    <a href="report.php" class="w3-hover-text-red w3-hover-none">گزارش گیری</a>
</nav>

<header class="w3-container w3-red w3-padding-bottom">
    <span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
    <div class="w3-center w3-xxlarge">
        <p>
            پنل مدیریت
        </p>
    </div>
    <a href="admin-logout.php" class="w3-btn w3-left w3-round"> خروج</a>
</header>


<div  class=" w3-container w3-padding-hor-12 w3-card-16 list-holder w3-light-grey" style="margin: 5% auto;">
    <br>
    <div class="w3-center  w3-padding w3-large"  style=" margin: auto;" >"لیست دروس انتخاب شده توسط دانشجو"</div>
    <div class=" w3-row" style="direction: rtl">
<!--        <div class="w3-col l2 m2 s2 w3-padding-right w3-right">&nbsp;</div>-->
        <div class="w3-col l10 m8 s9  w3-padding-right w3-right">
            <p>ترم جاری: <?=trim_number($term)?></p>
            <p>سال: <?=trim_number($year)?></p>
            <p> <?= " نام و نام خانوادگی: " . $information ?></p>
            <p>تعداد درس های گرفته شده: <?=trim_number(sizeof($courses_taken_by_student))?></p>
        </div>
        <div class="w3-col l1 m3 s3  w3-right " style="text-align: left;"><a class="w3-btn w3-round" href="student-list.php" >بازگشت</a></div>

    </div>
    <br>


        <div class="w3-padding w3-large w3-padding-hor-24 " style="  margin: auto;">
            <ul class="w3-ul w3-card-16" style="width:100%">

                <li class="w3-row  w3-center w3-grey">
                    <div class="w3-col l6 M6 S6 w3-padding-tiny w3-right">نام درس</div>
                    <div class="w3-col l6 M6 S6 w3-padding-tiny w3-right">کد درس</div>
                </li>

                <?php if(isset($courses_taken_by_student)) {
                    foreach ($courses_taken_by_student as $record) {
                        ?>
                        <li class="w3-row  w3-center  w3-hover-sand ">

                            <div class="w3-col l6 M6 S6 w3-padding-tiny  w3-right"><?= $record['courseName'] ?></div>
                            <div class="w3-col l6 M6 S6 w3-padding-tiny  w3-right"><?= trim_number($record['courseCode'])  ?></div>

                        </li>

                    <?php }
                }
//                var_dump($courses_taken_by_student);
                ?>


            </ul>

        </div>
</div>




<script>
    function w3_open() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
    }
    function w3_close() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    }
</script>

</body>
</html>

