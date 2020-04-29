<?php  //declare(strict_types = 1); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Глава 34. Управление сессиями</title>
</head>
<body>

<?php require_once "../functions.php" ?>

<?php
// session_name("PHPSESSID_2"); // by default => PHPSESSID

if (!session_start()) echo "Session isn't open";
if (!isset($_SESSION["count"])) $_SESSION["count"] = 0;
$_SESSION["count"] += 1;
echo "Count: " . $_SESSION["count"];
br();
echo session_name();
br();
echo session_id();
br();
echo session_save_path();
br();

$forum_session =& $_SESSION["forum_subsytem"];
if (!isset($forum_session["count"])) $forum_session["count"] = 0;
$forum_session["count"] += 1;
echo $forum_session["count"];



?>

</body>
</html>