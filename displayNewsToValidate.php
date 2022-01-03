<?php
$response = $db->prepare('
    SELECT pseudo, news.idnews, titre, contenu, datepublication, etatn FROM news 
    INNER JOIN etude ON news.idnews = etude.idnews INNER JOIN abonne ON news.idabonne = abonne.idabonne
    WHERE etude.idabonne = :id ORDER BY datepublication DESC
    ');
$response->execute(array('id' => $_SESSION['id']));

while($data = $response->fetch()) {
    $title = $data['titre'];
    $content = $data['contenu'];
    $date = $data['datepublication'];
    $author = $data['pseudo'];
    $state = $data['etatn'];
    $idNews = $data['idnews'];

    $content = substr($content, 0, 200);
    $content .= '...';

    $date = date_create($date);

    echo '
          <tr>
              <td>
                  <span style="font-weight: bold; text-decoration: underline">'.$title.'</span><br/>
                  '.$content.'<br/>
                  Ecrit par '.$author.', le '.date_format($date, 'd/m/Y').'<br/>
                  Etat : '.$state.'<br/>
                  <a href="article.php?id='.$idNews.'" class="readBtn">Lire la suite</a>
              </td>
          </tr>
    ';
}