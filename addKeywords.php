<?php
require 'connectDb.php';
$keyword = htmlspecialchars($_POST['keyword']);
$response = $db->prepare('INSERT INTO mot_cle(libelle) VALUES(:keyword)');
$response->execute(array('keyword' => $keyword));
header('Location: profil.php');
exit();

