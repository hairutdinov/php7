<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 14. Работа с массивами.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

$arr = [
    "a" => "1",
    "b" => "10",
    "c" => "2",
];

asort($arr, SORT_STRING); // сортировка по значениям
print_r($arr);

hr();

$arr = [
    "b" => "Weapon",
    "a" => "Clone",
    "c" => "Alpha",
];

ksort($arr, SORT_REGULAR); // сортировка по ключам
print_r($arr);

hr();

$files = [
    "file_1.php" => 14,
    "file_2.php" => 5,
    "dir#2" => 0,
    "file_3.php" => 10,
    "dir#1" => 0,
];

uksort($files, function ($f1, $f2) {
    if (is_dir($f1) && !is_dir($f2)) return -1; // if $f1 < $f2 return -1
    if (!is_dir($f1) && is_dir($f2)) return 1; // if $f1 > $f2 return 1
    return $f1 <=> $f2;
});

print_r($files);

hr();

$arr = [
    "1",
    "2",
    "3"
];

var_dump(array_reverse($arr, true));

hr();

$files = [
    "img10.png", "Img2.png", "img1.png", "img20.png",
];
natcasesort($files);
var_dump($files);

hr();

$arr = [
    "Bulat" => "active",
    "admin" => "active",
    "demo" => "not-active",
    "John" => "active"
];

print_r(array_keys($arr, "active"));

hr();

$arr = ["a", "b", "c", "d"];
var_dump(array_slice($arr, 1, 2, true));

hr();

$arr = ["a", "e", "d", "e"];
array_splice($arr, 1, 1, ["b", "c"]);
var_dump($arr);

hr();

$arr = [1,2,3,4,5];
var_dump(array_pop($arr)); // 5
var_dump(array_pop($arr)); // 4

hr();

$arr = [2,3,4];
var_dump(array_unshift($arr, 1)); // 4, возвращает новый размер массива
var_dump($arr);

hr();

var_dump(array_intersect([1,2,3], [1,3], [1,2])); // [0 => int(1)]

hr();

var_dump(array_diff([1,2,3,20], [2,4], [1,3,5])); // [3 => int(20)]

hr();

var_dump(array_unique(["a" => "green", "red", "blue", "b" => "green", "red"])); // ["a"]=> "green" [0]=> "red" [1]=> "blue"

hr();

$arr = [
    "employee" => "Иванов Иван",
    "phones" => [
        "9191534324",
        "9170493201",
    ]
];

debug(json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

?>

</body>
</html>