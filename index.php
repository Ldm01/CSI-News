<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>News en ligne - CSI</title>
		<link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/accueil.css">
		<meta name="viewport" contect="width=device-width, initial-scale=1.0">
		<script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php include 'menu.php'; displayMenu('home');
        if (isset($_SESSION['id'])) {
        ?>

        <div class="content" id="active_news">
            <table id="active_news_table">
                <tr>
                    <th>News de vos catégories préférées</th>
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
        <fieldset id="catPref">
            <legend style="font-weight: bold;font-size:20px;">Vos catégories préférées :</legend>
            Jeux Vidéo, Sciences, Nourriture
            <p>Rendez-vous sur votre profil pour ajouter des catégories à votre liste d'intérêt.</p>
            <a href="profil.php" class="boutons">Aller sur mon profil</a>
        </fieldset>

        <?php
        } else {
            echo '<p style="margin-left: 10px">Veuillez vous <a href="register_loginPage.php">connecter</a> pour afficher les news de vos catégories préférées.</p>';
        }
        ?>
	</body>
</html>