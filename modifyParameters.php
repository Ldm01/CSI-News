<?php
require 'connectDb.php';

$response = $db->prepare('CALL modifier_parametres(:dureeaffichagemaximale, :nbetudesansrepmax, :nbnewsminaboconf, :dureeetude)');
$response->execute(
    array(
        'dureeaffichagemaximale' => $_POST['dureeaffichagemaximale'],
        'nbetudesansrepmax' => $_POST['nbetudesansrepmax'],
        'nbnewsminaboconf' => $_POST['nbnewsminaboconf'],
        'dureeetude' => $_POST['dureeetude']
    )
);

header('Location: admin.php');
exit();