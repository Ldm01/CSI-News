<?php
require 'connectDb.php';

$idArticle = $_POST['idArticle'];

$response = $db->prepare('DELETE FROM etude WHERE idnews = :id');
$response->execute(
    array(
        'id' => $idArticle
    )
);

$response = $db->prepare('DELETE FROM news WHERE idnews = :id');
$response->execute(
    array(
        'id' => $idArticle
    )
);

header('Location: news.php');
exit();
