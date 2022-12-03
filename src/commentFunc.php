<?php
function setComment()
{
    if (isset($_POST["submitAddComment"]) && isset($_COOKIE['user'])) {
        $login = $_POST['login'];
        $article = $_POST['article'];
        $comment = $_POST['comment'];

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "INSERT INTO `comments` (`login`, `article`, `comment`) VALUE ('$login', '$article', '$comment')";
        $result = $connect->query($sql);

        $connect->close();
    }
}

function getComment()
{
    $connect = new mysqli('localhost', 'root', '', 'news-php');
    $sql = "SELECT * FROM `comments`";
    $result = $connect->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='article-section'>";
        echo "<p>" . $row['comment'] . "</p>";
        echo "
        <form action='/src/editArticle.php' method='POST'>
            <input type='hidden' name='id', value='" . $row['id'] . "'>
            <input type='hidden' name='login', value='" . $row['login'] . "'>
            <input type='hidden' name='article', value='" . $row['article'] . "'>
            <button class='article-btn'>Edit</button>
        </form>
        ";
        echo "
        <form action='" . deleteArticle() . "' method='POST'>
            <input type='hidden' name='id', value='" . $row['id'] . "'>
            <input type='hidden' name='login', value='" . $row['login'] . "'>
            <input type='hidden' name='article', value='" . $row['article'] . "'>
            <button class='article-btn'>Delete</button>
        </form>
        ";

        echo "</div>";
    }
    $connect->close();
}

// function editComment()
// {
//     if (isset($_POST["submitEditArticle"]) && isset($_COOKIE['user'])) {
//         $id = $_POST['id'];
//         $login = $_POST['login'];
//         $article = $_POST['article'];

//         $connect = new mysqli('localhost', 'root', '', 'news-php');
//         $sql = "UPDATE `news` SET `article`='$article' WHERE `id` = '$id' AND `login` = '$login'";
//         $result = $connect->query($sql);

//         $connect->close();

//         header("Location: /");
//     }
// }

// function deleteComment()
// {
//     $id = $_POST['id'];
//     $loginWhichAddAtricle = $_POST['login'];
//     $loginWhichRegisteredOnSite = $_COOKIE['user'];
//     $article = $_POST['article'];

//     if ($loginWhichAddAtricle === $loginWhichRegisteredOnSite || $loginWhichRegisteredOnSite === "admin") {

//         $connect = new mysqli('localhost', 'root', '', 'news-php');
//         $sql = "DELETE FROM `news` WHERE `id` = '$id' AND `login` = '$loginWhichAddAtricle'";
//         $result = $connect->query($sql);

//         $connect->close();

//         header("Location: /");
//     }
// }
