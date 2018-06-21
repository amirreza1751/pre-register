<?php
    require_once ('main.php');
if (!isset($_SESSION['stid'])) {
    header("Location: login.php");
    exit;
}
    $db = Db::getInstance();
    $id = $_SESSION['stid'];

    $student_info = $db->first("SELECT * FROM student WHERE ID = '$id'");


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>نمایش مشخصات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>خانه | خوش آمدید.</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="style-1" style="direction: rtl;">

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
<!--        <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>-->
        <div class=" margin-top-10 w3-col s3 m2 l1 " style="text-align: left;"><a href="logout.php" class="w3-btn w3-round"> خروج</a></div>
        <div class="w3-col l5 m4 w3-hide-small">&nbsp;</div>
<!--        <input type="text" class="margin-top-10 w3-text-black w3-input w3-col l2 m3 " id="myInput2" onkeyup="myFunction()" placeholder="جستجوی نام درس">-->
        <div class="w3-col l2 m1 w3-hide-small ">&nbsp;</div>
    </div>
</header>




<div class="w3-row">
    <div class="w3-col l4 m3 w3-hide-small">&nbsp;</div>
    <div class="holder w3-col l4 m6">

<div  class=" w3-container w3-padding-hor-12 w3-light-grey w3-round">
    <br>
    <div class="w3-center  w3-padding w3-large"   >"ویرایش اطلاعات شخصی"</div>
    <br>
    <form action="student-profile-check.php" method="post">
        

        <p>
            <input value="<?=$student_info['firstName']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                   name="nfname" >
            <label class="w3-label w3-validate w3-medium w3-right">نام</label>
        </p>
        <br>

        <p>
            <input value="<?= $student_info['lastName']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                   name="nlname" >
            <label class="w3-label w3-validate w3-medium w3-right">نام خانوادگی</label>
        </p>
        <br>

        <p>
            <input value="<?=$student_info['studentID']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                   name="nstid" >
            <label class="w3-label w3-validate w3-medium w3-right">شماره دانشجویی</label>
        </p>
        <br>

        <p>
            <input value="<?=$student_info['email']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                   name="nemail" >
            <label class="w3-label w3-validate w3-medium w3-right">ایمیل</label>
        </p>
        <br>

        <p>
            <input value="<?=$student_info['entryYear']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                   name="nyear" >
            <label class="w3-label w3-validate w3-medium w3-right">سال ورود</label>
        </p>
        <br>



        <p>
            <input placeholder="در صورت نیاز" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                   name="nps1" >
            <label class="w3-label w3-validate w3-medium w3-right">رمز عبور جدید</label>
        </p>
        <br>
        <p>
            <input placeholder="در صورت نیاز" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                   name="nps2" >
            <label class="w3-label w3-validate w3-medium w3-right">تکرار رمز عبور</label>
        </p>
        <br>
        <br>

        <p class="w3-center">
            <a href="index.php" class="w3-btn w3-round">بازگشت</a>
            <input class="w3-btn w3-round" type="submit" value="ذخیره تغییرات">
        </p>


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



</body>
</html>
