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
    </style>
</head>
<body>
<?php include 'menu.php'; displayMenu('admin');
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    $response = $db->prepare('SELECT * FROM parametre');
    $response->execute();
    while ($data = $response->fetch()) {
        $dureeAffichageMax = $data['dureeaffichagemaximale'];
    }
?>
    <fieldset>
        <legend>Modifier les paramètres du site</legend>
        <form>
            <table>
                <tr>
                    <td><label for="dureeaffichagemaximale">Durée d'affichage maximale d'une news (en jours) :</label></td>
                    <td><input type="number" name="dureeaffichagemaximale" id="dureeaffichagemaximale" min="2" value=<?php echo '"'.$dureeAffichageMax.'"'?>></td>
                </tr>
                <tr>
                    <td><label for="nbetudesansrepmax">Nombre d'études sans réponse maximum :</label></td>
                    <td><input type="number" name="nbetudesansrepmax" id="nbetudesansrepmax" min="1"><br/></td>
                </tr>
                <tr>
                    <td><label for="nbnewsminaboconf">Nombre de publications minimum pour qu'un abonné devienne de confiance :</label></td>
                    <td><input type="number" name="nbnewsminaboconf" id="nbnewsminaboconf" min="1"></td>
                </tr>
                <tr>
                    <td><label for="dureeetude">Durée d'étude d'une news :</label></td>
                    <td><input type="number" name="dureeetude" id="dureeetude" min="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center;"><input type="submit" value="Modifier les paramètres"></td>
                </tr>
            </table>
        </form>
    </fieldset>
<?php } else {
    echo '<p style="font-size: 32px; text-align: center;">Petit malin tu as cru pouvoir nous hacker :D</p>
            <p style="text-align: center;">
            <video autoplay loop width="800px" height="430px">
                 <source src="autres/hehe.mp4" type="video/mp4">
            </video>
</p>
';
}?>
</body>
</html>
