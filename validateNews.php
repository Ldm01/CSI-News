<?php
require 'connectDb.php';

$idNews = $_POST['idNews'];
$choice = $_POST['choice'];
$justification = $_POST['justification'];
$author = $_POST['idAbo'];
$title = $_POST['title'];

switch ($choice) {
    case 'oui':
        $choice = 'validé';
        break;
    case 'non':
        $choice = 'fausse';
        break;
    default:
        break;
}


$response = $db->prepare('UPDATE news SET etatn = :choice WHERE idnews = :id');
$response->execute(array('choice' => $choice, 'id' => $idNews));

$response = $db->prepare('UPDATE etude SET justification = :justif, dateetude = current_date');
$response->execute(array('justif' => $justification));

$response = $db->prepare('SELECT email FROM abonne WHERE idabonne = :id');
$response->execute(array('id' => $author));
while ($data = $response->fetch()) {
    $email = $data['email'];
}

/*
$to      = 'personne@example.com';
$subject = 'Etude de votre news terminée';
$message = '<p>Bonjour !<br/>L\'étude de votre news du nom ('.$title.') vient tout juste de terminer.<br/>Etat actuel de votre news : '.$choice.'</p>';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $message, $headers);
*/

header('Location: article.php?id='. $idNews);
exit();