<?php
function setComment()
{
    if (isset($_POST["submitSetComment"]) && isset($_COOKIE['user'])) {
        $article_id = $_POST['article_id'];
        $login = $_POST['login'];
        $article = $_POST['article'];
        $comment = $_POST['comment'];

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "INSERT INTO `comments` (`article_id`, `login`, `article`, `comment`) VALUE ('$article_id', '$login', '$article', '$comment')";
        $result = $connect->query($sql);

        $connect->close();
        exit();
    }
}

function getComment($contolId)
{
    $connect = new mysqli('localhost', 'root', '', 'news-php');
    $sql = "SELECT * FROM `comments`";
    $result = $connect->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='article-section'>";

        if ($contolId === $row['article_id']) {
            echo "<p class='owner'> Author: " . $row['login'] . "</p>";
            echo "<p>" . $row['comment'] . "</p>";

            echo "
        <form action='/src/editComment.php' method='POST'>
            <input type='hidden' name='id', value='" . $row['id'] . "'>
            <input type='hidden' name='login', value='" . $row['login'] . "'>
            <input type='hidden' name='comment', value='" . $row['comment'] . "'>
            <button class='article-btn'>Edit</button>
        </form>
        ";
            echo "
        <form action='" . deleteComment() . "' method='POST'>
            <input type='hidden' name='id', value='" . $row['id'] . "'>
            <input type='hidden' name='login', value='" . $row['login'] . "'>
            <input type='hidden' name='comment', value='" . $row['comment'] . "'>
            <button class='article-btn'>Delete</button>
        </form>
        ";
        }
        echo "</div>";
    }
    $connect->close();
}

function editComment()
{
    if (isset($_POST["submitEditComment"]) && isset($_COOKIE['user'])) {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $comment = $_POST['comment'];

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "UPDATE `comments` SET `comment`='$comment' WHERE `id` = '$id' AND `login` = '$login'";
        $result = $connect->query($sql);

        $connect->close();

        header("Location: /");
    }
}

function deleteComment()
{
    $id = $_POST['id'];
    $loginWhichAddComment = $_POST['login'];
    $loginWhichRegisteredOnSite = $_COOKIE['user'];
    $comment = $_POST['comment'];

    if ($loginWhichAddComment === $loginWhichRegisteredOnSite || $loginWhichRegisteredOnSite === "admin") {

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "DELETE FROM `comments` WHERE `id` = '$id' AND `login` = '$loginWhichAddComment'";
        $result = $connect->query($sql);

        $connect->close();

        header("Location: /");
    }
}
