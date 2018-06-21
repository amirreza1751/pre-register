<?php
require_once ('db.php');
require_once ('config.php');
require_once ('common.php');

if (isset($_POST['adminUserName'])){
    $adminUserName = $_POST['adminUserName'];
    $adminEmail = $_POST['adminEmail'];
    $db = Db::getInstance();
//    $records = $db->first("SELECT ID FROM admin WHERE adminUserName = '$adminUserName' AND adminEmail = '$adminEmail'");

    $records = $db->connection()->prepare("SELECT ID FROM admin WHERE adminUserName = ? AND adminEmail = ?");
    $records->bind_param('ss', $adminUserName, $adminEmail);
    $records->execute();
    $records = $records->get_result();
    $records = $records->fetch_assoc();


    if ($records == null){
        header("Location: admin-forgot-pass.php?data=incorrect");
    }
} else if (!isset($_GET['sts'])) {
    header("Location: admin-forgot-pass.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>فراموشی رمز عبور</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <?php
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
    ?>
</head>
<body class="dir">
    <div class="w3-center w3-light-grey w3-xlarge" style="padding-top: 55px; padding-bottom: 40px;">
        <p>"بازیابی رمز عبور"</p>

    </div>
    <div class="w3-row w3-section">
        <div class="w3-col l4 m3 w3-hide-small">&nbsp;</div>
        <div class="w3-col l4 m6 w3-light-grey w3-card-16 w3-center w3-padding ">
            <form action="admin-forgot-pass-check.php" method="post">

                <?php if (isset($_GET['sts'])) {
                    if ($_GET['sts'] == "pch") { ?>
                        <p class="w3-text-green">
                            رمز عبور با موفقیت تعویض شد.
                            <a href="a-d-m-i-n-l-o-g-i-n.php" class="w3-text-blue" style="text-decoration: none;">وارد شوید.</a>
                        </p>
                    <?php       }
                }
                else {
                    echo "<p>میتوانید رمز عبور جدید انتخاب کنید.</p>";
                }
                ?>
                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="npassword1" required>
                    <label class="w3-label w3-validate w3-medium w3-right">رمز عبور جدید</label>
                </p>

                <p>
                    <input class="w3-input w3-round w3-text-black w3-border margin-top-40 op" type="password"
                           name="npassword2" required>
                    <label class="w3-label w3-validate w3-medium w3-right">تکرار رمز عبور</label>
                </p>
                <input type="text" name="adminUserName" value="<?php if (isset($_POST['adminUserName'])){echo $adminUserName;}?>" style="display: none;">
                <br>
                <br>
                <p><input type="submit" class="w3-btn w3-round" value="ثبت رمز جدید"></p>
            </form>
        </div>
    </div>

</body>
</html>