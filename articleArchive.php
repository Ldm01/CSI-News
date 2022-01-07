<?php //require 'connectDb.php'?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>News en ligne - CSI</title>
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/article.css">
        <meta name="viewport" contect="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
    </head>
    <body>
<?php include 'menu.php'; displayMenu('news'); include 'displayArchiveArticle.php';
    if (isset($_SESSION['id']) && ($_SESSION['id'] === $idAbo || $_SESSION['admin']) ) {
        echo '<form action="deleteArticle.php" method="post">
                <input type="hidden" value="' . $id . '" name="idArticle">
                <input type="submit" value="Supprimer l\'article"</a>
                </form>
                ';
    }
    ?>
    </body>
</html>