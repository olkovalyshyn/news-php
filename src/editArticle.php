<?php
include './articleFunc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit news</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

    <?php
    $id = $_POST['id'];
    $loginWhichAddAtricle = $_POST['login'];
    $loginWhichRegisteredOnSite = $_COOKIE['user'];
    $article = $_POST['article'];

    // echo $loginWhichAddAtricle . " loginWhichAddAtricle" . "<br>";
    // echo $loginWhichRegisteredOnSite . " loginWhichRegiseredOnSite" . "<br>";
    // echo $loginWhichAddAtricle !== $loginWhichRegisteredOnSite . " TRUE or FALSE" . "<br>";

    if ($loginWhichAddAtricle === $loginWhichRegisteredOnSite || $loginWhichRegisteredOnSite === "admin") {
        echo "<div class='auth-block'>";
        echo "<h2>Edit article</h2>";
        echo "<form class='auth-form' action='" . editArticle() . "' method='post'>
              <input type='hidden' name='id' value='" . $id . "'>
                <input type='hidden' name='login' value='" . $loginWhichAddAtricle . "'>
                <textarea class='auth-item' name='article'>" .  $article . "</textarea>
                <button class='auth-btn' type='submit' name='submitEditArticle'>Edit article</button>
            </form>";
        echo "</div>";
    } else echo "<p class='condition'>Оnly the article owner or admin can edit!</p>" . "<a class='edit-btn' href='/'>OK</a>";
    ?>


</body>

</html>