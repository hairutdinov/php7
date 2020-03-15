<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 11. Функции и области видимости.</title>
</head>
<body>

<?php

function myecho() {
    foreach (func_get_args() as $arg_key => $arg) {
        echo $arg . "<br>";
    }
}

myecho("Mercury", "Venera", "Earth", "Mars");

echo "<hr>";

function myecho_2(...$planets) {
    foreach ($planets as $arg_key => $arg) {
        echo $arg . "<br>";
    }
}

myecho_2("Mercury", "Venera", "Earth", "Mars");

echo "<hr>";

function myecho_3($a, $b, $c) {
    echo $a . "<br>";
    echo $b . "<br>";
    echo $c . "<br>";
}

myecho_3(...["Mercury", "Venera", "Earth"]);

echo "<hr>";

/*
 * Для того, чтобы PHP эмулировал режим жесткой типизации
 * необходимо включить строгий режим типизации
 * declare(strict_types = 1);
 * */

function sum(int $a, int $b) :int
{
    return $a + $b;
}

echo sum(1,2) . "<br>";
echo sum(2,"2.5") . "<br>";

?>

<h2>Статические переменные</h2>
<?php
function selfcounter()
{
    static $count = 0;
    $count++;
    return $count;
}

for ($a = 1; $a <= 5; $a+=1 ) {
    echo selfcounter() . "<br>";
}

?>

<h2>function dumper():</h2>

<?php
function dumper($obj, $leftSpace = " ")
{
    echo "<pre>";
    echo htmlspecialchars(dumperGet($obj, $leftSpace));
    echo "</pre>";
}

function dumperGet($obj, $leftSpace) {
    if (is_array($obj)) {
        $type = "Array [".count($obj)."]";
    } elseif (is_object($obj)) {
        $type = "Object";
    } elseif (gettype($obj) === "boolean") {
        return $obj ? "true" : "false";
    } else {
        return "\"$obj\"";
    }
    $buf = $type;
    $leftSpace = str_repeat($leftSpace, 2);
    foreach ($obj as $k => $v) {
        if ($k === "GLOBALS") continue;
        $buf .= "\n{$leftSpace}{$k} => " . dumperGet($v, $leftSpace);
    }
    return $buf;
}

$tmp_obj_1 = [
    [
        "age" => 18,
        "isActive" => true,
        "books" => ["Some book 1", "Some book 2"],
    ],
    [
        "age" => 21,
        "isActive" => false,
        "books" => ["Some book 3", "Some book 2"],
    ],

];

dumper($tmp_obj_1, "  ");
?>

<h2>Условно определяемые функции:</h2>
<?php
if (PHP_OS == "WINNT") {
    function myChown($fname, $attr) {
        return 1;
    }
} else {
    function myChown($fname, $attr) {
        return chown($fname, $attr);
    }
}
?>

<h2>Передача функций по ссылке</h2>
<?php
function A($i) { echo "Function A({$i})<br>"; };
$F = "A";
$F(10);
/* call_user_func */
call_user_func($F, 110);
?>

<h2>Замыкания</h2>
<p>Замыкание - это функция, которая запоминает состояние окружения в момент создания</p>
<?php
$message = "<p><b>Работа не может быть продолжена из-за ошибок:</b></p>";
$check = function (array $errors = []) use($message)
{
    if (sizeof($errors) > 0) {
        echo $message;
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
};

$check(["Error 1", "Error 2"]);
$message = "Some new message";
$check(["Error 2", "Error 3"]);
?>

<h2>Возврат функцией ссылки:</h2>
<?php
$a = 100;
function &r() { /* !!! & */
    global $a;
    return $a;
}

$b =& r(); /* !!! & */
$b = 0;
echo $a;


?>

<h2></h2>
<?php

?>

<h2></h2>
<?php

?>


</body>
</html>