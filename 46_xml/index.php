<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 46. XML</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
$content = file_get_contents('rss.xml');
$rss = new SimpleXMLElement($content);
echo "Count items: " . $rss->channel->item->count() . br(1);
foreach ($rss->channel->item as $item) {
    echo date("d.m.Y H:i", strtotime($item->pubDate)) . br(1);
    echo $item->title . hr(1);
}

foreach ($rss->channel->item[0]->enclosure->attributes() as $n => $v) {
    echo "{$n}: {$v}" . br(1);
}

hr();

foreach ($rss->xpath('//enclosure') as $enclosure) {
    echo $enclosure["url"] . br(1);
}

?>

</body>
</html>