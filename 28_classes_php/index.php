<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 28. Календарные классы PHP</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

$date = new DateTime();
echo $date->format("d.m.Y H:i:s") . br(1);
echo $date->format(DateTime::ATOM) . br(1);

//$date_2 = new DateTime("2020-04-27 07:20:00", new DateTimeZone("Europe/London"));
$date_2 = new DateTime("2020-04-27 10:20:00");
echo $date_2->format(DateTime::ATOM);


h2("Класс DateInterval");

$interval = $date->diff($date_2);
debug($interval);

$nowdate = new \DateTime();
echo $nowdate->sub(new DateInterval("P2Y3M8DT12H47M"))->format("d.m.Y H:i");

h2("Класс DatePeriod");
$date = new \DateTime("2020-04-28 13:10:00"); // start_date

$interval = new \DateInterval("P0DT30M"); // interval 30 minutes

$end = new \DateTime("2020-04-28 16:00:00"); // end_date

$period = new DatePeriod($date, $interval, $end); // creating period

foreach ($period as $datetime) {
    echo $datetime->format("d.m.Y H:i") . br(1);
}

?>

</body>
</html>