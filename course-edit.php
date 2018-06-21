<?php
require_once ('main.php');
if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>خانه | خوش آمدید.</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>
<body>
<!--    <div class="w3-container w3-center " style="width: 50%; margin: 10% auto ;">-->
        <div class="w3-border w3-padding w3-round w3-animate-opacity w3-padding w3-center list-holder back2" style="margin: 100px auto;">
            <form action="course-edit-check.php" method="post">
                <ul class="w3-ul">
                    <li style="border: none;" class="w3-right-align">
                        <label class=" for="">:ویرایش نام درس </label>
                        <input class="w3-input right-dir w3-border w3-margin-bottom" type="text" value="<?=$_GET['c-name']?>" name="c_name">
                    </li>
                    <li style="border: none;" class="w3-right-align">
                        <label class=" for="">:ویرایش کد درس </label>
                        <input class="w3-input right-dir w3-border w3-margin-bottom" type="text" value="<?=$_GET['c-code']?>" name="c_code">
                    </li>
                    <li style="border: none;" class="w3-right-align">
                        <label class=" for="">:ویرایش تعداد واحد </label>
                        <input class="w3-input right-dir w3-border w3-margin-bottom" type="text" value="<?=$_GET['c-unit']?>" name="c_unit">
                    </li>
                    <li style="border: none;" class="w3-right-align">
                        <label class=" for="">:ویرایش نوع درس </label>
<!--                        <input class="w3-input right-dir w3-border w3-margin-bottom" type="text" value="--><?//=$_GET['c-type']?><!--" name="c_type">-->
                        <select required class="w3-select right-dir w3-input w3-round w3-text-black w3-border margin-top-20 op" name="c_type" id="">
                            <option selected value="<?=$_GET['c-type']?>"><?=$_GET['c-type']?></option>

                            <option  value="نظری">نظری</option>
                            <option  value="عملی">عملی</option>
                        </select>
                    </li>

                    <li style="display: none;" class="w3-right-align"><input class="" type="text" value="<?=$_GET['c-id']?>" name="c_id"></li>
<!--                    id dars ro mifreste  ^^^  -->

                </ul>
                <input class="w3-btn w3-green w3-round" type="submit" value="ذخیره">
                <button class="w3-btn w3-green w3-round" type="reset">مقادیر اولیه</button>
                <a href="admin-panel.php" class="w3-btn w3-green w3-round">انصراف</a>
            </form>
        </div>
<!--    </div>-->

</body>
</html>

