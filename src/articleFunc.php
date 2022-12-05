<?php
include './connect/connect.php';

function setArticle($connectDB)
{
    if (isset($_POST["submitAddArticle"]) && isset($_COOKIE['user'])) {
        $login = $_POST['login'];
        $article = $_POST['article'];

        // $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "INSERT INTO `news` (`login`, `article`) VALUE ('$login', '$article')";
        $result = $connectDB->query($sql);

        $connectDB->close();
    }
}

function getArticle()
{
    $connect = new mysqli('localhost', 'root', '', 'news-php');
    $sql = "SELECT * FROM `news`";
    $result = $connect->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='article-section'>";
        echo "<div class='flex-container'>";
        echo "<div class='article-text'>";
        echo "<p class='owner'> Author: " . $row['login'] . "</p>";
        echo "<p>" . $row['article'] . "</p>";
        echo "</div>";

        echo "<div class='btn-block'>";
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
        echo "</div>";

        echo "<div class='comment-section'>";
        echo "<form class='setComment-form' action='" . setComment() . "' method='post'>
      <input type='hidden' name='article_id' value=" . $row['id']  . ">
      <input type='hidden' name='login' value='" . $_COOKIE['user'] . "'>
      <input type='hidden' name='article' value='" . $row['article'] . "'>
      <textarea class='setComment-text' name='comment' placeholder='...here input your comment...'></textarea>
      <button class='setComment-btn' type='submit' name='submitSetComment'>Add comment</button>
      </form>";
        $contolId = $row['id'];
        echo getComment($contolId);

        echo "</div>";
        echo "</div>";
    }

    $connect->close();
}

function editArticle()
{
    if (isset($_POST["submitEditArticle"]) && isset($_COOKIE['user'])) {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $article = $_POST['article'];

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "UPDATE `news` SET `article`='$article' WHERE `id` = '$id' AND `login` = '$login'";
        $result = $connect->query($sql);

        $connect->close();

        header("Location: /");
    }
}

function deleteArticle()
{
    $id = $_POST['id'];
    $loginWhichAddAtricle = $_POST['login'];
    $loginWhichRegisteredOnSite = $_COOKIE['user'];
    $article = $_POST['article'];

    if ($loginWhichAddAtricle === $loginWhichRegisteredOnSite || $loginWhichRegisteredOnSite === "admin") {

        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "DELETE FROM `news` WHERE `id` = '$id' AND `login` = '$loginWhichAddAtricle'";
        $result = $connect->query($sql);

        $connect->close();

        header("Location: /");
    }
}
