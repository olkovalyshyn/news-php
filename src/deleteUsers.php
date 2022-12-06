<?php
include './usersFunc.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin page</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

    <?php
    if (isset($_POST["submitDelUsers"])) {
        $connect = new mysqli('localhost', 'root', '', 'news-php');
        $sql = "SELECT * FROM `users`";
        $result = $connect->query($sql);

        echo "<div class='delUsers_form'>";
        echo "<h2>Delete users</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='delUsers_item'>";
            echo "<p>" . $row['login'] . "</p>";
            echo "<form action='" . delUser() . "' method='POST'>
        <input type='hidden' name='id' value='" . $row['id'] . "'>
        <input type='hidden' name='login' >
        <button type='submit'>Delete</button>
        </form>";
            echo "</div>";
        }
        echo "</div>";

        $connect->close();
    }
    ?>


</body>

</html>