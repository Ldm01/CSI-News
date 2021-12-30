<?php
require 'connectDb.php';

$idCat = $_POST['category'];

$response = $db->prepare('INSERT INTO interet VALUES (:idAbo, :cat)');
$response->execute(
    array(
        'idAbo' => $_SESSION['id'],
        'cat' => $idCat
    )
);

header('Location: profil.php');
exit();
