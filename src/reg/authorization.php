<?php
$login = $_POST['login'];
$password = $_POST['password'];

$password = md5($password);

$connect = new mysqli('localhost', 'root', '', 'news-php');

$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
$result = $connect->query($sql);

$authuser = $result->fetch_assoc();

if (count($authuser) == 0) {
    echo "<h2>User with login $login not found!</h2>";
    exit();
}

setcookie('user', $authuser['login'], time() + 3600 * 24, "/");

$connect->close();

header('Location: /');
