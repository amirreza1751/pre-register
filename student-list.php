<?php
    require_once ('main.php');
    if (!isset($_SESSION['admin_login'])) {
        header("Location: a-d-m-i-n-l-o-g-i-n.php");
    }
    $db = Db::getInstance();
    $deptID = $_SESSION['deptID'];
    $records = $db->query("SELECT * FROM student WHERE deptID = '$deptID[0]' ORDER BY ID");
//    $confirm = $db->single_variable("SELECT opValue FROM `option-department` WHERE deptID= '$deptID[0]'");
//    $st_id = $_SESSION['stid'];

    $term = $_SESSION['currentTerm'];
    $year = $_SESSION['currentYear'];
    $confirm = $_SESSION['confirmed'];

    $ids = $db->query("SELECT ID FROM student");

    if(is_array($ids)){
        foreach ($ids as $id) {
            $tmp = $id['ID'];
//echo "tmp = " . $tmp . "<br>";
            $units = $db->single_variable("SELECT SUM(courseUnit) AS summation from course  JOIN student_course ON course.ID = student_course.courseID WHERE student_course.studentID = '$tmp' AND student_course.term = '$term[0]' AND  student_course.`year` = '$year[0]' ");
            
            
            if($units[0] == null){
               $units[0] = 0;  
            }
//echo  $units[0] . "<br>";
            
            $summation = $units[0];
            $db->modify("UPDATE student SET takenUnits = '$summation' WHERE ID= '$tmp'");
        }
    }

    $records = $db->query("SELECT * FROM student WHERE deptID = '$deptID[0]' ORDER BY ID");


    $db->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".w3-pale-green").find(".testClass").attr("checked", true);
        });
    </script>

    <title>لیست دانشجویان</title>
</head>
<body style="direction: rtl">

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
    <div class="w3-row ">
        <div class="w3-col l1 m1 w3-hide-small ">&nbsp;</div>
        <div class=" margin-top-10  w3-col s3 m3 l1 " style="text-align: left;"><a class="w3-btn w3-round" href="admin-logout.php" > خروج</a></div>
        <div class="w3-col l7 m4 w3-hide-small">&nbsp;</div>
        <input type="text" class="margin-top-10 w3-text-black w3-input w3-col l2 m3 " id="myInput" onkeyup="myFunction()" placeholder="جستجوی شماره دانشجویی">
        <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
    </div>
</header>


<div class="w3-row">
    <div class="w3-col l1 m1 w3-hide-small">&nbsp;</div>
    <div class="  w3-col l10 m10">
<div  class=" w3-container w3-padding-hor-12 w3-light-grey" >
    <br>
    <div class="w3-center  w3-padding w3-large"  style=" margin: auto;" >"لیست دانشجویان"</div>
    <br>
    <form action="accept-student.php" class="" method="post">
        <ul class="w3-row  ul-none">
            <a href="option-confirm.php" class="   w3-col l2 m4 w3-right  w3-btn <?php if ($confirm[0] == "ON"){echo " w3-green ";} else {echo " w3-red ";}?> w3-round"><?php if ($confirm[0] == "ON"){echo "تایید خودکار روشن است.";} else {echo "تایید خودکار خاموش است.";}?></a>
            <li class="w3-col l8 m4 w3-hide-small w3-right ">&nbsp;</li>
            <input type="submit" class="  w3-col l2 m4 w3-right  w3-btn w3-round" id="acceptAll" value="ذخیره کردن تغییرات">

        </ul>
        <br>
        <div class=" w3-large w3-padding-hor-24" style="width: 100%; margin: auto;">
            <ul id="myUL" class="w3-ul w3-card-16" style="width:100%">

                <li class="w3-row  w3-center w3-grey  w3-hide-small w3-hide-medium">
                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">شماره دانشجویی</div>
                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">نام</div>
                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">نام خانوادگی</div>
                    <div class="w3-col l3  w3-padding-tiny w3-border-green w3-right">ایمیل</div>
                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">سال ورود</div>
                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">واحد</div>
                    <div class="w3-col l2  w3-padding-tiny w3-border-green w3-right">سقف انتخاب واحد</div>
<!--                    <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">ویرایش</div>-->
                    <div class="w3-col l1 w3-padding-tiny w3-border-green w3-right">تایید</div>
                    <div class="w3-col l1 w3-padding-tiny w3-border-green w3-right">حذف</div>
                </li>

                <?php if(isset($records) && is_array($records)) {
                    foreach ($records as $record) {
                        ?>
                        <li class="w3-row  w3-center <?php if ($record['confirmed'] == "ON"){ echo "w3-pale-green"; } ?> " >

                            <div class="w3-col l1   w3-padding-tiny w3-border-green w3-right"><a style="text-decoration: none;" href="courses-by-student.php?studentID=<?= $record['ID']?>&stname=<?= $record['firstName'] ?>&stfamily=<?= $record['lastName'] ?>"><?= $record['studentID'] ?></a></div>
                            <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right"><?= "<span class=' w3-hide-large'>نام: </span>" ?><?= $record['firstName'] ?></div>
                            <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right"><?= "<span class=' w3-hide-large'>نام خانوادگی: </span>" ?><?= $record['lastName'] ?></div>
                            <div class="w3-col l3  w3-padding-tiny w3-border-green w3-right"><?= "<span class=' w3-hide-large'>ایمیل: </span>" ?><?= $record['email'] ?></div>
                            <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right"><?= "<span class=' w3-hide-large'>سال ورود: </span>" ?><?= trim_number($record['entryYear']) ?></div>
                            <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right"><?= "<span class=' w3-hide-large'>واحد: </span>" ?><?= trim_number($record['takenUnits']) ?></div>

                            <div class="w3-col l2  w3-padding-tiny w3-border-green w3-right">
                                <?= "<span class=' w3-hide-large'>سقف انتخاب واحد: </span>" ?>
                                <input style="width: 25%; text-align: center;" type="number" min="0" name="<?="allowedUnit[" .  $record['ID']. "]" ?>  " value="<?= $record['allowedUnit'] ?>">
                            </div>




                            <div class="w3-col l1  w3-padding-tiny w3-border-green w3-right">
                                <?= "<span class=' w3-hide-large'>تایید: </span>" ?>
                                <input class="w3-check testClass" type="checkbox" name="<?="checkBox[" . $record['ID']."]"?>"
                                       value="<?= $record['ID']; ?>">
                            </div>
                            <div class="w3-col l1  w3-padding-tiny  w3-right ">
                                <?= "<span class=' w3-hide-large'>حذف: </span>" ?>
                                <input class="w3-check " type="checkbox" name="<?= "delete[" . $record['ID'] . "]" ?>"
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
