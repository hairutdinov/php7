<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 40. Сервер memcached </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
var_dump(session_start());
echo session_save_path();

$m = new Memcached();
/*$m->addServer('localhost', 11211, 1);*/
$m->addServers([
    ['localhost', 11211, 1],
]);

debug($m->getServerList());

if ($m->add("key", "value")) {
    echo "Значение успешно установлено: " . $m->get("key");
} else {
    echo $m->getResultMessage(); // NOT STORED
}

br();

if (!($key = $m->get('key_2'))) {
    if ($m->getResultCode() == Memcached::RES_NOTFOUND) {
        $key = 'value';
        $m->add('key_2', $key);
    }
}

echo $key;
br();
/*$m->setOption(Memcached::OPT_COMPRESSION, false);
if ($m->append("key", "123")) {
	echo "Значение успешно установлено: " . $m->get("key");
}*/


/*$m->setOption(Memcached::OPT_COMPRESSION, false);
if ($m->prepend("key", "___")) {
	echo "Значение успешно установлено: " . $m->get("key");
}*/

h2("Обработка ошибок");

if(!$m->set("key", "value2")) echo $m->getResultMessage()."<br />";
echo $m->get("key") . br(1); // value2
if (!$m->replace("key_3", "value_3")) echo $m->getResultMessage() . br(1);

h2("Замена данных в memcached");

$m->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
$m->increment('index_1', 1, 0);
echo $m->get('index_1') . br(1);


$values = [];
foreach (range(1,3) as $i) {
    $values["key__{$i}"] = "value__{$i}";
}

$m->setMulti($values);

h2("Извлечение данных из memcached");
$m->getDelayed(array_keys($values));
while ($result = $m->fetch()) {
    echo $result["value"] . br(1);
}

h2("Удаление данных из memcached");

//$m->add('will_be_deleted', 123);
echo $m->get('will_be_deleted') . br(1);
$m->delete('will_be_deleted', 60);
if (!$m->add('will_be_deleted', 456)) echo $m->getResultMessage(). br(1);


h2("Установка времени жизни");
$m->touch('key__1', 60);

$m->quit();
?>

</body>
</html>