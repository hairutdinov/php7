<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 49. Перехват выходного потока </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
ob_start();
    // Следующий текст попадет в 1-й буфер.
    echo "From delusion lead me to truth.<br />\n";
    // Откладываем на время буфер 1 и активизируем второй.
    ob_start();
        // Текст попадет в буфер 2.
        echo "From death lead me to immortality.<br />\n";
        // Получаем текст во втором буфере.
        $second = ob_get_contents();
        // Отключает (без вывода в браузер) буфер 2 и активизируем первый.
    ob_end_clean();
    // Попадет опять в буфер 1.
    echo "From darkness lead me to light.<br />\n";
    // Получаем текст в первом буфере.
    $first = ob_get_contents();
// Т.к. это последний буфер, буферизация отключается.
ob_end_clean();

// Обрабатываем буферы для более "красивого" вывода.
$first  = preg_replace('/^/m', '&nbsp;&nbsp;', trim($first));
$second = preg_replace('/^/m', '&nbsp;&nbsp;', trim($second));
// Распечатываем значения буферов, которые мы сохранили в массиве.
echo "<i>Содержимое первого буфера:</i><br />$first";
echo "<i>Содержимое второго буфера:</i><br />$second";

hr();

try {
	spl_autoload_register(function ($class) {
		require_once(__DIR__  . "/".str_replace("\\", "/", $class).".php");
	});
} catch (\Exception $e) {
	echo $e->getMessage();
}
// Перехватываем выходной поток в программе
$h = new \Buffering\Output();
// Текст попадет в буфер
echo "Начало внешнего перехвата.<br />";
// Вызываем функцию, "не зная", что она перехватывает вывод
$formatted = inner();
// Печатаем еще текст в буфер
echo "Конец внешнего перехвата.";
// Формируем некоторый текст по шаблону
$text = "{$h->__toString()}<br>Функция вернула: \"$formatted\"";
// Завершаем перехват. Буфер освободится автоматически в деструкторе.
$h = null;
// Печатаем то, что накопили в переменной, и заканчиваем работу
echo $text;
exit();
// Функция, перехватывающая выходной поток в своих целях,
// гарантирует, что при выходе буфер будет восстановлен
function inner()
{
	$buf = new \Buffering\Output();
	echo "Этот текст попадет в буфер.";
	return "<b>{$buf->__toString()}</b>";
// Не нужно заботиться о ручном вызове ob_end_clean().
// Это автоматически делает деструктор объекта $buf!
}
?>

</body>
</html>