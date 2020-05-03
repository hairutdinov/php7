<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 38. Работа с изображениями </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
$img = './image_1.png';

/*
 * [0] - width (px)
 * [1] - height (px)
 * [2] - image format:
 *       1 - GIF
 *       2 - JPG
 *       3 - PNG
 *       4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF (на Intel-процессорах), 8 = TIFF (на процессорах Motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
 * [3] - width="273" height="445"
 * 
 * */
debug(getimagesize($img));


/*$txtcolor = "FFFF00";
sscanf($txtcolor, "%2x%2x%2x", $red, $green, $blue);*/

?>

<img src="button.php?Hello+world!" alt="" width="200" height="40">

</body>
</html>