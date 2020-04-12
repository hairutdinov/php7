<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 19. Работа с датой и временем.</title>
    <style>
        table {

        }

        table tr td, table tr th {
            border: 1px solid #c5c5c5;
            padding: 5px;
        }
    </style>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

date_default_timezone_set('Europe/Moscow');

h2("Представление времени в формате timestamp");
echo time() . br(1); // секунды с начала эпохи UNIX 1 января 1970 года по Гринвичу

echo strftime('%b') . br(1); // Apr

//h2("");

echo gregoriantojd(04, 12, 1552)  . br(1);
echo jddayofweek(gregoriantojd(04, 12, 1552), 1) . br(1);

var_dump(checkdate(02, 29, 2019));

hr();

$month = intval(date("m"));

$days_count = date("t", mktime(0,0,0, $month, 1, date("Y")));
$calendar_arr = [];

foreach (range(1, $days_count) as $day) {
    $timestamp = mktime(0, 0, 0, $month, $day, date("Y"));

    $number_of_year_week = date("W", $timestamp);
    $day_of_the_week = (int)date("N", $timestamp);

    $calendar_arr[$number_of_year_week][$day_of_the_week] = $day;
}

?>


<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>Номер недели</th>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вск</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($calendar_arr as $day_of_week_year => $week): ?>
            <tr>
                <td><?= $day_of_week_year ?></td>
                <?php foreach (range(1,7) as $day_of_the_week): ?>
                <td>
                    <?= $week[$day_of_the_week] ?? null ?>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
h2("Перевод времени по Гринвичу");
function local2gr($lc_timestamp = false) {
    $lc_timestamp = $lc_timestamp ?? time();
    return $lc_timestamp - intval(date("Z", $lc_timestamp));
}

function gr2local($gr_timestamp = false, $tzOffsetInHours = false) {
    $gr_timestamp = $gr_timestamp ?? time();
    $tzOffsetInSeconds = ($tzOffsetInHours * 60 * 60) ?? intval(date("Z", $gr_timestamp));
    return $gr_timestamp + $tzOffsetInSeconds;
}

$lc_timestamp = time();
$gr_timestamp = local2gr($lc_timestamp);
$lc_timestamp_2 = gr2local($gr_timestamp, 10);

echo date("H:i:s", $lc_timestamp_2);

?>

</body>
</html>