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
    <title>سامانه ی پیش ثبت نام گروه کامپیوتر</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/snackbar.css">
    <link rel="stylesheet" href="css/admin-modal.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
<div class="w3-col l3 w3-hide-small">&nbsp;</div>
<div class=" w3-center w3-col l6 w3-light-grey w3-round" style="margin: 9% auto; padding: 30px;" >
    <form action="query-check.php" method="post">
        <p>
            <textarea autofocus name="sql" id="" cols="100" rows="15" style="resize: none; padding: 10px; background-color: rgba(255, 255, 255, 0.8);" placeholder="type here the query..."></textarea>
        </p>
        <br>
        <p>
            <input type="submit" class="w3-btn w3-round w3-green" value="اجرا">
            <a href="admin-panel.php" class="w3-btn w3-round">بازگشت</a>
        </p>
    </form>
</div>

<!--<div id="editor"></div>-->



<script src="js/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
</script>

</body>
</html>