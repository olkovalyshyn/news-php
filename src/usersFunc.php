    <?php
    echo $id;
    function deleteUsers()
    {
        $id = $_POST['id'];
        echo $id;
        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "DELETE FROM `users` WHERE `id` = '$id' ";
        $result = $connect->query($sql);

        $connect->close();
    }
    header("Location: /");
