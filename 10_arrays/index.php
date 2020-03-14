<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 10. Массивы</title>
</head>
<body>

<?php
$nameList[0] = "John";
$nameList[1] = "Peter";
$nameList[2] = "Marie";
?>

<ul>
    <?php for ($i = 0; $i < sizeof($nameList); $i++): ?>
        <li><?= "Name: {$nameList[$i]}<br>" ?></li>
    <?php endfor; ?>
</ul>

<h2>list</h2>
<?php
$info = ["John", "Anderson", 21];
list ($first_name, $last_name, $age) = $info;
var_dump($first_name);
?>

<h2>Косвенный перебор элементов массива</h2>
<p>Массивы в php являются направленными, и у них есть такое понятие, как текущий элемент</p>
<?php
$birth = [
    "Tomas Anderson" => "1962-03-11",
    "Keanu Reaves" => "1962-09-02",
];

//var_dump(reset($birth)); // Устанавливает элемент на первую позиция в массиве
//var_dump(key($birth)); // Возвращает ключ, который имеет текущий элемент
//var_dump(next($birth)); // Возвращает ключ, который имеет текущий элемент

/* for (инициализирующие_команды; условие_цикла; команды_после_прохода) тело_цикла; */
for (reset($birth); ($k = key($birth)); next($birth)){
  echo $k;
}
?>

<h2>Прямой перебор массива</h2>
<p>Старый способ:</p>
<?php
for (reset($birth); list ($k, $v) = each($birth); /*empty*/) {
  echo "{$k} was born in {$v}<br>";
}
?>

<p>foreach:</p>
<?php foreach ($birth as $k => $v): ?>
  <?= "{$k} was born in {$v}<br>" ?>
<?php endforeach; ?>

</body>
</html>