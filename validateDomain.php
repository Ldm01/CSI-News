<?php
require 'connectDb.php';
$response = $db->prepare('UPDATE domaine SET estaccepte = TRUE WHERE iddomaine = :id');
$response->execute(array('id' => $_POST['domain']));
header('Location: admin.php');
exit();
