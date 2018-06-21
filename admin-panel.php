<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}


$userName = $_SESSION['admin_login'];
$auto_confirm =  $_SESSION['confirmed'][0];
$term = $_SESSION['currentTerm'][0];
$year = $_SESSION['currentYear'][0];
$deptID = $_SESSION['deptID'][0];


$db = Db::getInstance();
$records = $db->query("SELECT ID, course.courseName, course.courseCode,
                        course.courseOccupied, course.courseUnit, 
                        course.courseType FROM course INNER JOIN course_term
                        WHERE course_term.courseID=course.ID 
                        AND course_term.term = '$term' 
                        AND course_term.`year` = '$year' 
                        AND course.deptID = '$deptID' 
                        ORDER BY course.courseName;
                        ");
//var_dump($records);


 if(isset($records)) {
     foreach ($records as $record) {
         $id = $record['ID'];
         $occupied = $db->single_variable("SELECT COUNT(*) FROM student_course where courseID = '$id' AND term = '$term' AND  `year` = '$year'");
         $db->modify("UPDATE `course` SET `courseOccupied`= $occupied[0] WHERE ID = '$id'");
     }
 }
$db->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>سامانه ی پیش ثبت نام گروه کامپیوتر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/snackbar.css">
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#add").click(function () {
                $("#curtain").slideToggle(700);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#18").click(function () {
                $("#abc").slideToggle(700);
            });
        });
    </script>
    <?php
        if (isset($_GET['duplicate'])){
            if ($_GET['duplicate'] == "y"){
                echo "<script> 
                                $(document).ready(function () {
                                window.alert('کد درس تکراری است.');
                }); </script>";
            }
        }

    if (isset($_GET['login']) && $_GET['login'] == true ){
        echo "  <script>
                    $(document).ready(function () {
                         var x = $('#snackbar');
                         x.addClass('show');
                        setTimeout(function(){ x.removeClass('show'); }, 2900);
                    });
                </script>";
        $_GET['login'] = null;
    }




    ?>



</head>

<body class="dir style-1" >
<div id="snackbar"><?=$userName . " خوش آمدید."?></div>

    <nav class="w3-sidenav w3-black w3-card-2 w3-xlarge" onmouseleave="w3_close()"  style="display:none; opacity:0.9">
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
        <div class="w3-center w3-xxlarge" >
            <p>
                پنل مدیریت
            </p>
        </div>
        <div class="w3-row ">
            <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
            <div class=" margin-top-10  w3-col s3 m3 l1 " style="text-align: left;"><a class="w3-btn w3-round" href="admin-logout.php" > خروج</a></div>
            <div class="w3-col l5 m4 w3-hide-small">&nbsp;</div>
            <input type="text" class="margin-top-10 w3-text-black w3-input w3-col l2 m3 " id="myInput" onkeyup="myFunction()" placeholder="جستجوی نام درس">
            <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
        </div>
    </header>
    <div class="w3-row">
        <div class="w3-col l2 m1 w3-hide-small">&nbsp;</div>
        <div class="holder w3-col l8 m10">
    <div  class=" w3-container w3-padding-hor-12 w3-light-grey" >

        <ul class="w3-row  ul-none">
            <div class="w3-col l3 m4  w3-right">
                <div class="w3-btn w3-red w3-round"  id="add">اضافه کردن درس</div>
            </div>
        </ul>
    </div>


    <div id="curtain" class=" w3-container w3-light-grey " >

        <div class="w3-padding-top ">
            <div class=" w3-container mobile" style="width: 70%; margin: auto;">
                <form action="add-course.php" method="post">
                    <p >
                        <input class="w3-input w3-round w3-text-black w3-border margin-top-20 op" type="text" name="c_name"
                               required >
                        <label class="w3-label w3-validate w3-medium w3-right">نام درس</label>
                    </p>

                    <p >
                        <input class="w3-input w3-round w3-text-black w3-border margin-top-20 op" type="text" name="c_code"
                               required >
                        <label class="w3-label w3-validate w3-medium w3-right">کد درس</label>
                    </p>

                    <p >
                        <input class="w3-input w3-round w3-text-black w3-border margin-top-20 op" type="text" name="c_unit"
                               required >
                        <label class="w3-label w3-validate w3-medium w3-right">تعداد واحد</label>
                    </p>


                    <p >

                        <select required class="w3-select w3-input w3-round w3-text-black w3-border margin-top-20 op" name="c_type" id="">
                            <option  value="نظری">نظری</option>
                            <option  value="عملی">عملی</option>
                        </select>
                        <label class="w3-label w3-validate w3-medium w3-right">نوع درس (عملی / نظری)</label>
                    </p>


                    <p>
                        <input type="submit" class="w3-btn w3-btn-block w3-round  margin-top-20 w3-red"
                                value="اضافه">
                    </p>


                </form>
            </div>
        </div>
        <br>
    </div>

    <div  class=" w3-container w3-padding-hor-12 w3-light-grey "  >
        <br>
        <div class="w3-center  w3-padding w3-large"  style=" margin: auto;" >"لیست دروس ارائه شده ترم <?=trim_number($term)?> سال <?=trim_number($year)?>"</div>
        <form action="remove.php" method="get">
            <ul class="w3-row  ul-none w3-padding-hor-12" style="padding-left: 12px;">
                <div class="w3-col l2 m4 ">
                    <input type="submit" class="w3-btn w3-round" id="removeAll" value="حذف دروس انتخاب شده">
                </div>
            </ul>
            <div class=" w3-large w3-padding-hor-24" style="width: 100%; margin: auto;">
                <ul id="myUL" class="w3-ul w3-card-16" style="width:100%">

                    <li class="w3-row  w3-center w3-grey w3-hide-small w3-hide-medium">
                        <div class="w3-col l3  w3-padding-tiny w3-right">نام درس</div>
                        <div class="w3-col l2  w3-padding-tiny w3-right">کد درس</div>
                        <div class="w3-col l2  w3-padding-tiny w3-right">نوع درس</div>
                        <div class="w3-col l1  w3-padding-tiny w3-right">تعداد اخذ</div>
                        <div class="w3-col l1  w3-padding-tiny w3-right">واحد</div>
                        <div class="w3-col l2  w3-hide-small w3-padding-tiny w3-right">ویرایش</div>
                        <div class="w3-col l1  w3-padding-tiny w3-right">حذف</div>
                    </li>

                    <?php if(isset($records)) {
                        foreach ($records as $record) {
                            ?>
                            <li class="w3-row  w3-center w3-hover-sand" style="display: block;" id="<?= $record['ID']; ?>">
                                <div class="w3-col l3  w3-padding-tiny w3-right">
                                    <a style="text-decoration: none;" href="students-by-course.php?courseID=<?= $record['ID'] ?>">
                                        <?=$record['courseName']?>
                                    </a>
                                </div>

                                <div
                                    class="w3-col l2  w3-padding-tiny w3-right "><?= "<span class=' w3-hide-large'>کد درس: </span>" ?> <?= trim_number($record['courseCode']) ?></div>

                                <div
                                    class="w3-col l2  w3-padding-tiny w3-right "><?= "<span class=' w3-hide-large'>نوع درس: </span>" ?> <?= trim_number($record['courseType']) ?></div>

                                <div
                                    class="w3-col l1  w3-padding-tiny w3-right "><?= "<span class=' w3-hide-large'>تعداد اخذ: </span>" ?> <?= trim_number($record['courseOccupied']) ?></div>


                                <div
                                    class="w3-col l1  w3-padding-tiny w3-right "><?= "<span class=' w3-hide-large'>واحد: </span>" ?> <?= trim_number($record['courseUnit']) ?></div>

                                <div class="w3-col l2  w3-padding-tiny  w3-right w3-small">
                                    <a class="w3-btn w3-round w3-orange" href="course-edit.php?c-id=<?= $record['ID'] ?>&c-name=<?= $record['courseName']?>&c-code=<?= $record['courseCode'] ?>&c-unit=<?= $record['courseUnit'] ?>&c-type=<?=$record['courseType']?>" > ویرایش</a>
                                </div>


                                <div class="w3-col l1  w3-padding-tiny  w3-right ">
                                    <?= "<span class=' w3-hide-large'>حذف: </span>" ?>
                                    <input class="w3-check " type="checkbox" name="<?= $record['ID']; ?>"
                                           value="<?= $record['ID']; ?>">
                                </div>

                            </li>

                        <?php }
                                }
                        ?>


                </ul>

            </div>
        </form>
    </div>
    </div> <!-- col asli -->
</div>  <!-- row asli -->


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
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
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

