<?php
setcookie('user', $authuser['login'], time() - 3600 * 24, "/");
header("Location: /");
