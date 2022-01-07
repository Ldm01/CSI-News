<?php
$response = $db->prepare(
    '
        SELECT * FROM archive_news 
        INNER JOIN abonne ON archive_news.idabonnep = abonne.idabonne
        INNER JOIN domaine ON archive_news.iddomaine = domaine.iddomaine
        WHERE idarchive = :idNews
    '
);
$response->execute(array('idNews' => $_GET['id']));

while($data = $response->fetch()) {
    $title = $data['titre'];
    $content = $data['contenu'];
    $date = $data['datepublication'];
    $author = $data['pseudo'];
    $state = $data['etata'];
    $id = $data['idarchive'];
    $idAbo = $data['idabonnep'];
    $cat = $data['libelle'];
    $idMotCle1 = $data['idmotcle1'];
    $idMotCle2 = $data['idmotcle2'];
    $idMotCle3 = $data['idmotcle3'];

    $date = date_create($date);
}

$keyword1 = '';
$keyword2 = '';
$keyword3 = '';

$response = $db->prepare('SELECT libelle FROM mot_cle WHERE idmotcle = :id');
$response->execute(array('id' => $idMotCle1));
while ($data = $response->fetch()) {
    $keyword1 = $data['libelle'];
}

$response = $db->prepare('SELECT libelle FROM mot_cle WHERE idmotcle = :id');
$response->execute(array('id' => $idMotCle2));
while ($data = $response->fetch()) {
    $keyword2 = $data['libelle'];
}

$response = $db->prepare('SELECT libelle FROM mot_cle WHERE idmotcle = :id');
$response->execute(array('id' => $idMotCle3));
while ($data = $response->fetch()) {
    $keyword3 = $data['libelle'];
}

echo '
        <h2>'.$title.'</h2>
        <p class="headerNews">Ecrit par '.$author.' le '.date_format($date, 'd/m/Y').' | Catégorie : '.$cat.' | Etat : '.$state.' | Mots clés : '.$keyword1.', '.$keyword2. ', '.$keyword3.'</p>
        <p class="contentNews">'.$content.'</p>
    ';