<?php
require_once ('main.php');


if (!isset($_SESSION['admin_login'])) {
    header("Location: a-d-m-i-n-l-o-g-i-n.php");
}
$query = $_POST['sql'];
if ($query == ""){
    header("Location: query.php");
}
$db = Db::getInstance();
$records = $db->query($query);
//$amir ['amirak'] = 'jomlak';
//var_dump($records);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>پرس و جو</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: none">

<div class="w3-container " style="margin: 5% auto;">
    <p class="w3-center w3-xxlarge">نتایج پرس  و جو</p>

    <table class="w3-table w3-striped margin-top-20 w3-border">
        <tr>
<?php
$flag = false;
if (is_array($records)){
    foreach ($records as $andis => $array) {
//    echo "andis: " . $andis . " array: " . $array;
        foreach ($array as $key => $value){
            echo "<th>$key</th>";
//        echo "key: ". $key . " value: " . $value;
        }
        $flag = true;
        if($flag == true){
            break;
        }
    }
    echo "</tr>";

    foreach ($records as $andis => $array) {
        echo  "<tr>";
        foreach ($array as $key => $value){
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
}


//foreach ($amir as $key => $value){
//    echo "$key is a $value";
//}
?>
    </table>
</div>
</body>
</html>
