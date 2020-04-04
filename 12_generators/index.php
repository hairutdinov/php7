<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 12. Генераторы.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
function simple($from = 0, $to = 5) {
  for ($i = $from; $i <= $to; $i+=1) {
    echo "value: " . $i . "<br>";
    yield $i;
  }
}

foreach (simple(1,3) as $item) {
  echo "{$item}^{$item} = " . ($item**$item) . "<br>";
}

function generator_1() {
    echo "before first yield<br>";
    yield 1;
    echo "before second yield<br>";
    yield 2;
    echo "before third yield<br>";
    yield 3;
}

hr();

foreach (generator_1() as $i) {
    var_dump($i);
    echo "<br>";
}

hr();

function double($arr, $callback) {
    foreach ($arr as $i) {
      yield $callback($i);
    }
}

$arr = [1,2,3,4,5,6];
$collect = double($arr, function ($i) { return $i*2; });
foreach ($collect as $v) echo $v . "<br>";

hr();

function select($arr, $callback) {
  foreach ($arr as $v) {
    if ($callback($v)) yield $v;
  }
}
$arr = [1,2,3,4,5,6];
$select = select($arr, function ($i) { return ($i % 2 == 0) ? true : false; });
foreach ($select as $v) echo $v . "<br>";

hr();
/* Комбинирование генераторов */
$select = select($arr, function ($i) { return ($i % 2 == 0) ? true : false; });
$select_double = double($select, function ($i) { return $i*2; });
foreach ($select_double as $v) echo $v . "<br>";

hr();

echo "<h2>Делегирование генераторов (yield from) </h2>";

function triple($v) {
  yield $v*3;
}

function even_triple($arr) {
  foreach ($arr as $v) {
    if ($v % 2 == 0) yield from triple($v);
  }
}

$arr = [2,3,54,1,4,65];
foreach (even_triple($arr) as $v) echo $v . br(true);

hr();


function tmp($size) {
  $tmp = [];
  for ($i = 0, $k = $i + 1; $i < $size; $i+=1, $k = $i + 1) $tmp[$i] = $k;
  return $tmp;
}

function tmp_gen($size) {
  for ($i = 0, $k = $i + 1; $i < $size; $i+=1, $k = $i + 1) yield $k;
}

//foreach (tmp_gen(1024000) as $v) echo $v . " ";
//echo memory_get_usage() . "<br>";


h2("Использование ключей");

function generators_keys($arr) {
  foreach ($arr as $k => $v) yield $k => $v;
}

$generators_keys = generators_keys([
  'first' => 1,
  'second' => 2,
  'third' => 3,
]);

foreach ($generators_keys as $k => $v) {
  echo "{$k} => {$v}" . br(true);
}

hr();

h2("Использование ссылки");

function &generator_ref() {
  $value = 3;
  while ($value > 0) {
    yield $value;
  }
}

foreach (generator_ref() as &$num) {
  echo (--$num) . ' ';
}

h2("Связь генераторов с объектами");

function generator_send() {
  while (true) {
    $string = yield;
    echo $string;
  }
}

$g_send = generator_send();
$g_send->send("'Hello, World' from generator");

hr();

function generator()
{
  yield 1;
  return 2;
  yield 3;
}

$generator = generator();

foreach ($generator as $i) echo $i . br(true);

echo "returned: " . $generator->getReturn();

?>

</body>
</html>