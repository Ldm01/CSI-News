<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>News en ligne - CSI</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/news.css">
    <meta name="viewport" contect="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; displayMenu('archives'); ?>
<div class="content" id="active_news">
    <table id="active_news_table">
        <tr>
            <th>News Archivées | Toutes catégories</th>
        </tr>
        <tr>
            <td>TITRE<br/>Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae,
                lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobo...<br/>Ecrit par Person, le 00/00/00 à 00:00
                <br/>Etat : Validée
                <br/><a href="#" class="readBtn">Lire la suite</a></td>
        </tr>
        <tr>
            <td>TITRE<br/>Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae,
                lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobo...<br/>Ecrit par Person, le 00/00/00 à 00:00
                <br/>Etat : Validée
                <br/><a href="#" class="readBtn">Lire la suite</a></td>
        </tr>
        <tr>
            <td>TITRE<br/>Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae,
                lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobo...<br/>Ecrit par Person, le 00/00/00 à 00:00
                <br/>Etat : Validée
                <br/><a href="#" class="readBtn">Lire la suite</a></td>
        </tr>
        <tr>
            <td>TITRE<br/>Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae,
                lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobo...<br/>Ecrit par Person, le 00/00/00 à 00:00
                <br/>Etat : Validée
                <br/><a href="#" class="readBtn">Lire la suite</a></td>
        </tr>
    </table>
</div>
<fieldset>
    <legend>Affichage par catégorie</legend>
    <form>
        <label for="category">Catégorie choisie :</label>
        <select id="category" name="category">
            <?php
            $response = $db->prepare('SELECT * FROM domaine WHERE estaccepte');
            $response->execute();
            while ($data = $response->fetch()) {
                echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
            }
            ?>
        </select><br/>
        <input style="margin-top: 10px;" type="submit" value="Afficher les news de la catégorie">
    </form>
</fieldset>
<fieldset>
    <legend>Recherche de news archivées par mot clé</legend>
    <form>
        <label for="keyword">Mot clé choisi :</label>
        <select id="keyword" name="keyword">
            <?php
            $response = $db->prepare('SELECT * FROM mot_cle');
            $response->execute();
            while ($data = $response->fetch()) {
                echo '<option value="'.$data['idmotcle'].'">'.$data['libelle'].'</option>';
            }
            ?>
        </select><br/>
        <input style="margin-top: 10px;" type="submit" value="Rechercher">
    </form>
</fieldset>
</body>
</html>