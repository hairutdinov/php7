<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 26. Обработка ошибок и исключения</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

/*
 * Лучше всего держать в файле php.ini максимально возможный режим контроля ошибок — E_ALL
 * */

//error_reporting(E_ALL~E_NOTICE);
//ini_set("error_reporting", E_ALL~E_NOTICE) ;

//ini_set("display_errors", "on"); // все сообщения об ошибках и предупреждения выводятся в браузер пользователя, запустившего сценарий.
//ini_set("log_errors", "on"); // сообщения дополнительно попадают и в файл журнала
//ini_set("error_log", "/home/bulat/log.txt");

//error_reporting(E_ALL);


/*ini_set("error_log", "log.txt");
var_dump(ini_set("log_errors", true));
$f = fopen("some.txt", "r");*/




function myErrorHandler($errno, $msg, $file, $line) {
    if (error_reporting() == 0) return; // для оператора @, потому что на время своего выполнения он ставит error_reporting = 0
    echo <<<MESSAGE
        <div style="color: #721c24;background-color: #f8d7da;position: relative;padding: .75rem 1.25rem;margin: 20px 0;border: 1px solid #f5c6cb;border-radius: .25rem;">
            <p>Произошла ошибка с кодом $errno</p>
            <p>Файл $file, строка $line</p>
            <p>Текст ошибки <pre>$msg</pre></p>
        </div>
MESSAGE;
}

set_error_handler('myErrorHandler', E_ALL);
/*$f = fopen('somefile.txt');*/
$f = @fopen('somefile.txt');

h2("Генерирование ошибок: E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE");
function print_age (int $age) {
    if ($age <= 0) {
        trigger_error("Функция print_age(): возраст не может быть <= 0", E_USER_ERROR);
    }
    echo "Age = $age" . br(1);
}

/*print_age(-12);*/

h2("Стек вызовов функций");

function inner ($a) {
    echo "<pre>".print_r(debug_backtrace(), 1)."</pre>";
}

function outer($x) {
    inner($x);
}

outer(123);

try {
    // Область перехвата
} catch (Exception $e) {
    echo $e->getMessage(); // Код обработчика исключения
}

h2("Раскрутка стека");
try {
    echo "Start try-block" . br(1);
    outer_2();
    echo "End try-block";
} catch (Exception $e) {
    echo $e->getMessage() . br(1);
}

function outer_2() {
    echo "Start " . __METHOD__ . br(1);
    inner_2();
    echo "End " . __METHOD__ . br(1);
}

function inner_2() {
    echo "Start " . __METHOD__ . br(1);
    throw new Exception('Throw Exception');
    echo "End " . __METHOD__ . br(1);
}

h2("Классификация и наследование");
class FilesystemException extends \Exception
{
    private $name;
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->name = $message;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
class FileNotFoundException extends FilesystemException {}
class FileWriteException extends FilesystemException {}

try {
    if (!file_exists("spoon"))
        throw new FileNotFoundException('File spoon not found');
} catch (FilesystemException $e) {
    echo "Ошибка при работе с файлом: " . $e->getName() . " [ Line: " . $e->getLine() . " ]\n";
} catch (\Exception $e) {
    echo "Другое исключение: " . $e->getMessage() . "\n";
}


h2("Использование интерфейсов");
interface IException {}
    interface IInternalException extends IException {}
        interface IFileException extends IInternalException {}
        interface INetException extends IInternalException {}
    interface IUserException extends IException {}

class iFileNotFoundException extends Exception implements IFileException {}
class WrongPassException extends Exception implements IUserException {}
class NetPrinterWriteException extends Exception implements IFileException, INetException {}

try {
    printDocument();
} catch (IFileException $e) {
    echo "Файловая ошибка: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Неизвестное исключение: <pre>" . $e . "</pre>";
}

function printDocument() {
    $printer = "//./printer";
    if (!file_exists($printer))
        throw new NetPrinterWriteException($printer);
}

/*$obj = new iFileNotFoundException();
var_dump($obj instanceof IInternalException);*/



?>


</body>
</html>