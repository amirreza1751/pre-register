<?php
require_once ('main.php');
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود مدیر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <?php
    if (isset($_GET['asts'])){
        if ($_GET['asts'] == "anr"){
            echo "<script> 
                                $(document).ready(function () {
                                window.alert('نام کاربری یا رمز عبور اشتباه است.');
                }); </script>";
        }
    }

    ?>

</head>
<body class="bg">


<div class="form-holder  w3-center w3-container w3-padding  w3-round padding-20">


    <div class="w3-text-black">
        <!--login form start-->
        <form action="admin-login-check.php" method="post" id="login">
            <p>
                <input class="w3-input w3-round w3-text-black w3-border margin-top-20 op" autofocus type="text" name="uname"
                       required >
                <label class="w3-label w3-validate w3-medium w3-right">نام کاربری</label>
            </p>
            <p>
                <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password" name="pass"
                       required>
                <label class="w3-label w3-validate w3-medium w3-right">رمز عبور</label>
            </p>
            <br>
            <p>
                <a href="admin-forgot-pass.php" class=" w3-text-blue" style="text-decoration: none;">رمز عبورم را فراموش کرده ام.</a>
            </p>
            <p>
                <input type="submit" class="w3-btn w3-btn-block w3-round  margin-top-20"
                       style="background: #006600;" value="ورود">
            </p>
        </form>
        <!--login form end-->

    </div>

</div>


</body>
</html>