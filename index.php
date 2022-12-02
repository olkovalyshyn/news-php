<?php
include './connect/connect.php';
include './src/addEditArticleFunc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News</title>
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <header>
    <a>News site</a>

    <?php if ($_COOKIE["user"] == "") : ?>
      <a href="./authorization-form.html">Log in </a>
      <p>or</p>
      <a href="./registration-form.html">Sign up</a>
    <?php else : ?>
      <p>Hello, <?= $_COOKIE["user"] ?>!</p>
      <a href="./logout.php">Log out</a>
    <?php endif; ?>
  </header>

  <main>

    <article>
      <?php
      if ($_COOKIE['user'] !== "") {
        echo "<form action='" . setArticle($connect) . "' method='post'>
      <input type='hidden' name='id' >
      <input type='hidden' name='login' value='" . $_COOKIE['user'] . "'>
      <textarea name='article'></textarea>
      <button type='submit' name='submitAddArticle'>Add article</button>
      </form>";
      } else {
        echo "Only registered users can add and comment news!";
      }

      getArticle($connect);
      ?>
    </article>
  </main>


</body>

</html>