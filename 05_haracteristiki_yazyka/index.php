<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 5. Характеристики языка</title>
</head>
<body>

<?php
$date = date("d.m.Y");
echo "<p>Текущая дата: ", $date, "</p>";
?>

<p>Для работоспособности сокращенных тегов &lt;?...?&gt;, необходимо включить опцию short_open_tags в php.ini</p>
<p>php.ini: date.timezone = 'Europe/Moscow'</p>

</body>
</html>