<?php //require 'connectDb.php'?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>News en ligne - CSI</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/registerAndLoginPage.css">
    <meta name="viewport" contect="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'menu.php'; displayMenu('register'); ?>
<fieldset id="register">
    <legend>S'inscrire</legend>
    <form action="register.php" method="post">
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" id="first_name" placeholder="Ex: Jean"><br/>
        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" id="last_name" placeholder="Ex: Dupont"><br/>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" placeholder="Ex: jdupont54"><br/>
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" id="email" placeholder="Ex: adresse@mail.fr"><br/>
        <label for="phone">Téléphone :</label>
        <input type="tel" name="phone" id="phone" placeholder="Ex: 01 23 45 67 89"><br/>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password"><br/>
        <label for="password_confirm">Confirmer le mot de passe :</label>
        <input type="password" name="password_confirm" id="password_confirm"><br/>
        <input type="submit" value="S'inscrire">
    </form>
</fieldset>

<fieldset id="login">
    <legend>Se connecter</legend>
    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username"><br/>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password"><br/>
        <input type="submit" value="Se connecter">
    </form>
</fieldset>
</body>
</html>