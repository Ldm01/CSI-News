<?php
require 'connectDb.php';

$username = htmlspecialchars($_POST['username']);
$passwordNotCrypted = htmlspecialchars($_POST['password']);
$password = hash('sha512',$passwordNotCrypted);

$response = $db->prepare("SELECT connexion(:pseudo, :motdepasse)");
$response->execute(
    array(
        'pseudo' => $username,
        'motdepasse' => $password
    )
);

while($data = $response->fetch()) {
    // Si on ne parvient pas à se connecter
    if (!$data['connexion']) {
        header('Location: register_loginPage.php');
        exit();
    }
}

$response = $db->prepare("SELECT * FROM abonne INNER JOIN compte ON compte.pseudo = :pseudo");
$response->execute(array('pseudo' => $username));
while($data = $response->fetch()) {
    $_SESSION['id'] = $data['idabonne'];
    $_SESSION['username'] = $username;
    $_SESSION['admin'] = $data['admin'];
}
header('Location: index.php');
exit();