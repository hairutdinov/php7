<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 13. Строковые функции.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

/*
 * php.ini
 * extension_dir = "ext"
 * extension=php_mbstring.dll
 *
 * */

$str = "Привет, мир!";
echo "В строке \"{$str}\" байт: " . strlen($str) . br(true);
echo "В строке \"{$str}\" символов: " . mb_strlen($str) . br(true);

/*
 * [mbstring]
 * mbstring.func_overload=2, чтобы все PHP функции заменялись mbstring-аналогами
 * */

hr();

$haystack = "<?php echo 123; ?><?php echo 345 ?>";
$needle = "<?php";
var_dump(strpos($haystack, $needle, 0) !== false);

hr();

$str = "123456";
var_dump(substr($str, -3, -1));

hr();

$subject = "Hello.\nMy name is John.\nI'm a robot from the future";
$search = "\n";
$replace = "<br>";
echo str_replace($search, $replace, $subject, $count) . br(true);
echo "Было прозведено замен: {$count}" . br(true);

hr();

$str = "1) Hello, there. Hello one more time";
$search = "hEllO";
$replacement = "Hi";

echo substr_replace($str, $replacement, (strpos(strtolower($str), strtolower($search)) !== false) ? strpos(strtolower($str), strtolower($search)) : 0, (strpos(strtolower($str), strtolower($search)) !== false) ? mb_strlen($search) : 0);

br();

$str = "122456";
$replacement = "3";
echo substr_replace($str, $replacement, 2, 1) . br(true);
echo substr($str, 0, 2) . $replacement . substr($str, (2 + mb_strlen($replacement))); // эквивалент substr_replace, но работает медленнее, да и пишется куда длиннее

echo hr();

h2("Множественная замена");

$arr = [
    "{TITLE}" => "Here is a tile",
    "{BODY}" => "HTML BODY ...",
];

$subject = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{TITLE}</title>
</head>
<body>
  {BODY}
</body>
</html>
HTML;

echo nl2br(htmlspecialchars(str_ireplace(array_keys($arr), array_values($arr), $subject)));

hr();

function transliterate($st) {
    $pattern = ['а', 'б', 'в', 'г', 'д', 'е', 'ё',
        'ж', 'з', 'и', 'й', 'к', 'л', 'м',
        'н', 'о', 'п', 'р', 'с', 'т', 'у',
        'ф', 'х', 'ч', 'ц', 'ш', 'щ', 'ъ',
        'ы', 'ь', 'э', 'ю', 'я',
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё',
        'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М',
        'Н', 'О', 'П', 'Р', 'С', 'Т', 'У',
        'Ф', 'Х', 'Ч', 'Ц', 'Ш', 'Щ', 'Ъ',
        'Ы', 'Ь', 'Э', 'Ю', 'Я'];
    $replace = ['a', 'b', 'v', 'g', 'd', 'e', 'yo',
        'zh', 'z', 'i', 'y', 'k', 'l', 'm',
        'n', 'o', 'p', 'r', 's', 't', 'u',
        'f', 'h', 'ch', 'ts', 'sh', 'shch', '\'',
        'y', '', 'e', 'yu', 'ya',
        'A', 'B', 'V', 'G', 'D', 'E', 'Yo',
        'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M',
        'N', 'O', 'P', 'R', 'S', 'T', 'U',
        'F', 'H', 'CH', 'Ts', 'Sh', 'Shch', '\'',
        'Y', '', 'E', 'Yu', 'Ya'];

    return str_replace($pattern, $replace, $st);
}

echo transliterate("Привет, меня зовут Хоакин") . br(true);

hr();

$str = "matrix has you";
$replacement = ["matrix" => "you", "you" => "matrix"];

echo "str_replace(): " . str_replace(array_keys($replacement), array_values($replacement), $str) . br(true);
echo "strtr(): " . strtr($str, $replacement) . br(true);

hr();

$str = "<?php echo 'Hello, World' ?>";
$htmlspecialchars = htmlspecialchars($str);
echo $htmlspecialchars . br(true);
$trans = array_flip(get_html_translation_table());
echo strtr($htmlspecialchars, $trans) . br(1);

hr();

$day = intval(date("d"));
$month = intval(date("m"));
$year = date("Y");
$date = [$day, $month, $year];

echo join(".", $date) . br(1); // 8.4.2020
echo sprintf("%02d.%02d.%04d", ...$date) . br(1); // 08.04.2020;
// printf("%02d.%02d.%04d", ...$date); // делает то же, что и sprintf, но результат не возвращается, а направляется в браузер пользователя

hr();

$number = 1024000.55;

echo number_format($number, 2, ',', ' ') . br(1);


?>

</body>
</html>