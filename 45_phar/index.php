<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 45. PHAR-архивы</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

//require_once "phar://ispager.phar/phpinfo.php";

try {
	$phar = new Phar('./ispager.phar', 0, 'ispager.phar');
	if (Phar::canWrite()) {
        $phar->startBuffering();

        /*$phar->buildFromIterator(new DirectoryIterator(realpath('../41_composer/vendor')), '../41_composer');*/

        /* класс Phar реализует интерфейс ArrayAccess: */
        $phar["phpinfo.php"] = '<?php phpinfo();';

        $phar->stopBuffering();
	} else {
		throw new \PharException('Cannot write');
	}

} catch (\Exception $e) {
    echo $e->getMessage();
}

var_dump(Phar::canCompress());

?>

</body>
</html>