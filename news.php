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
        <?php include 'menu.php'; displayMenu('news');
        if (isset($_SESSION['id'])) {
        ?>
        <div class="content">
            <!-- SI CONNECTE -->
            <a href="publishNews.php" class="boutons">Publier une news</a>
        </div><br/>
        <?php } ?>
        <div class="content" id="active_news">
            <table id="active_news_table">
                <tr>
                    <th>News Actives | Toutes catégories</th>
                </tr>
                <?php include 'displayNews.php'; ?>
            </table>
        </div>
        <fieldset>
            <legend>Affichage par catégorie</legend>
            <form>
                <label for="category">Catégorie choisie :</label>
                <select id="category" name="category">
                    <option value="1">Catégorie 1</option>
                    <option value="1">Catégorie 2</option>
                    <option value="1">Catégorie 3</option>
                    <option value="1">Catégorie 4</option>
                </select><br/>
                <input style="margin-top: 10px;" type="submit" value="Afficher les news de la catégorie">
            </form>
        </fieldset>
        <fieldset>
            <legend>Recherche de news actives par mot clé</legend>
            <form>
                <label for="keyword">Mot clé choisi :</label>
                <select id="keyword" name="keyword">
                    <option value="1">Mot clé 1</option>
                    <option value="1">Mot clé 2</option>
                    <option value="1">Mot clé 3</option>
                    <option value="1">Mot clé 4</option>
                </select><br/>
                <input style="margin-top: 10px;" type="submit" value="Rechercher">
            </form>
        </fieldset>
	</body>
</html>