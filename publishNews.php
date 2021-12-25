<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>News en ligne - CSI</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/publishNews.css">
    <meta name="viewport" contect="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; displayMenu('news'); ?>
<div class="content">
    <fieldset>
        <legend>Publier une news</legend>
        <form action="post.php" method="post">
            <label for="title">Titre de la news :</label>
            <input style="padding-right:327px;" type="text" id="title" name="title"><br/>
            <label for="content">Contenu de la news :</label><br/>
            <textarea id="content" name="content" rows="18" cols="80" placeholder="Ecrivez votre news ici..."></textarea><br/>
            <label for="duration">Combien de temps (nb de jours) voulez-vous que votre news soit affichée publiquement ?</label>
            <input type="number" min="2" max="14" value="2"><br/>
            <label for="keyword">Veuillez sélectionner au minimum un mot clé :</label><br/>
            <select id="keyword" name="keyword1" multiple size="4">
                <option value="1" selected>Mot clé 1</option>
                <option value="2">Mot clé 2</option>
                <option value="3">Mot clé 3</option>
                <option value="4">Mot clé 4</option>
                <option value="5">Mot clé 5</option>
            </select><br/>
            <label for="domain">Veuillez sélectionner le domaine associé à la news :</label>
            <select id="domain" name="domain">
                <option value="sciences">Sciences</option>
                <option value="politique">Politique</option>
                <option value="jeux_videos">Jeux Video</option>
            </select> <br/>
            <input type="submit" value="Publier la news">
        </form>
    </fieldset>
</div>
</body>
</html>
