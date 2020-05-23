<?php
## Внутренний редирект (только в CGI-версии PHP!)
header("Status: 200 OK");
$dir = dirname($_SERVER["SCRIPT_NAME"]);
if ($dir == "\\") $dir = "";
$filename = "result.php";
header("Location: $filename");
exit();