<?php
require 'connectDb.php';
$response = $db->prepare('CALL SoumettreDomaine(:idAbo, :nomDomaine)');
$response->execute(array('idAbo' => $_SESSION['id'], 'nomDomaine' => htmlspecialchars($_POST['domain'])));
header('Location: profil.php');
exit();
