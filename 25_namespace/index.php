<?php
//declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 25. Пространство имен</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
/*require_once "SomeClass.php";
$a = new php7\SomeClass();
$a->setName("123");
php7\functions\debug(123);*/

/*require_once "PHP7/SeoTrait.php";
require_once "PHP7/TagTrait.php";
require_once "PHP7/Page.php";*/


try {
    spl_autoload_register(function ($class) {
        require_once(__DIR__  . "/".str_replace("\\", "/", $class).".php");
    });
} catch (\Exception $e) {
    echo $e->getMessage();
}

$page = new PHP7\Page();
$page->getSeo();

?>

</body>
</html>