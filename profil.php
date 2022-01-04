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
        <?php include 'menu.php'; displayMenu('profil');
        if (isset($_SESSION['id'])) { ?>
        </div><br/>
        <div class="content" id="active_news">
            <table id="active_news_table">
                <tr>
                    <th>News en attente de validation</th>
                </tr>
                <?php include 'displayNewsToValidate.php'; ?>
            </table>
        </div>
        <fieldset>
            <legend>Ajouter une catégorie préférée</legend>
            <form action="addPrefCat.php" method="post">
                <label for="category">Catégorie choisie :</label>
                <?php
                $response = $db->prepare('
                        SELECT * FROM domaine
                        WHERE domaine.iddomaine NOT IN (SELECT interet.iddomaine FROM interet WHERE idabonne=:id) AND estaccepte
                    ');
                $response->execute(array('id' => $_SESSION['id']));
                ?>
                <select id="category" name="category">
                    <?php
                    while ($data = $response->fetch()) {
                        echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
                    }
                    ?>
                </select><br/>
                <input style="margin-top: 10px;" type="submit" value="Ajouter à sa liste de catégories préférées">
            </form>
        </fieldset>
        <fieldset>
            <legend>Supprimer une catégorie préférée</legend>
            <form action="removePrefCat.php" method="post">
                <label for="category">Catégorie choisie :</label>
                <?php
                $response = $db->prepare('
                        SELECT * FROM domaine WHERE domaine.iddomaine IN (
                                SELECT interet.iddomaine FROM interet WHERE idabonne=:id
                            )
                        ');
                $response->execute(array('id' => $_SESSION['id']));
                ?>
                <select id="category" name="category">
                    <?php
                    while ($data = $response->fetch()) {
                        echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
                    }
                    ?>
                </select><br/>
                <input style="margin-top: 10px;" type="submit" value="Supprimer de sa liste de catégories préférées">
            </form>
        </fieldset>
        <fieldset>
            <legend>Soumettre un nom de domaine (catégorie)</legend>
            <form>
                <label for="domain">Nom de domaine :</label>
                <input type="text" placeholder="Ex: Sports">
                <br/>
                <input style="margin-top: 10px;" type="submit" value="Soumettre">
            </form>
        </fieldset>
        <fieldset>
            <legend>Ajouter un mot clé utilisable sur le site</legend>
            <form action="addKeywords.php" method="post">
                <label for="keyword">Mot clé :</label>
                <input type="text" name="keyword" id="keyword" placeholder="Ex: technologie">
                <br/>
                <input style="margin-top: 10px;" type="submit" value="Soumettre">
            </form>
        </fieldset>
    <?php
    } else {
        header('Location: register_loginPage.php');
        exit();
    }
    ?>
	</body>
</html>