<?php
$some_global_var = null;
/**
 * Выводит дамп массива или объекта
 *
 * Подробное описание функции: может занимать несколько строк.
 * В данном случае функция, принимая в качестве единственного
 * параметра $arr массив или объект, выводит его подробную структуру.
 * dump(['Hello', 'world', '!']);
 *
 * @param array|object $arr
 *
 * @return void
 */
function dump($arr)
{
    echo "<pre>";
    print_r($arr, 0);
    echo "</pre>";
}

function change_global_var()
{
    /**
     * @global array $GLOBALS["some_global_var"]
     * @name $some_global_var
     */
    $GLOBALS["some_global_var"] = "BlaBlaBla";
}