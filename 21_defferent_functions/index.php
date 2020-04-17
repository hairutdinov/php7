<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 21. Разные функции.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

h2("Финализаторы");

function shf () {
    $f = fopen('log.txt', 'a+t');
    fwrite($f, "Финализатор: " . date("Ymd_His") . "\n");
    fclose($f);
}

register_shutdown_function('shf');

h2("Eval");

foreach (range(1,5) as $i) {
    eval("function printSquare$i() {echo $i*$i;}");
}
printSquare4();

h2("Генерация функций (квазианонимных)");
$arr = [];
foreach (range(0, 10) as $i) {
    $id = uniqid("F");
    eval("function $id() {echo 'Generated function: ' . $id;}");
    $arr[] = $id;
}
$arr[1]();
br();


$mul = create_function('$a,$b', 'return $a*$b;');
echo $mul(26,2);

?>

</body>
</html>