<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 7. Выражения и операции</title>
</head>
<body>

<p>Выражение - нечто, имеющее определенное значение. И обратно: если что-то имеет значение, то это "что-то" есть выражение</p>
<?php
$a = ($b = 10);
echo "a: ${a}, b: ${b}";

$var_1 = "Robot";

$here_syntax = <<<BLABLA
<p>Mr $var_1 </p>
BLABLA;
echo $here_syntax;

$now_syntax = <<<'now'
<p>Mr $var_1</p>
now;
echo $now_syntax;

$command = `ls -la .`;
echo "<pre>{$command}</pre>";

echo "<hr>";

echo 2**3;

echo "<hr>";

if ("Universe" == 0) {
  echo "<p>Strange things!</p>";
}

if ("" == 0) {
  echo "<p>Strange things #2!</p>";
}

if (100 == true) {
  echo "<p>Strange things #3!</p>";
}

echo "<h2>Оператор сравнения '=='</h2>";
$arr_1 = [1,2,3];
$arr_2 = [1,2,true];
echo '$arr_1 == $arr_2: ' . var_export($arr_1 == $arr_2, true);

echo "<h2>Оператор эквивалентности '==='</h2>";

echo "<h2>Оператор '<=>'</h2>";
$arr_3 = [3,1,7,6,9,4];
usort($arr_3, function ($a, $b) { return $a <=> $b; });
print_r($arr_3);

?>

</body>
</html>