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
        <?php include 'menu.php'; displayMenu('profil'); ?>
        </div><br/>
        <div class="content" id="active_news">
            <table id="active_news_table">
                <tr>
                    <th>News en attente de validation</th>
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
            <legend>Ajouter une catégorie préférée</legend>
            <form>
                <label for="category">Catégorie choisie :</label>
                <select id="category" name="category">
                    <option value="1">Catégorie 1</option>
                    <option value="1">Catégorie 2</option>
                    <option value="1">Catégorie 3</option>
                    <option value="1">Catégorie 4</option>
                </select><br/>
                <input style="margin-top: 10px;" type="submit" value="Ajouter à sa liste de catégories préférées">
            </form>
        </fieldset>
        <fieldset>
            <legend>Supprimer une catégorie préférée</legend>
            <form>
                <label for="category">Catégorie choisie :</label>
                <select id="category" name="category">
                    <option value="1">Catégorie 1</option>
                    <option value="1">Catégorie 2</option>
                    <option value="1">Catégorie 3</option>
                    <option value="1">Catégorie 4</option>
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
        <!-- QUAND ADMIN ajouter menu pour changer paramètres globaux du site -->
	</body>
</html>