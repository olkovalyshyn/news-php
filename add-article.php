<?php
$login = $_COOKIE["user"];
$article = $_POST["article"];

$connect = new mysqli('localhost', 'root', '', 'news-php');
$connect->query("INSERT INTO `news` (`login`,`article`) 
VALUES('$login','$article')");

$connect->close();

header('Location: /');
