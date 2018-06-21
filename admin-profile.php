<?php
    require_once ('main.php');
    if (!isset($_SESSION['admin_login'])) {
        header("Location: a-d-m-i-n-l-o-g-i-n.php");
    }
$user_name = $_SESSION['admin_login'];
$adminID = $_SESSION['adminID'];
    $db = Db::getInstance();

    $admin_info = $db->first("SELECT adminUserName, adminEmail FROM `admin` WHERE adminUserName='$user_name'");

    $db->close();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>سامانه ی پیش ثبت نام گروه کامپیوتر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>
    <?php
    if (isset($_GET['insert'])){
        if ($_GET['insert'] == "successful"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('ادمین جدید با موفقیت اضافه شد.');
                }); </script>";
        }
    }

    if (isset($_GET['fail'])){
        if ($_GET['fail'] == "existingUserName"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('این نام کاربری قبلا استفاده شده است.');
                }); </script>";
        }
    }

    if (isset($_GET['fail'])){
        if ($_GET['fail'] == "passwordsWeak"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('رمز عبور ضعیف است.');
                }); </script>";
        }
    }

    if (isset($_GET['fail'])){
        if ($_GET['fail'] == "passwordsNotMatch"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('رمز عبور ها با یکدیگر مطابقت ندارند.');
                }); </script>";
        }
    }
    ?>
</head>
<body class="dir style-1">
    <nav class="w3-sidenav w3-black w3-card-2 w3-xlarge" onmouseleave="w3_close()" style="display:none; opacity:0.9" >
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


    <div class="w3-row">
        <div class="w3-col l4 m3 w3-hide-small">&nbsp;</div>
        <div class="holder w3-col l4 m6">

    <div  class=" w3-container w3-padding-hor-12 w3-light-grey  w3-round" >
        <br>
        <div class="w3-center  w3-padding w3-large"   >"ویرایش حساب کاربری"</div>
        <br>
        <form action="admin-profile-check.php" method="post">

            <p >نام کاربری: <?=$admin_info['adminUserName']?></p>

            <p>
                <input value="<?=$admin_info['adminEmail']?>" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                       name="newEmail" >
                <label class="w3-label w3-validate w3-medium w3-right">ایمیل </label>
            </p>
            <p>
                <input placeholder="در صورت نیاز" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                       name="npassword1" >
                <label class="w3-label w3-validate w3-medium w3-right">رمز عبور جدید</label>
            </p>
            <p>
                <input placeholder="در صورت نیاز" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                       name="npassword2" >
                <label class="w3-label w3-validate w3-medium w3-right">تکرار رمز عبور</label>
            </p>
            <br>
            <br>

            <p class="w3-center">
                <a href="admin-panel.php" class="w3-btn w3-round">بازگشت</a>
                <input class="w3-btn w3-round" type="submit" value="ذخیره تغییرات">
            </p>


        </form>
        <hr>
        <?php if ($adminID == 1 || $adminID == 2){ ?>
                <div class="w3-center  w3-padding w3-large">"اضافه کردن ادمین جدید"</div>
            <form action="insert-admin.php" method="post">
                <p>
                    <input value="" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text"
                           name="username" >
                    <label class="w3-label w3-validate w3-medium w3-right">نام کاربری </label>
                </p>
                <p>
                    <input value="" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="email"
                           name="email" >
                    <label class="w3-label w3-validate w3-medium w3-right"> ایمیل </label>
                </p>
                <p>
                    <input placeholder="" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="password1" >
                    <label class="w3-label w3-validate w3-medium w3-right">رمز عبور</label>
                </p>
                <p>
                    <input placeholder="" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="password2" >
                    <label class="w3-label w3-validate w3-medium w3-right">تکرار رمز عبور</label>
                </p>
                <p>
                    <input placeholder="" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="number"
                           min="0" value="<?=$_SESSION['deptID'][0]?>"
                           name="deptID" >
                    <label class="w3-label w3-validate w3-medium w3-right">شماره گروه</label>
                </p>
                <br>
                <br>
                <p class="w3-center">
                    <input class="w3-btn w3-round" type="submit" value="ایجاد ادمین جدید">
                </p>
            </form>
        <?php } ?>
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

</body>
</html>