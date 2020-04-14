<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 20. Основы регулярных выражений.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
/*$str = addslashes('somedir\txt');
var_dump(preg_match('#\\\\[a-z]+#i', $str, $matches));
var_dump($matches);*/

$str = "  2020.03.20 ";
$regexp = '{
            ^ \s* (                 # начало строки
                (\d+)                # день
                \s*[[:punct:]] \s*   # раздилитель
                (\d+)                # месяц
                \s* [[:punct:]] \s*  # раздилитель
                (\d+)                # год
            ) \s* $                 # конец строки
            }xs';
preg_match($regexp, $str, $matches);
debug($matches);

//$str = "\$hello is a var";
//$regexp = '|\$[a-z]\w*|i';

$text = nl2br(htmlspecialchars(file_get_contents("../10_arrays/index.php")));
$html = preg_replace('|(\$[a-z_]\w*)|i', '<b>$1</b>', $text);
echo $html;

hr();

h2('Поиск тегов');



?>

</body>
</html>