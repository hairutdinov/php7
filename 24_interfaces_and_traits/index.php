<?php //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 24. Интерфейсы и трейты</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
interface Seo
{
    public function keywords();
    public function description();
    public function ogs();
}

interface Tag
{
    public function tags();
}

class Cached {}

class StaticPage extends Cached implements Seo, Tag
{

    public function keywords()
    {
        // TODO: Implement keywords() method.
    }

    public function description()
    {
        // TODO: Implement description() method.
    }

    public function ogs()
    {
        // TODO: Implement ogs() method.
    }

    public function tags()
    {
        // TODO: Implement tags() method.
    }
}


h2("Traits");

trait TagTrait
{
    public function tags()
    {
        echo "Tag::tags" . br(1);
    }
}

class News
{
    use TagTrait { tags as public myPrivateTags; }
}

$news = new News();
$news->myPrivateTags();


trait A
{
    public function small()
    {
        echo "a";
    }
    public function big()
    {
        echo "A";
    }
}

trait B
{
    public function small()
    {
        echo "b";
    }
    public function big()
    {
        echo "B";
    }
}


class C
{
    use A, B {
        B::small insteadof A;
        A::big insteadof B;
        B::big as b_big;
        A::small as a_smal;
    }
}


?>


</body>
</html>