<?php
$response = $db->prepare('SELECT idnews, titre, contenu, datepublication, pseudo, etatn FROM news INNER JOIN abonne ON news.idabonne = abonne.idabonne ORDER BY datepublication DESC');
$response->execute();

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