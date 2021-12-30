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
                <?php include 'displayByPreferedCat.php'; ?>
            </table>
        </div>
        <fieldset id="catPref">
            <legend style="font-weight: bold;font-size:20px;">Vos catégories préférées :</legend>
            <?php
            $response = $db->prepare('
                        SELECT * FROM domaine WHERE domaine.iddomaine IN (
                                SELECT interet.iddomaine FROM interet WHERE idabonne=:id
                            )
                        ');
            $response->execute(array('id' => $_SESSION['id']));
            while ($data = $response->fetch()) {
                echo $data['libelle'].', ';
            }
            ?>
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