<?php include_once "base.php";

unset($_SESSION[$_GET['table']]);
unset($_SESSION['cart']);

to('../index.php');

