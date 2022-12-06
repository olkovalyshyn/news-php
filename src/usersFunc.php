    <?php
    echo $id;
    function delUser()
    {
        $id = $_POST['id'];
        echo $id;
        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "DELETE FROM `users` WHERE `id` = '$id' ";
        $result = $connect->query($sql);

        $connect->close();
    }
    // header("Location: /");
    // exit;
