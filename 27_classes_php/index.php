<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 27. Предопределенные классы PHP</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php

h2("Class Directory");
$dirname = "../";
$cat = dir($dirname);

$files_count = 0;
$dirs_count = 0;

while (($file = $cat->read()) !== false) {
    if (is_file($dirname.$file)) $files_count++;
    else $dirs_count++;
}

$dirs_count -= 2;

echo nl2br("Files: ${files_count}\nDirs: ${dirs_count}\n");

$cat->rewind();

while (($file = $cat->read()) !== false) {
    if ($file == "." || $file == "..") continue;
    echo $file . br(1);
}

$cat->close();

h2("Class Generator");

function gen($from = 1, $to = 5) {
    foreach (range($from, $to) as $i) {
        yield $i;
    }
}

$obj = gen(1,5);

while ($obj->valid()) {
    echo $obj->current() . br(1);
    $obj->next();
}


h2("Class Closure");

$message = "You have errors!<br>";
$check = function ($errors = []) use ($message) {
    if (sizeof($errors) > 0)
        echo $message;
};

debug($check);


class View {
    protected $pages = [], $title = 'Contacts', $body = 'Content of the page Contacts';

    public function addPage($page, $callback)
    {
        $this->pages[$page] = $callback->bindTo($this, __CLASS__);
    }

    public function render($page)
    {
        $this->pages[$page]();
        $content = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$this->title()}</title>
</head>
<body>
    {$this->body()}
</body>
</html>
HTML;
        echo $content;
    }

    public function title()
    {
        return htmlspecialchars($this->title);
    }

    public function body()
    {
        return htmlspecialchars($this->body);
    }

}

$view = new View();
$view->addPage("about", function () {
    $this->title = 'About';
    $this->body = 'About page content <?php echo 123; ?>';
});
$view->render('about');


h2("Класс IntlChar");
echo IntlChar::toupper("б") . br(1);
echo IntlChar::isalnum("j") . br(1);

?>

</body>
</html>