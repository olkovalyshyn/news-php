<?php
function setArticle($connect)
{
    if (isset($_POST["submitAddArticle"]) && isset($_COOKIE['user'])) {
        $login = $_POST['login'];
        $article = $_POST['article'];

        $sql = "INSERT INTO `news` (`login`, `article`) VALUE ('$login', '$article')";
        $result = $connect->query($sql);
    }
    // $connect->close();
}

function getArticle($connect)
{
    $sql = "SELECT * FROM `news`";
    $result = $connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo $row['article'];
        echo "
        <form action='/src/editArticle.php' method='POST'>
            <input type='hidden' name='id', value='" . $row['id'] . "'>
            <input type='hidden' name='login', value='" . $row['login'] . "'>
            <input type='hidden' name='article', value='" . $row['article'] . "'>
            <button>Edit</button>
        </form>
        ";
        echo "</div>";
    }
}

function editArticle($connect)
{
    echo "begin uddate";
    if (isset($_POST["submitAddArticle"]) && isset($_COOKIE['user'])) {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $article = $_POST['article'];

        $sql = "UPDATE `news` SET `article`='$article' WHERE `id` = '$id' AND `login` = '$login'";
        $result = $connect->query($sql);

        header("Location: /");
    }
}
