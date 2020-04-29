<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 29. Итераторы</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

class Monolog
{
    public $first = "It's him.";
    protected $second = "The Anomaly.";
    private $third = "Do we proceed?";
    protected $fourth = "Yes.";
    private $fifth = "He is still...";
    public $sixth = "...only human.";
}

$monolog = new Monolog();
foreach ($monolog as $k => $v) {
    echo "$k: $v<br>";
}

hr();

require_once "FS.php";
$d = new FSDirectory("../");
foreach ($d as $path => $entry) {
    if ($entry instanceof FSFile) {
        // Если это файл, а не подкаталог...
        echo "<b>$path</b>: " . $entry->getSize() . "<br>";
    }
}

hr();

class InsensitiveArray implements ArrayAccess
{
    // Здесь будем хранить массив элементов в нижнем регистре
    private $a = [];

    public function offsetExists($offset)
    {
        $offset = strtolower($offset);
        $this->log("offsetExists({$offset})");
        return isset($this->a[$offset]);
    }

    public function offsetGet($offset)
    {
        $offset = strtolower($offset);
        $this->log("offsetGet({$offset})");
        return $this->a[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $offset = strtolower($offset);
        $this->log("offsetSet({$offset}) = {$value}");
        $this->a[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        $offset = strtolower($offset);
        $this->log("offsetUnset({$offset})");
        unset($this->a[$offset]);
    }

    public function log($str) {
        echo $str . br(1);
    }
}

$a = new InsensitiveArray();
$a['php'] = "First set";
$a['PhP'] = "Second set";
echo $a["php"] . br(1);
unset($a["php"]);

h2("Библиотека SPL");
/* По умолчанию PHP предоставляет пользователю некоторое число готовых классов и
интерфейсов, встроенных в язык. Их собрание называется SPL (Standard PHP Library,
стандартная библиотека PHP).
 * */

h2("Класс DirectoryIterator");

$dir = new DirectoryIterator("../");
foreach ($dir as $file) {
    echo "<b>{$file}</b>. Type: {$file->getType()}. Path: {$file->getPathname()}. Size: {$file->getSize()}" . br(1);
}

hr();

h2("Класс FilterIterator");

class ExtensionIterator extends FilterIterator {
    private $iterator, $ext;
    public function __construct(DirectoryIterator $iterator, $ext)
    {
        parent::__construct($iterator);
        $this->iterator = $iterator;
        $this->ext = $ext;
    }

    public function accept()
    {
        if (!$this->iterator->isDir()) {
            $ext = pathinfo($this->current(), PATHINFO_EXTENSION);
            return $ext !== $this->ext;
        }
        return true;
    }
}

$filter = new ExtensionIterator(new DirectoryIterator('../'), 'php');
foreach ($filter as $file) {
    echo $file . br(1);
}

hr();

h2("Класс LimitIterator");
/* Класс LimitIterator и его производные позволяют осуществить постраничный вывод. */

$limit = new LimitIterator($filter, 0,5);
foreach ($limit as $file) {
    echo $file . br(1);
}

h2("Рекурсивные итераторы");
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("../"), true);

/*foreach ($dir as $file) {
    echo str_repeat("-", $dir->getDepth()) . $file . br(1);
}*/

h2("Аппарат отражений");
/* Термин отражение (reflection) в ООП обозначает некоторый встроенный в язык класс,
объект которого хранит информацию о структуре самой программы. Фактически отра-
жение — это информация об информации (или, как еще говорят, метаданные).
 * */

/**
 * @param string $which
 * @return void
 * */
function throughTheDoor(string $which) {
    static $count = 0;
    $count++;
    echo "(get through the $which door)\n" . $count ;
}

try {
    $func = new ReflectionFunction('throughTheDoor');
    $func->invoke('left');
    br();
    print_r($func->getEndLine());
    br();
    var_dump($func->isInternal()); // является ли встроенной
    br();
    echo $func->getDocComment();
    br();
    debug($func->getStaticVariables());
    br();
    foreach ($func->getParameters() as $parameter) {
        echo $parameter->getName() . br(1);
        echo $parameter->getClass() . br(1); //возвращает тип аргумента, если он был уточнен
    }
} catch (\ReflectionException $e) {
    debug($e);
}

hr("Класс: ReflectionClass");

$cls = new ReflectionClass('ReflectionException');
echo "<pre>{$cls}</pre>";
debug(Reflection::getModifierNames($cls->getModifiers()));
debug($cls->getInterfaces());
debug($cls->getParentClass());
var_dump($cls->isInstantiable()); // вернет истинное значение, если объект текущего класса можно создать при помощи оператора new (т. е. класс не является интерфейсом и не абстрактный).

/*$consts = [];
foreach (get_loaded_extensions() as $name) {
    $ext = new ReflectionExtension($name);
    $consts = array_merge($consts, $ext->getConstants());
}
echo "<pre>".var_export($consts, true)."</pre>";*/


?>

</body>
</html>