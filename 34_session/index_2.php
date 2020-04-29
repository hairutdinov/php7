<?php
require_once "../functions.php";

h2("переопределение обработчиков");

function ses_fname($key) {
    return dirname(__FILE__) . "/sessiondata/".session_name()."/{$key}";
}

function ses_open($save_path, $ses_name) {
    return true;
}

function ses_close() {
    return true;
}

function ses_read($key) {
    $fname = ses_fname($key);
    return @file_get_contents($fname);
}

function ses_write($key, $val) {
    $fname = ses_fname($key);
    @mkdir(dirname(dirname($fname)), 0777);
    @mkdir(dirname($fname), 0777);
    @file_put_contents($fname, $val);
    return true;
}

function ses_destroy($key)
{
    return @unlink(ses_fname($key));
}

function ses_gc($maxlifetime)
{
    $dir = ses_fname(".");
    // Получаем доступ к каталогу текущей группы сессии
    foreach (glob("$dir/*") as $fname) {
    // Файл слишком старый?
        if (time() - filemtime($fname) >= $maxlifetime) {
            @unlink($fname);
            continue;
        }
    }
    // Если каталог не пуст, он не удалится - будет предупреждение.
    // Мы его подавляем. Если же пуст - удалится, что нам и нужно.
    @rmdir($dir);
    return true;
}

session_set_save_handler(
    "ses_open", "ses_close",
    "ses_read", "ses_write",
    "ses_destroy", "ses_gc"
);
// Для примера подключаемся к группе сессий test
session_name("test1");
session_start();
// Увеличиваем счетчик в сессии
$_SESSION['count'] = @$_SESSION['count'] + 1;