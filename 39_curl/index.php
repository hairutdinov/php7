<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 39. Работа с сетью </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

/* CURL (Client URL Library) */
$curl = curl_init("https://www.php.net/");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($curl);
curl_close($curl);
//echo $content;

function get_headers_2($hostname) {
    $curl = curl_init($hostname);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_NOBODY, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    return explode("\r\n", $content);
}

debug(get_headers_2("https://www.php.net"));

/*$datetime = curl_init("http://wwv.nist.gov:13");
echo curl_exec($datetime);
curl_close($datetime);*/

hr();

$data_arr = [
    "first_name" => "Игорь",
    "password" => "123456"
];
$data = implode("&", array_map(function ($k, $v){ return $k . "=" . urlencode($v);}, array_keys($data_arr), $data_arr)) . str_repeat("\r\n", 2);

/*$curl = curl_init("http://php/39_curl/handler.php");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_exec($curl);
curl_close($curl);*/
exit();
?>


<form method="post">
    <input type="text" name="first_name" placeholder="First name"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit" name="submit">Ok</button>
</form>

</body>
</html>