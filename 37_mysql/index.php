<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 37. Работа с СУБД MySQL </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ejo_7;charset=utf8', 'root', '123456', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (\PDOException $e) {
    echo $e;
}

$ver = $pdo->query("SELECT VERSION() as version")->fetch(PDO::FETCH_ASSOC);
echo $ver["version"];


try {
    $user = $pdo->prepare("select * from user where id = :id");
    $user->execute(['id' => 1]);
    debug($user->fetch(PDO::FETCH_ASSOC));
} catch (\PDOException $e) {
    echo $e;
}

?>

</body>
</html>