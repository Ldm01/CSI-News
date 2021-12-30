<?php
require 'connectDb.php';

$idCat = $_POST['category'];

$response = $db->prepare('DELETE FROM interet WHERE idabonne = :idAbo AND iddomaine = :cat;
');
$response->execute(
    array(
        'idAbo' => $_SESSION['id'],
        'cat' => $idCat
    )
);

header('Location: profil.php');
exit();
