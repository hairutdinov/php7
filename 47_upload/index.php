<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 47. Загрузка файлов на сервер</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
if (isset($_REQUEST["submit"])) {
    debug($_FILES["file"]);
    hr();
    switch ($_FILES["file"]["error"]) {
        case UPLOAD_ERR_OK:
            echo "OK";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "No file selected";
            break;
        case UPLOAD_ERR_INI_SIZE:
            echo "Max upload size";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "Max upload size from input attribute [size]";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "Разрыв соединения, файл не был докачен";
            break;
        default:
            echo "don't know";
    }
	hr();
	var_dump(is_uploaded_file($_FILES["file"]["tmp_name"]));
	hr();
    var_dump(move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]));

}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">OK</button>
</form>

</body>
</html>