<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 16. Работа с файлами и директориями.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
$filename = 'text.txt';
$f = fopen($filename, 'a+') or die('Can\'t open file');
//fwrite($f, '1123');

//var_dump(fgets($f, 6));
//var_dump(fgets($f));

//var_dump(feof($f));

//fseek($f, 7, SEEK_SET);
//var_dump(ftell($f));

fclose($f);

$path = '/var/www/php/php7/16_files_and_directories/index.php';
echo basename($path) . br(1); // index.php
echo basename($path, '.php') . br(1); // index

echo dirname($path) . br(1); // /var/www/php/php7/16_files_and_directories
echo dirname($path, 2) . br(1); // /var/www/php/php7
echo dirname($path, 3) . br(1); // /var/www/php
echo dirname('index.php') . br(1); // .

//echo tempnam($path, 'prefix_') . br(1); // /tmp/prefix_qXqB1D
//echo tempnam(".", 'prefix_') . br(1); // /var/www/php/php7/16_files_and_directories/prefix_azGz4o

h2('Преоброзуем относительный путь в абсолютный');
echo realpath("../../") . br(1); // /var/www/php3

//var_dump(copy('text.txt', 'text.copy.txt')); // true

//var_dump(rename('text.copy.txt', 'text.copy.ren.txt'));

//var_dump(unlink('text.copy.ren.txt'));

//debug(file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

//$filename2 = 'dir1/log.txt';
//$dscr = fopen($filename2, 'a+t');

foreach (range(1,5) as $i) {
//    file_put_contents($filename2, "Line #${i}\n", FILE_APPEND);
//    echo "Сейчас в файле находиться: " . file_get_contents($filename2) . hr(1);
}


//var_dump(mkdir('dir1/dir2', 0775, true));
//var_dump(rmdir('dir1/dir2'));

//var_dump(chdir('../14_array_functions'));
//var_dump(getcwd()); // /var/www/php/php7/16_files_and_directories


hr();

//print_dir('.');

function print_dir ($filename, $prefix = '--') {
    if (is_null($filename)) {
        $filename = getcwd();
    }

    $a = opendir($filename) or die('Can\'t open directory ' . $filename);

    while (($e = readdir($a)) !== false) {
        if ($e == '.' || $e == '..') continue;
        echo $prefix . $e . br(1);
        var_dump(is_dir($e));
        if (is_dir($e)) {
            if (!chdir($e)) continue;
            print_dir(null, $prefix . "--");
        }
    }

    closedir($a);
}


debug(glob('*', GLOB_ONLYDIR));
debug(glob('*/*.txt', GLOB_MARK | GLOB_NOSORT));

?>

</body>
</html>