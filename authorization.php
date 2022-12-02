<?php
$login = $_POST['login'];
$password = $_POST['password'];

$password = md5($password);

$connect = new mysqli('localhost', 'root', '', 'news-php');

$result = $connect->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

$authuser = $result->fetch_assoc();

if (count($authuser) == 0) {
    echo "Користувача з логіном $login не знайдено";
    exit();
}

setcookie('user', $authuser['login'], time() + 3600 * 24, "/");

$connect->close();

header('Location: /');
