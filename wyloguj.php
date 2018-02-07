<?php
session_start();
session_destroy();
if(isset($_SESSION['login']))
unset($_SESSION['login']);

header("location: index.html");
die();
?>