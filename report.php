<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$db = Db::getInstance();
$deptID = $_SESSION['deptID'][0];
$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];
$records = $db->query("SELECT ID, course.courseName FROM course INNER JOIN course_term
                        WHERE course_term.courseID=course.ID 
                        AND course_term.term = '$term' 
                        AND course_term.`year` = '$year' 
                        AND course.deptID = '$deptID' 
                        ORDER BY course.courseName
                        ");

if (isset($_POST['related'])){
    $related = $db->query("SELECT Name1,Name2,COUNT(*) AS tedad from (SELECT
                            s1.studentID as sID1,
                            s1.courseID as cID1,
                            s2.studentID as sID2,
                            s2.courseID as cID2
                            FROM
                            student_course AS s1 ,
                            student_course AS s2
                            WHERE s1.courseID != s2.courseID 
                            AND s1.studentID = s2.studentID 
                            and s1.term = '$term' and s1.`year` = '$year' and s2.term = '$term' and s2.`year` = '$year') as tb1,(SELECT
                            c1.ID as ID1,
                            c1.courseName as Name1,
                            c2.ID as ID2,
                            c2.courseName as Name2
                            FROM
                            course AS c1 ,
                            course AS c2 WHERE c1.deptID = '$deptID' AND c2.deptID='$deptID') as tb2
                            WHERE cID1 = ID1 AND cID2 = ID2
                            GROUP BY name1,name2
                            ORDER BY tedad DESC , Name1 ASC");
}


if(isset($_POST['c1'])) {

    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];

    $course1 = $db->single_variable("SELECT courseName FROM course WHERE ID = '$c1'");
    $course2 = $db->single_variable("SELECT courseName FROM course WHERE ID = '$c2'");
    $course3 = $db->single_variable("SELECT courseName FROM course WHERE ID = '$c3'");

    $threeCourses = $db->query("SELECT firstName, lastName, studentID FROM student WHERE ID IN(	
SELECT DISTINCT student_course.studentID
FROM student_course, student_course AS sc1, student_course AS sc2, student_course AS sc3
WHERE student_course.studentID=sc1.studentID 
	AND student_course.studentID=sc2.studentID
	AND student_course.studentID=sc3.studentID
	AND sc1.courseID='$c1'
	AND sc2.courseID='$c2'
	AND sc3.courseID='$c3'
	AND sc1.term='$term'
	AND sc2.term='$term'
	AND sc3.term='$term'
	AND sc1.`year`='$year'
	AND sc2.`year`='$year'
	AND sc3.`year`='$year'
)");
}

if (isset($_POST['relatedCourse'])){
    $course = $_POST['relatedCourse'];
    $course_taki = $db->single_variable("SELECT courseName FROM course WHERE ID = '$course'");
    $relatedCourse = array();
    $relatedCourse = $db->query("SELECT course.courseName, course.courseCode, c1.courseID AS otherCourses , COUNT(c1.courseID) AS tedad
FROM student_course, student_course AS c1
JOIN course ON course.ID = c1.courseID
WHERE
	student_course.studentID = c1.studentID
	AND student_course.courseID != c1.courseID
	AND student_course.courseID = '$course'
	AND c1.term = '$term'
	AND c1.`year` = '$year'
	GROUP BY otherCourses
	ORDER BY tedad DESC , courseName ASC
");
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>گزارش گیری</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#tab1").click(function () {

                $(this).css("background-color", "#000000");
                $("#tab2").css("background-color", "#d6d6c2");
                $("#tab3").css("background-color", "#d6d6c2");

                $("#tab22").hide();
                $("#tab33").hide();
                $("#tab11").fadeIn();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#tab2").click(function () {

                $(this).css("background-color", "#000000");
                $("#tab1").css("background-color", "#d6d6c2");
                $("#tab3").css("background-color", "#d6d6c2");

                $("#tab11").hide();
                $("#tab33").hide();
                $("#tab22").fadeIn();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#tab3").click(function () {

                $(this).css("background-color", "#000000");
                $("#tab1").css("background-color", "#d6d6c2");
                $("#tab2").css("background-color", "#d6d6c2");

                $("#tab11").hide();
                $("#tab22").hide();
                $("#tab33").fadeIn();
            });
        });
    </script>

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

    <div class="w3-row w3-section ">


        <div class="w3-col l2 w3-hide-small">&nbsp;</div>
        <div class="w3-col l8 w3-light-grey w3-card-16" style="padding-top: 30px; padding-bottom: 30px;">
            <div class="w3-row ">

                <p class="w3-large w3-center">"گزارش گیری"</p>
                <br>
                <div class="w3-row">
                    <div class="w3-col l3">&nbsp;</div>
                    <div class="w3-col l6 w3-left-align">
                        <span id="tab3" class="w3-btn w3-round" style="background-color: #d6d6c2; ">گزارش سه</span>
                        <span id="tab2" class="w3-btn w3-round" style="background-color: #d6d6c2; ">گزارش دو</span>
                        <span id="tab1" class="w3-btn w3-round" style="background-color: #000000; ">گزارش یک</span>
                    </div>
                </div>

                <div class="w3-col l3 w3-hide-small">&nbsp;</div>
                <div class="w3-col l6 w3-border  w3-center " id="tab11" style="height: 220px;">
                    <br>
                    <br>

                    <form action="report.php" method="post">
                        <label for="least">حداقل تداخل: </label>
                        <input type="number" name="least" min="0" value="<?php if (isset($_POST['least'])) echo $_POST['least']; else echo 0 ;?>" style="width: 40px">
                        <br>
                        <br>
                        <br>
                            <input type="submit" name="related"  class="w3-btn w3-round" value="درس های دو به دو مرتبط">
                        </form>

                </div>
                <div class="w3-col l6 w3-border  w3-center" id="tab22" style="display: none; height: 220px;">
                    <br>
                    <br>

                    <form action="report.php" method="post">
                        <div class="w3-col l2 w3-hide-medium w3-hide-small">&nbsp;</div>
                        <select name="relatedCourse" id="" required class="w3-select w3-border w3-col l8">
                            <option value="" disabled selected> <?php if (isset($_POST['relatedCourse'])) echo $course_taki[0]; else echo "نام درس"?> </option>
                            <?php
//                            var_dump($records);
                            foreach ($records as $record) {
                                ?>
                                <option value="<?= $record['ID'] ?>"><?= $record['courseName'] ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <br>
                        <br>
                        <p>
                            <input type="submit" class="w3-btn w3-round" value="درس های مرتبط">
                        </p>
                    </form>
                </div>

<!--            <div class="w3-col l1 w3-hide-small">&nbsp;</div>-->
            <div class="w3-col l6 w3-border  w3-center" id="tab33" style="display: none; height: 220px;">
                <form action="report.php" method="post" >
                    <br>
                    <p>دانشجویانی که سه درس را با هم گرفته اند</p>
                    <br>
                    <div class="w3-row">
                        <div class="w3-col l4">
                            <select name="c1" id="" required class="w3-select w3-border">
                                <option value="" disabled selected> <?php if (isset($_POST['c1'])){echo $course1[0];} else echo "درس سوم" ?> </option>
                                <?php
                                //                            var_dump($records);
                                foreach ($records as $record) {
                                    ?>
                                    <option value="<?= $record['ID'] ?>"> <?= $record['courseName']?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-col l4">
                            <select name="c2" id="" required class="w3-select w3-border">
                                <option value="" disabled selected > <?php if (isset($_POST['c2'])){echo $course2[0];} else echo "درس دوم" ?> </option>
                                <?php
                                //                            var_dump($records);
                                foreach ($records as $record) {
                                    ?>
                                    <option value="<?= $record['ID'] ?>"><?= $record['courseName'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-col l4">
                            <select name="c3" id="" required class="w3-select w3-border">
                                <option value="" disabled selected> <?php if (isset($_POST['c3'])){echo $course3[0];} else echo "درس اول" ?> </option>
                                <?php
                                //                            var_dump($records);
                                foreach ($records as $record) {
                                    ?>
                                    <option value="<?= $record['ID'] ?>"><?= $record['courseName'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-col l3 w3-hide-small">&nbsp;</div>
                        <div class="w3-col l6  w3-center">
                            <input type="submit" class="w3-btn w3-round" value="مشاهده">
                        </div>

                    </div>
                </form>
            </div>
            </div>
        </div>
        <?php
//            if (isset($_GET['report'])){
//                for ($i=0; $i < sizeof($_GET)-1; $i++){
//                    var_dump($_GET[$i]);
//                }
//            }


        ?>
    </div>
<?php
if (isset($_POST['related']) && is_array($related)){
//    var_dump($related);
    ?>

    <div class="w3-row ">

        <div class="w3-col l2 w3-hide-small">&nbsp;</div>
        <div class="w3-col l8 " style="padding-top: 30px; padding-bottom: 30px;">

            <p class="w3-large w3-center"> "درس های دو به دو مرتبط" </p>
            <br>
            <table class="w3-table w3-striped margin-top-20 w3-border w3-card-16" >
                <tr>
                    <th width="20" style="direction: rtl!important; text-align: center!important;">شماره</th>
                    <th style="direction: rtl!important; text-align: center!important;">درس اول</th>
                    <th style="direction: rtl!important; text-align: center!important;">درس دوم</th>
                    <th style="direction: rtl!important; text-align: center!important;">تعداد</th>
                </tr>
                <?php
                $i1=1;
                foreach ($related as $temp){

                    if($temp['tedad'] < $_POST['least']){
                        break;
                    }

                    ?>
                    <tr>
                        <td width="20" style="direction: rtl!important; text-align: center!important;"><?=$i1++?></td>
                        <td style="direction: rtl!important; text-align: center!important;"><?=$temp['Name1']?></td>
                        <td style="direction: rtl!important; text-align: center!important;"><?=$temp['Name2']?></td>
                        <td style="direction: rtl!important; text-align: center!important;"><?=$temp['tedad']?></td>
                    </tr>

                <?php } ?>

            </table>
        </div>
    </div>

<?php } else if (isset($_POST['c1']) && is_array($threeCourses)){
//    var_dump($threeCourses);
    ?>
<div class="w3-row ">


    <div class="w3-col l2 w3-hide-small">&nbsp;</div>
    <div class="w3-col l8 " style="padding-top: 30px; padding-bottom: 30px;">

        <p class="w3-large w3-center"> "دانشجویانی که سه درس را با هم گرفته اند." </p>
        <br>
        <table class="w3-table w3-striped margin-top-20 w3-border  w3-card-16" >
            <tr>
                <th width="20" style="direction: rtl!important; text-align: center!important;">شماره</th>
                <th style="direction: rtl!important; text-align: center!important;">نام</th>
                <th style="direction: rtl!important; text-align: center!important;">نام خانوادگی</th>
                <th style="direction: rtl!important; text-align: center!important;">شماره دانشجویی</th>
            </tr>
            <?php
            $i2=1;
            foreach ($threeCourses as $temp2){  ?>
                <tr>
                    <td width="20" style="direction: rtl!important; text-align: center!important;"><?=$i2++?></td>
                    <td style="direction: rtl!important; text-align: center!important;"><?=$temp2['firstName']?></td>
                    <td style="direction: rtl!important; text-align: center!important;"><?=$temp2['lastName']?></td>
                    <td style="direction: rtl!important; text-align: center!important;"><?=$temp2['studentID']?></td>
                </tr>
            <?php  } ?>

            </table>
        </div>
    </div>
<?php } else if (isset($_POST['relatedCourse']) && is_array($relatedCourse)){
//    var_dump( $relatedCourse);
    ?>
<div class="w3-row ">


    <div class="w3-col l2 w3-hide-small">&nbsp;</div>
    <div class="w3-col l8 " style="padding-top: 30px; padding-bottom: 30px;">

            <p class="w3-large w3-center">"درس های مرتبط با <?= $course_taki[0] ?> " </p>
            <br>
            <table class="w3-table w3-striped margin-top-20 w3-border  w3-card-16" >
                <tr>
                    <th width="20" style="direction: rtl!important; text-align: center!important;">شماره</th>
                    <th style="direction: rtl!important; text-align: center!important;">نام درس</th>
                    <th style="direction: rtl!important; text-align: center!important;">کد درس</th>
                    <th style="direction: rtl!important; text-align: center!important;">تعداد</th>
                </tr>
                <?php
                $i3=1;
                 foreach ($relatedCourse as $temp3){  ?>
                            <tr>
                                <td width="20" style="direction: rtl!important; text-align: center!important;"><?=$i3++?></td>
                                <td style="direction: rtl!important; text-align: center!important;"><?=$temp3['courseName']?></td>
                                <td style="direction: rtl!important; text-align: center!important;"><?=$temp3['courseCode']?></td>
                                <td style="direction: rtl!important; text-align: center!important;"><?=$temp3['tedad']?></td>
                            </tr>
                <?php  } ?>
                </table>

        </div>
    </div>

<?php    } ?>


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