<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>News en ligne - CSI</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/news.css">
    <meta name="viewport" contect="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
    <style>
        td {
            border: 0px;
            text-align: right;
        }
        input {
            text-align: center;
        }
        .btnAuto {
            border: blue 2px solid;
            padding: 5px;
            margin: 5px;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; displayMenu('admin');
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    $response = $db->prepare('SELECT * FROM parametre');
    $response->execute();
    while ($data = $response->fetch()) {
        $dureeAffichageMax = $data['dureeaffichagemaximale'];
        $nbEtudeSansRepMax = $data['nbetudesansrepmax'];
        $nbNewsMinAboConf = $data['nbnewsminaboconf'];
        $dureeEtude = $data['dureeetude'];
    }
?>
    <fieldset>
        <legend>Modifier les paramètres du site</legend>
        <form action="modifyParameters.php" method="post">
            <table>
                <tr>
                    <td><label for="dureeaffichagemaximale">Durée d'affichage maximale d'une news (en jours) :</label></td>
                    <td><input type="number" name="dureeaffichagemaximale" id="dureeaffichagemaximale" min="2" value=<?php echo '"'.$dureeAffichageMax.'"'?>></td>
                </tr>
                <tr>
                    <td><label for="nbetudesansrepmax">Nombre d'études sans réponse maximum :</label></td>
                    <td><input type="number" name="nbetudesansrepmax" id="nbetudesansrepmax" min="1" value=<?php echo '"'.$nbEtudeSansRepMax.'"'?>><br/></td>
                </tr>
                <tr>
                    <td><label for="nbnewsminaboconf">Nombre de publications minimum pour qu'un abonné devienne de confiance :</label></td>
                    <td><input type="number" name="nbnewsminaboconf" id="nbnewsminaboconf" min="1" value=<?php echo '"'.$nbNewsMinAboConf.'"'?>></td>
                </tr>
                <tr>
                    <td><label for="dureeetude">Durée d'étude d'une news :</label></td>
                    <td><input type="number" name="dureeetude" id="dureeetude" min="1" value=<?php echo '"'.$dureeEtude.'"'?>></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center;"><input type="submit" value="Modifier les paramètres"></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <fieldset>
        <legend>Accepter des noms de domaines (catégories)</legend>
        <form action="validateDomain.php" method="post">
            <label for="domain">Nom de domaine :</label>
            <?php
            $response = $db->prepare('SELECT * FROM domaine WHERE estaccepte IS NULL');
            $response->execute();
            ?>
            <select id="domain" name="domain">
                <?php
                while ($data = $response->fetch()) {
                    echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Valider">
        </form>
    </fieldset>
    <fieldset>
        <legend>Ne pas accepter des noms de domaines (catégories)</legend>
        <form action="noAcceptDomain.php" method="post">
            <label for="domain">Nom de domaine :</label>
            <?php
            $response = $db->prepare('SELECT * FROM domaine WHERE estaccepte IS NULL');
            $response->execute();
            ?>
            <select id="domain" name="domain">
                <?php
                while ($data = $response->fetch()) {
                    echo '<option value="'.$data['iddomaine'].'">'.$data['libelle'].'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Valider">
        </form>
    </fieldset>
    <fieldset>
        <legend style="margin-bottom: 10px">Boutons automatiques</legend>
        <a class="btnAuto" href="aboConf.php">Vérification abonnés confiance</a>
        <a class="btnAuto" href="archiver.php">Archivage des news</a>
        <a class="btnAuto" href="#">Etude d'une news délai</a>
    </fieldset>
<?php } else {
    echo '<p style="font-size: 32px; text-align: center;">Petit malin tu as cru pouvoir nous hacker :D</p>
            <p style="text-align: center;">
            <video autoplay loop width="800px" height="430px">
                 <source src="autres/hehe.mp4" type="video/mp4">
                 <source src="autres/hehe.webm" type="video/webm">
            </video>
</p>
';
}?>
</body>
</html>
