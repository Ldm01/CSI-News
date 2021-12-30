<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>News en ligne - CSI</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/publishNews.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta name="viewport" contect="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; displayMenu('news');
$response = $db->prepare('SELECT * FROM parametre');
$response->execute();
while ($data = $response->fetch()) {
    $dureeAffichageMax = $data['dureeaffichagemaximale'];
}
?>
<div class="content">
    <fieldset>
        <legend>Publier une news</legend>
        <form action="post.php" method="post">
            <label for="title">Titre de la news :</label>
            <input style="padding-right:327px;" type="text" id="title" name="title"><br/>
            <label for="content">Contenu de la news :</label><br/>
            <textarea id="content" name="content" rows="18" cols="80" placeholder="Ecrivez votre news ici..."></textarea><br/>
            <label for="duration">Combien de temps (nb de jours) voulez-vous que votre news soit affichée publiquement ?</label>
            <input type="number" min="2" max=<?php echo '"'.$dureeAffichageMax.'"'?> value="2" name="duration" id="duration"><br/>
            <label for="keywords">Veuillez sélectionner au minimum un mot clé :</label><br/>
            <select id="keywords" name="keywords[]" multiple size="4" required>
                <?php
                $response = $db->prepare('SELECT * FROM mot_cle');
                $response->execute();
                while ($data = $response->fetch()) {
                    echo '<option value="'.$data['idmotcle'].'">'.$data['libelle'].'</option>';
                }
                ?>
            </select><br/>
            <label for="domain">Veuillez sélectionner le domaine associé à la news :</label>
            <select id="domain" name="domain">
                <?php
                $response = $db->prepare('SELECT * FROM domaine WHERE estaccepte');
                $response->execute();
                while ($data = $response->fetch()) {
                    echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
                }
                ?>
            </select> <br/>
            <input type="submit" value="Publier la news">
        </form>
    </fieldset>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var last_valid_selection = null;

        $('#keyword').change(function(event) {

            if ($(this).val().length > 3) {

                $(this).val(last_valid_selection);
            } else {
                last_valid_selection = $(this).val();
            }
        });
    });
</script>
</body>
</html>
