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
<?php include 'menu.php'; displayMenu('news'); include 'displayArticle.php';
    if (isset($_SESSION['id']) && ($_SESSION['id'] === $idAbo || $_SESSION['admin']) ) {
        echo '<form action="deleteArticle.php" method="post">
                <input type="hidden" value="' . $id . '" name="idArticle">
                <input type="submit" value="Supprimer l\'article"</a>
                </form>
                ';
    }
        if ($state !== 'validé') {?>
        <fieldset style="text-align: center;" id="validateNews">
            <legend>Valider la news</legend>
            <form>
                <label for="oui">Oui</label>
                <input type="radio" value="oui" name="choice" id="oui" checked>
                <label for="non">Non</label>
                <input type="radio" value="non" name="choice" id="non"><br/>
                <label for="justif">Justification de ce choix :</label><br/>
                <textarea id="justif" name="justification" rows="8" cols="45" placeholder="Justifiez votre choix ici..." required></textarea><br/>
                <input type="submit" value="Soumettre mon choix">
            </form>
        </fieldset>
    <?php } ?>
    </body>
</html>