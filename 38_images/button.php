<?php
$string = $_SERVER["QUERY_STRING"] ?? "Hello World!!!";
$im = imagecreatefromgif('button.gif');

//Создание нового цвета
$txtcolor = "39297b";
sscanf($txtcolor, "%2x%2x%2x", $red, $green, $blue);
$color = imagecolorallocate($im, $red, $green, $blue);

$px = ( imageSX($im) - 6.5 * strlen($string) ) / 2;
// Выводим строку поверх того, что было в загруженном изображении
imageString($im, 3, $px, 1, $string, $color);
// Сообщаем о том, что далее следует рисунок PNG
header("Content-type: image/png");
// Теперь - самое главное: отправляем данные картинки в
// стандартный выходной поток, т. е. в браузер
imagePng($im);
// В конце освобождаем память, занятую картинкой
imageDestroy($im);