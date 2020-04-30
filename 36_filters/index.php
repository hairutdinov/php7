<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 36. Фильтрация и проверка данных. </title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
$email_correct = 'igorsimdyanov@gmail.com';
$email_wrong = 'igorsimdyanov@//gmail.com';

echo filter_var($email_correct, FILTER_VALIDATE_EMAIL) . br(1);
echo filter_var($email_wrong, FILTER_VALIDATE_EMAIL) . br(1);

$options = [
    'options' => [
        'min_range' => 1,
        'max_range' => 10,
        'default' => 1,
    ]
];
var_dump( filter_var(100, FILTER_VALIDATE_INT, $options) );
br();

$data = [
    'age' => 17,
    'email' => 'b@radic.ru',
    'password' => '123456'
];

$defenition = [
    'age' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 18, 'max_range' => 100],
    ],
    'email' => [
        'filter' => FILTER_VALIDATE_EMAIL,
    ],
    'password' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '#^[0-9a-z_]{8,}$#'],
    ],
];

$result = filter_var_array($data, $defenition);
debug($result);
br();


$html = "<?php echo '123' ?>";
$html = filter_var($html, FILTER_SANITIZE_SPECIAL_CHARS) . br(1);
echo $html;

echo filter_var($html, FILTER_CALLBACK, ['options' => function($v) {return strtoupper($v);}]);


$value = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result  = filter_input(INPUT_POST, 'search', FILTER_CALLBACK, [
    'options' => function ($v) {
        $value = preg_replace_callback(
            "/\b([^\s]+?)\b/u",
            function($match) {
                if(mb_strlen($match[1]) > 3)
                    return $match[1];
                else
                    return '';
            },
            $v);
        return strip_tags($value);
    },
]);

var_dump($result);

?>

<form method="POST">
    <input type="text" name="search">
    <button type="submit">Submit</button>
</form>

</body>
</html>