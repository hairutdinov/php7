<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 23. Наследование.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
class Base
{
    public final function test()
    {
        echo "echo from " . __CLASS__ . br(1);
    }
}

class Derived extends Base
{
    /*public function test() {
        echo "echo from " . __CLASS__;
    }*/
}

$b = new Base();
$b->test();

$d = new Derived();
$d->test();

h2("self не позволяет переопределить метод");

class Base2
{
    public static function title()
    {
        echo __CLASS__ . br(1);
    }

    public static function test()
    {
        // self::title();
        static::title();
    }
}

class Derived2 extends Base2
{
    public static function title()
    {
        echo __CLASS__ . br(1);
    }
}

Derived2::test();



?>

</body>
</html>