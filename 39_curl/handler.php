<?php
if (isset($_POST["submit"])) {
    echo htmlspecialchars($_POST["first_name"]) . br(1);
    echo htmlspecialchars($_POST["password"]) . br(1);
}