<?php
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];

$password = md5($password);

$connect = new mysqli('localhost', 'root', '', 'news-php');
$connect->query("INSERT INTO `users` (`email`, `login`, `password`)
 VALUES('$email','$login','$password')");

$connect->close();

header('Location: /');
