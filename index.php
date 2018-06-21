<?php
require_once ('main.php');


if(!isset($_SESSION['stid'])){
    header("Location: login.php");
}

$db = Db::getInstance();
$id = $_SESSION['stid'];
$userName = $_SESSION['stUsername'];

$isConfirmed = $db->single_variable("SELECT confirmed FROM  student WHERE student.ID = '$id'");

if(!$isConfirmed[0]){
    header("Location: login.php");
}

$auto_confirm =  $_SESSION['confirmed'][0];
$term =  $_SESSION['currentTerm'][0];
$year =  $_SESSION['currentYear'][0];
$deptID = $_SESSION['deptID'][0];
$allowedUnit = $_SESSION['allowedUnit'][0];
$allowedUnit = $allowedUnit + 0;

$records = $db->query("SELECT ID, course.courseName, course.courseCode,
                        course.courseOccupied, course.courseUnit, 
                        course.courseType FROM course INNER JOIN course_term
                        WHERE course_term.courseID=course.ID 
                        AND course_term.term = '$term' 
                        AND course_term.`year` = '$year' 
                        AND course.deptID = '$deptID' 
                        ORDER BY course.courseName;");




$taken_course_id = $db-> query("SELECT * FROM student_course WHERE studentID='$id' AND term = '$term' AND  `year` = '$year'");
$units = $db->single_variable("SELECT SUM(courseUnit) from course  JOIN student_course ON course.ID = student_course.courseID WHERE student_course.studentID = '$id' AND student_course.term = '$term' AND  student_course.`year` = '$year' ;");


if (isset($records)) {
    foreach ($records as $record) {
        $id = $record['ID'];
        $occupied = $db->single_variable("SELECT COUNT(*) FROM student_course where courseID = '$id' AND term = '$term' AND  `year` = '$year'");
        $db->modify("UPDATE `course` SET `courseOccupied`= $occupied[0] WHERE ID = '$id'");
    }
}



//var_dump($taken_course_id);
if (is_null($units[0])){
    $units[0] = 0;
}
$db->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>خانه | خوش آمدید.</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/snackbar.css">
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".w3-pale-green").find("input").attr("checked", true);
        });
    </script>
    <?php
        if (isset($_GET['userLogin']) && $_GET['userLogin'] == true ){
            echo "  <script>
            $(document).ready(function () {
                var x = $('#snackbar2');
                x.addClass('show');
                setTimeout(function(){ x.removeClass('show'); }, 2900);
            });
        </script>";
            $_GET['userLogin'] = null;
        }

    if (isset($_GET['sts'])){
        if ($_GET['sts'] == "na"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('مدیر گروه امکان پیش ثبت نام را برای شما غیر فعال نموده است.');
                }); </script>";
        }
    }
    ?>

</head>
<body class="dir style-1">
<div id="snackbar2" style="direction: rtl;"><?=$userName . " خوش آمدید."?></div>



<nav class="w3-sidenav w3-black w3-card-2 w3-xlarge" onmouseleave="w3_close()"  style="display:none; opacity:0.9">
    <a href="javascript:void(0)" onclick="w3_close()"
       class="w3-closenav w3-xlarge w3-right w3-padding-right w3-hover-text-red w3-hover-none" >&times;</a><br>
    <a href="index.php" class="w3-hover-text-red w3-hover-none" style="margin-top: 5px;">لیست دروس</a>
    <a href="student-profile.php" class="w3-hover-text-red w3-hover-none">نمایش مشخصات</a>
    <span onclick="document.getElementById('id01').style.display='block'" class="w3-hover-text-red w3-hover-none pointer" >درباره ی سازنده</span>
</nav>

<header class="w3-container w3-blue w3-padding-bottom w3-right-align">
    <span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
    <div class="w3-center w3-xxlarge" >
        <p>
            پنل دانشجو
        </p>
    </div>
    <div class="w3-row ">
        <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
        <div class=" margin-top-10  w3-col s3 m3 l1 " style="text-align: left;"><a href="logout.php" class="w3-btn w3-round" > خروج</a></div>
        <div class="w3-col l5 m4 w3-hide-small">&nbsp;</div>
        <input type="text" class="margin-top-10 w3-text-black w3-input w3-col l2 m3 " id="myInput2" onkeyup="myFunction()" placeholder="جستجوی نام درس">
        <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
    </div>
</header>







<div class="w3-row">
    <div class="w3-col l2 m1 w3-hide-small">&nbsp;</div>
    <div class="holder w3-col l8 m10">
        <div  class=" w3-container w3-padding-hor-12 w3-light-grey">
            <br>
            <div class="w3-center  w3-padding w3-large" >"لیست دروس ارائه شده برای انتخاب واحد"</div>
            <div class="w3-col l4 w3-hide-medium">&nbsp;</div>
            <div class=" w3-row" style="direction: rtl">
                <div class="w3-col l4 w3-padding-right w3-right">
                    <p >مجموع واحد های انتخابی شما: <?=trim_number($units[0])?></p>
                    <p class="<?php if (isset($_GET['unit']))if ($_GET['unit']>$allowedUnit) {echo "w3-text-red";}?>">سقف انتخاب واحد: <?=trim_number($allowedUnit)?></p>
                </div>
                <div class="w3-col l4 w3-padding-right">
                    <p>ترم جاری: <?=trim_number($term)?></p>
                    <p>سال: <?=trim_number($year)?></p>
                </div>
            </div>
            <br>

            <form action="take-unit.php" method="post">
                <input type="submit" class="w3-left w3-margin-left w3-btn w3-round" id="removeAll" value="اخذ / حذف">
                <br>
                <div class="w3-padding w3-large w3-padding-hor-24" style="width: 100%; margin: auto;">
                    <ul class="w3-ul w3-card-16" id="myUL2" style="width:100%">

                        <li class="w3-row  w3-center w3-grey w3-hide-small w3-hide-medium">
                            <div class="w3-col l3 w3-padding-tiny w3-right">نام درس</div>
                            <div class="w3-col l2 w3-padding-tiny w3-right">کد درس</div>
                            <div class="w3-col l2 w3-padding-tiny w3-right">نوع درس</div>
                            <div class="w3-col l2 w3-padding-tiny w3-right">تعداد اخذ</div>
                            <div class="w3-col l1 w3-padding-tiny w3-right">واحد</div>
                            <div class="w3-col l2 w3-padding-tiny w3-right">انتخاب</div>
                        </li>

                        <?php if(isset($records)) {
                            foreach ($records as $record) {
                                ?>
                                <li class="w3-row  w3-center    <?php if( isset($taken_course_id)) { foreach ($taken_course_id as $tci){ if($record['ID'] == $tci['courseID']){ echo "w3-pale-green";}}}?>          " id="<?= $record['ID']; ?>">

                                    <div class="w3-col l3 w3-padding-tiny  w3-right">
                                            <?= $record['courseName'] ?>
                                    </div>
                                    <div class="w3-col l2 w3-padding-tiny  w3-right">
                                        <?= "<span class=' w3-hide-large'>کد درس: </span>" ?>
                                        <?= trim_number($record['courseCode'])  ?>
                                    </div>

                                    <div class="w3-col l2 w3-padding-tiny  w3-right">
                                        <?= "<span class=' w3-hide-large'>نوع درس: </span>" ?>
                                        <?= trim_number($record['courseType'])  ?>
                                    </div>

                                    <div class="w3-col l2 w3-padding-tiny  w3-right">
                                        <?= "<span class=' w3-hide-large'>تعداد اخذ: </span>" ?>
                                        <?= trim_number ($record['courseOccupied']) ?>
                                    </div>

                                    <div class="w3-col l1 w3-padding-tiny  w3-right">
                                        <?= "<span class=' w3-hide-large'>تعداد واحد: </span>" ?>
                                        <?= trim_number($record['courseUnit']) ?>
                                    </div>

                                    <div class="w3-col l2 w3-padding-tiny  w3-right">
                                        <input class="w3-check" type="checkbox" name="<?= $record['ID']; ?>"
                                               value="<?= $record['ID']; ?>" >
                                    </div>

                                </li>

                            <?php }
                        }
                        ?>


                    </ul>

                </div>
            </form>
        </div>
        </div>
    </div>


<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-8">
        <header class="w3-container w3-teal">
        <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topleft w3-padding-ver-12 w3-xlarge w3-hover-grey pointer">&times;</span>
            <h2>درباره ی سازنده...</h2>
        </header>
        <div class="w3-container padding-20">
            <p>
                <span class="w3-text-blue">طراحی ظاهر و رابط کاربری: </span>
            </p>
            <p class="w3-center"> امیررضا دشتی با همکاری محمد پشم فروش</p>
            <hr>
            <p>
                <span class="w3-text-blue">برنامه نویسی سمت سرور: </span>
            </p>
            <p class="w3-center"> امیررضا دشتی با همکاری فرزاد رحیم خانیان</p>
            <hr>
            <p>
                <span class="w3-text-blue">راه های ارتباط با ما: </span>
            </p>
            <br>
            <p class="w3-center">
                <p class="w3-center w3-rightbar">
                        <span> امیررضا دشتی: </span>
                        <br>
                        <span> ایمیل: dashti.amir2752@gmail.com</span>
                        <br>
                        <span> شماره تماس: 09126774496</span>
                        <br>
                        <span> لینک تلگرام: <a  style="direction: ltr" href="https://t.me/Amirak">amirak@</a></span>
                </p>
            <hr>
                <p class="w3-center w3-rightbar">
                    <span> فرزاد رحیم خانیان: </span>
                    <br>
                    <span> ایمیل: farzad.u235@gmail.com</span>
                    <br>
                    <span> شماره تماس: 09397449800</span>
                    <br>
                    <span> لینک تلگرام: <a  style="direction: ltr" href="https://t.me/Leviathann">Leviathann@</a></span>
                </p>
            <hr>
                <p class="w3-center w3-rightbar">
                    <span> محمد پشم فروش: </span>
                    <br>
                    <span> ایمیل: Pashmforoosh75@yahoo.com</span>
                    <br>
                    <span> شماره تماس: 09029902929</span>
                    <br>
                    <span> لینک تلگرام: <a  style="direction: ltr" href="https://t.me/MR_MP75">MR_MP75@</a></span>
                </p>
            </p>

        </div>
        <footer class="w3-container w3-teal w3-center">
            <p>تمامی حقوق محفوظ می باشد.</p>
        </footer>
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


<script>
    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL2");
        li = ul.getElementsByTagName("li");
        for (i = 1; i < li.length; i++) {
            a = li[i].childNodes[1];
            if (a.innerText.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>



</body>
</html>


<?php //if ($record['active']){ echo "w3-pale-green"; } ?><!-- -->