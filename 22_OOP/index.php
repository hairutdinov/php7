<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 22. Объекты и классы.</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
class MathComplex1
{
    public $re, $im;

    public function __construct($re = 0, $im = 0)
    {
        $this->re = $re;
        $this->im = $im;
    }

    public function add(MathComplex1 $y)
    {
        $this->re += $y->re;
        $this->im += $y->im;
    }

    public function __toString()
    {
        return "({$this->re}, {$this->im})";
    }
}

$obj_1 = new MathComplex1(1,2);
$obj_2 = new MathComplex1(2,3);
$obj_1->add($obj_2);
echo $obj_1;

hr();

class Log
{
    private $f, $lines = [];
    public $filename;

    public function __construct($filename = null)
    {
        $this->filename = $filename;
        $this->openFileToRead();
    }

    private function openFileToRead()
    {
        $this->f = fopen($this->filename, "a+t");
    }

    public function write($str = null)
    {
        if (is_null($str)) return false;
        $preffix = "[".date("Ymd_His")."_{$this->filename}] ";
        $str = preg_replace('#^#m', $preffix, rtrim($str));
        $this->lines[] = $str . "\n";
    }

    public function close()
    {
        fputs($this->f, implode("", $this->lines));
        fclose($this->f);
    }

    public function __destruct()
    {
        $this->close();
    }

}

$log = new Log('log.txt');
foreach (range(5, 10) as $i) {
//    $log->write("Hello#{$i}  ");
}

h2("Циклические ссылки");
class Father
{
    public $children = [];
    public function __destruct()
    {
        echo "Father died" . br(1);
    }
}

class Child
{
    public $father;
    public function __construct(Father $father)
    {
        $this->father = $father;
    }
    public function __destruct()
    {
        echo "Child died" . br(1);
    }
}

/*$father = new Father();
$child = new Child($father);
$father->children[] = $child; // Если убрать данную строку, не будет кольцевых ссылок и все будет ок
echo "Everyone is alive yet. Kill everybody" . br(1);
$father = $child = null;
echo "Everyone is dead" . br(1);*/

hr();

class Log2
{
    static public $loggers = [];
    private $time;

    public static function create($fname)
    {
        if ( isset(self::$loggers[$fname]) ) return self::$loggers[$fname];
        return self::$loggers[$fname] = new self($fname);
    }

    private function __construct($fname)
    {
        $this->time = microtime(true);
    }

    public function getTime()
    {
        return $this->time;
    }
}

$logger = Log2::create('log2.txt');
sleep(1);
$logger2 = Log2::create('log2.txt');
echo $logger->getTime() . br(1);
echo $logger2->getTime() . br(1);


class Hooker
{
    private $vars = [];

    public function __get($name)
    {
        echo "Getting value: {$name}" . br(1);
        return (isset($this->vars[$name])) ? $this->vars[$name] : null;
    }
    public function __set($name, $value)
    {
        echo "Setting ${name} = ${value}" . br(1);
        return $this->vars[$name] = trim($value);
    }

}

$h = new Hooker();
$h->abc = 123;
var_dump($h->abc);

hr();

h2("Клонирование объектов");

class Test
{
    public $a;
    public function __construct($a)
    {
        $this->a = $a;
    }
}

$t = new Test(123);
$t_clone = clone $t;
$t_clone->a = 222;


?>

</body>
</html>