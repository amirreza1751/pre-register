<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>سامانه ی پیش ثبت نام گروه کامپیوتر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            var entryYear;
            $("#t1").blur(function () {
                entryYear = $("#t1").val();
                if (entryYear != ""){
                    $("#t2").attr("value" , "13" + entryYear.substr(0, 2));
                }
            });
        });
    </script>



    <script>
        $(document).ready(function () {
            $("#login-btn").click(function () {

                $(this).css("background-color", "#006600");
//                (this).removeClass("w3-pale-red").addClass("w3-red");
                $("#register-btn").css("background-color", "#d6d6c2");
//                $("#register-btn").removeClass("w3-pale-red").addClass("w3-grey");
//                $(".bottom").css({"position" : "absolute" , "bottom" :"-50px"});

                $("#register").hide();
                $("#login").fadeIn();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#register-btn").click(function () {

                $(this).css("background-color", "#006600");
//                $(this).removeClass("w3-pale-red").addClass("w3-red");
                $("#login-btn").css("background-color", "#d6d6c2");
//                $("#login-btn").removeClass("w3-pale-red").addClass("w3-grey");
//                $(".bottom").css({"position" : "-" , "bottom" :"-"});

                $("#login").hide();
                $("#register").fadeIn();
            });
        });
    </script>
<?php


if (isset($_GET['sts'])){
    if ($_GET['sts'] == "pi"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('نام کاربری یا رمز عبور اشتباه است.');
                }); </script>";
    }
}

if (isset($_GET['sts'])){
    if ($_GET['sts'] == "ar"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('شما در حال حاضر ثبت نام کرده اید.');
                }); </script>";
    }
}
if (isset($_GET['sts'])){
    if ($_GET['sts'] == "afae"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('همه ی فیلدها خالی هستند!');
                }); </script>";
    }
}
if (isset($_GET['sts'])){
    if ($_GET['sts'] == "pw"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('رمز عبور ضعیف است.');
                }); </script>";
    }
}
if (isset($_GET['sts'])){
    if ($_GET['sts'] == "pnm"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('رمز عبور ها مطابقت ندارند.');
                }); </script>";
    }
}

if (isset($_GET['sts'])){
    if ($_GET['sts'] == "sr"){
        echo "<script> 
                                $(document).ready(function () {
                                window.alert('ثبت نام شما با موفقیت انجام شد. لطفا وارد شوید.');
                }); </script>";
    }
}

?>
</head>
<body class="bg style-1">
<!--<header>-->
<!--<div class="w3-container w3-padding-hor-64 w3-pale-green w3-center w3-xxlarge">-->
<!--سامانه ی پیش ثبت نام گروه کامپیوتر-->
<!--</div>-->
<!--</header>-->
<!--<br><br><br><br><br><br>-->

    <div class="form-holder  w3-center w3-container w3-padding  w3-round padding-20">

        <div class="tab-holder ">
            <span class="w3-btn w3-round " id="login-btn" style="background: #006600;">ورود</span>

            <span class="w3-btn w3-round " id="register-btn" style="background: #d6d6c2;">ثبت نام</span>
        </div>
        <div class="w3-text-black">
            <!--login form start-->
            <form action="login-check.php" method="post" id="login">
                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" autofocus type="text" name="stid"
                           required >
                    <label class="w3-label w3-validate w3-medium w3-right">شماره دانشجویی</label>
                </p>
                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password" name="psw"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">رمز عبور</label>
                </p>
                <br>
                <p>
                    <a href="forgot-pass.php" class=" w3-text-blue" style="text-decoration: none;">رمز عبورم را فراموش کرده ام.</a>
                </p>
                <p>
                    <input type="submit" class="w3-btn w3-btn-block w3-round  margin-top-20"
                           style="background: #006600;" value="ورود">
                </p>

            </form>
            <!--login form end-->
            <!--register form start-->
            <form action="register-check.php" method="post" id="register" style="display: none;">
                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="fname"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">نام</label>
                </p>

                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="lname"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">نام خانوادگی</label>
                </p>

                <p>
                    <input id="t1" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="st-id-reg"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">شماره دانشجویی</label>
                </p>

                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="password1" required>
                    <label class="w3-label w3-validate w3-medium w3-right">رمز عبور</label>
                </p>

                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="password2" required>
                    <label class="w3-label w3-validate w3-medium w3-right">تکرار رمز عبور</label>
                </p>



                <p>
                    <input id="t2" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="entry-year"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">سال ورود</label>
                </p>



                <p>
                    <input id="t2" class=" w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="dept-id"
                           required>
                    <label class=" tooltip w3-label w3-validate w3-medium w3-right">

                        شماره گروه
                        <span class="tooltiptext">
                            گروه کامپیوتر: 1
                        </span>
                    </label>
                </p>
                


                <p>
                    <input  class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="email" name="email"
                           required>
                    <label class="tooltip w3-label w3-validate w3-medium w3-right">پست الکترونیک

                        <span class="tooltiptext">مورد نیاز برای بازیابی رمزعبور</span>

                    </label>
                </p>

                <p>
                    <input type="submit" class="w3-btn w3-btn-block w3-round margin-top-20" style="background: #006600;"
                           value="ثبت نام">
                </p>

            </form>
            <!--register form end-->
        </div>

    </div>
    <!--<div class=" w3-padding-hor-64 w3-pale-green w3-center w3-xxlarge bottom footer">-->
    <!--گروه کامپیوتر دانشکده مهندسی دانشگاه شهید چمران-->
    <!--</div>-->

<!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->


</body>
</html>