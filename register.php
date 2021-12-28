<?php
require 'connectDb.php';

$firstName = htmlspecialchars($_POST['first_name']);
$lastName = htmlspecialchars($_POST['last_name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$username = htmlspecialchars($_POST['username']);
$passwordNotCrypted = htmlspecialchars($_POST['password']);
$passwordConfirm = htmlspecialchars($_POST['password_confirm']);

if ($passwordNotCrypted !== $passwordConfirm) {
    header('Location: register_loginPage.php?e=different');
    exit();
}

$password = hash('sha512',$passwordNotCrypted);

$response = $db->prepare(
    "CALL Inscription(:pseudo,:mdp,:nom,:prenom,:mail,:tel)"
);
$response->execute(
    array(
        'pseudo' => $username,
        'mdp' => $password,
        'nom' => $lastName,
        'prenom' => $firstName,
        'mail' => $email,
        'tel' => $phone
    )
);

$response = $db->prepare("SELECT * FROM abonne INNER JOIN compte ON compte.pseudo = :pseudo");
$response->execute(array('pseudo' => $username));
while($data = $response->fetch()) {
    $_SESSION['id'] = $data['idabonne'];
    $_SESSION['username'] = $username;
}
header('Location: index.php');
exit();
