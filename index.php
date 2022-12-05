<?php
include './src/articleFunc.php';
include './src/commentFunc.php';
include './connect/connect.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News</title>
  <link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>

<body class="container">
  <header class="header">
    <a class="logo">News site</a>
    <div class="log">
      <?php if ($_COOKIE["user"] == "") : ?>
        <a class="log-item" href="./authorization-form.html">Log in </a>
        <p>or</p>
        <a class="log-item" href="./registration-form.html">Sign up</a>
      <?php else : ?>
        <p class="greet">Hello, <?= $_COOKIE["user"] ?>!</p>
        <a class="log-item" href="./logout.php">Log out</a>
      <?php endif; ?>
  </header>
  </div>
  <main>

    <?php
    if ($_COOKIE['user'] === 'admin') {
      echo "<form action='./src/deleteUsers.php' method='POST'>
            <input type='hidden' name='id' value='" . $row[' id'] . "'>
            <input type='hidden' name='login' >
            <button>Delete users</button>
          </form>";
    }
    ?>


    <article>
      <?php
      if ($_COOKIE) {
        echo "<form class='setArticle-form' action='" . setArticle($connectDB) . "' method='post'>
                <input type='hidden' name='id' >
                <input type='hidden' name='login' value='" . $_COOKIE['user'] . "'>
                <textarea class='setArticle-text' name='article' placeholder='...here input your article...'></textarea>
                <button class='setArticle-btn' type='submit' name='submitAddArticle'>Add article</button>
              </form>";
      } else {
        echo "<p class='condition'>Only registered users can add and comment news!!!</p>";
      }

      getArticle($connectDB);

      ?>
    </article>
  </main>


</body>

</html>