<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 17. Права доступа и атрибуты файлов.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
$filename = 'tmp.txt';

try {
    if (!file_exists($filename)) {
        throw new \Exception("File {$filename} doesn't exist!");
    }

    if (!is_readable($filename)) {
        throw new \Exception("File {$filename} doesn't have 'read' permission!");
    }

    if (!is_writable($filename)) {
        throw new \Exception("File {$filename} doesn't have 'write' permission!");
    }

    $a = fopen($filename, 'a+t');
} catch (\Exception $e) {
    echo "<div style='color: red'>{$e->getMessage()}</div>";
}



echo "UID: " . fileowner($filename) . br(1);

var_dump(chgrp($filename, 'bulat')); // Владельца файла может менять только администратор
br();

echo "GID: " . filegroup($filename) . br(1);

echo "File permissions: " . decoct(fileperms($filename)) . br(1); // decoct - преобразует в восьмиричную сс

debug(stat($filename));

if (filemtime(__FILE__) !== false) {
    echo "Последнее изменение страницы: " . date("d.m.Y H:i:s", filemtime(__FILE__)) . br(1);
}

fclose($a);

h2("Символическая ссылка");
$symlink = 'symlink_for_target';

//var_dump(symlink($filename, $link));
//echo readlink($symlink);
//unlink($symlink);

$link = 'link.tmp.txt';
$link_2 = 'link2.tmp.txt';

var_dump(link($filename, $link));
var_dump(link($filename, $link_2));
//var_dump(unlink($link));
//var_dump(unlink($link_2));



?>

</body>
</html>