<?php  nocache(); //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 31. Работа с HTTP и WWW</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
echo 123 . br(1);
var_dump(headers_sent());
//header("Location: https://ya.ru");

h2("Запрет кэширования");

function nocache() {
    header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0,pre-check=0");
    header("Cache-Control: max-age=0");
    header("Pragma: no-cache");
}

h2("Получение выведенных заголовков");

debug(headers_list());

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

//debug(getallheaders());

h2("Разбор URL");

$out = null;
$str = "sullivan=paul&names[roy]=noni&names[read]=tom";
parse_str($str, $out);
debug($out);




?>

</body>
</html>