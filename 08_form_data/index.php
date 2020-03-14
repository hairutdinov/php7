<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Глава 8. Работа с данными форм</title>
</head>
<body>

<?php
  if (isset($_REQUEST["submit"])) {
    var_dump($_REQUEST["known"]);
  }
?>

<form action="" method="post">
  <p>Какие языки программирования вы знаете?</p>
  <label>
    php
    <input type="hidden" name="known[php]" value="0">
    <input type="checkbox" name="known[php]" value="1">
  </label>

  <label>
    perl
    <input type="hidden" name="known[perl]" value="0">
    <input type="checkbox" name="known[perl]" value="1">
  </label>
  <button name="submit">Ответить</button>
</form>

</body>
</html>