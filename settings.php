<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$db = Db::getInstance();
$deptID = $_SESSION['deptID'];
//var_dump($_SESSION);
//echo "deptid: " . $deptID[0];
//$records = $db->query("SELECT opValue FROM `option-department` WHERE deptID= '$deptID[0]'");
//var_dump($records);
$confirmed = $_SESSION['confirmed'];
$term = $_SESSION['currentTerm'];
$year = $_SESSION['currentYear'];
$maxUnit = $_SESSION['maxUnit'];
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
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>

</head>

<body class="dir style-1" >

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





<div  class=" w3-container w3-padding-hor-12 w3-light-grey mobile" style="width: 50%; margin: auto;" >
    <br>
    <div class="w3-center  w3-padding w3-large" >"تنظیمات سامانه"</div>
    <form action="save-settings.php" method="post">
        <div class="w3-padding w3-large w3-padding-hor-24" style="width: 100%; margin: auto;">


                    <ul class="w3-ul w3-border ">
                        <li class="w3-row">
                            <div class="w3-col s6  w3-right"><p class="w3-container"> تایید خودکار: <?=$confirmed[0]?></p></div>
                            <div class="w3-col s6 ">
                                <select class="w3-select" name="confirm" id="">
                                    <option selected value="">انتخاب کنید</option>
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>
                            </div>
                        </li>

                        <li class="w3-row">
                            <div class="w3-col s6  w3-right"><p class="w3-container">ترم جاری: <?=$term[0]?></p></div>
                            <div class="w3-col s6 ">
                                <select class="w3-select" name="term" id="">
                                    <option  selected value="">انتخاب کنید</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </li>

                        <li class="w3-row">
                            <div class="w3-col s6  w3-right"><p class="w3-container"> سال جاری: <?=$year[0]?></p></div>
                            <div class="w3-col s6 ">
                                <select class="w3-select" name="year" id="">
                                    <option selected value="">انتخاب کنید</option>
                                    <option value="1395">1395</option>
                                    <option value="1396">1396</option>
                                    <option value="1397">1397</option>
                                    <option value="1398">1398</option>
                                    <option value="1399">1399</option>
                                    <option value="1400">1400</option>
                                    <option value="1401">1401</option>
                                    <option value="1402">1402</option>
                                    <option value="1403">1403</option>
                                    <option value="1404">1404</option>
                                    <option value="1405">1405</option>
                                    <option value="1406">1406</option>
                                    <option value="1407">1407</option>
                                    <option value="1408">1408</option>
                                    <option value="1409">1409</option>
                                    <option value="1410">1410</option>
                                </select>
                            </div>
                        </li>






                        <li class="w3-row">
                            <div class="w3-col s6  w3-right"><p class="w3-container">سقف انتخاب واحد: <?=$maxUnit[0]?></p></div>
                            <div class="w3-col s6 ">
                                <select class="w3-select" name="max-unit" id="">
                                    <option selected value="">انتخاب کنید</option>
                                    <option value="24">24</option>
                                    <option value="23">23</option>
                                    <option value="22">22</option>
                                    <option value="21">21</option>
                                    <option value="20">20</option>
                                    <option value="19">19</option>
                                    <option value="18">18</option>
                                    <option value="17">17</option>
                                    <option value="16">16</option>
                                    <option value="15">15</option>
                                    <option value="14">14</option>
                                    <option value="13">13</option>
                                    <option value="12">12</option>
                                    <option value="11">11</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </li>






                    </ul>

            <p class="w3-padding-top w3-center" style="width: 100%">
                <a class="w3-btn w3-round" href="admin-panel.php" >بازگشت</a>
                <input class="w3-btn w3-round" type="submit" value="ذخیره">
            </p>
        </div>
    </form>
</div>
<script>
    function w3_open() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
    }
    function w3_close() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    }
</script>

<!--    <script>-->
<!--        var arr = [];-->
<!---->
<!---->
<!--    </script>-->


<?php
$db->close();
?>
</body>
</html>