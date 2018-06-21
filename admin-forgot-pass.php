<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>فراموشی رمز عبور</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
</head>
<body class="dir">
    <div class="w3-center w3-light-grey w3-xlarge" style="padding-top: 55px; padding-bottom: 40px;">
        <p>"بازیابی رمز عبور ادمین"</p>

    </div>
    <div class="w3-row w3-section">
        <div class="w3-col l4 m3 w3-hide-small">&nbsp;</div>
        <div class="w3-col l4 m6 w3-light-grey w3-card-16 w3-center w3-padding ">
            <form action="admin-forgot-pass2.php" method="post">
                <?php if (isset($_GET['data'])) {
                            if ($_GET['data'] == "incorrect") { ?>
                                <p class="w3-text-red">اطلاعات وارد شده صحیح نیست.</p>
                <?php       }
                        }
                ?>
                <p>
                    <input id="t1" class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="text" name="adminUserName"
                           required>
                    <label class="w3-label w3-validate w3-medium w3-right">نام کاربری</label>
                </p>
                <p>
                    <input  class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="email" name="adminEmail"
                            required>
                    <label class="tooltip w3-label w3-validate w3-medium w3-right">پست الکترونیک</label>
                </p>
                <br>
                <br>
                <p><input type="submit" class="w3-btn w3-round" value="درخواست تعویض رمز"></p>
            </form>
        </div>
    </div>

</body>
</html>