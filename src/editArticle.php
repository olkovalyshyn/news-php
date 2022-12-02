<?php
include '../connect/connect.php';
include './addEditArticleFunc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News</title>
    <link rel="stylesheet" href="./style.css" />
</head>

<body>

    <?php
    $id = $_POST['id'];
    $loginWhichAddAtricle = $_POST['login'];
    $loginWhichRegisteredOnSite = $_COOKIE['user'];
    $article = $_POST['article'];

    echo $loginWhichAddAtricle . " loginWhichAddAtricle" . "<br>";
    echo $loginWhichRegisteredOnSite . " loginWhichRegiseredOnSite" . "<br>";
    echo $loginWhichAddAtricle !== $loginWhichRegisteredOnSite . " TRUE or FALSE" . "<br>";

    if ($loginWhichAddAtricle === $loginWhichRegisteredOnSite || $loginWhichRegisteredOnSite === "admin") {
        echo "<form action='" . editArticle($connect) . "' method='post'>
              <input type='hidden' name='id' value='" . $id . "'>
                <input type='hidden' name='login' value='" . $loginWhichAddAtricle . "'>
                <textarea name='article'>" .  $article . "</textarea>
                <button type='submit' name='submitAddArticle'>Edit article</button>
            </form>";
    }
    // else echo "Оnly the article owner or admin can edit!";
    ?>


</body>

</html>