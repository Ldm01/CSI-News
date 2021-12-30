<?php
require 'connectDb.php';

$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);
$duration = $_POST['duration'];
$keywords = $_POST['keywords'];
$cat = $_POST['domain'];
$idAuthor = $_SESSION['id'];



switch (count($keywords)) {
    case 1:
        $response = $db->prepare('SELECT publier(:idAuthor,:title, :content, :duration, :cat, :keyword1)');
        $response->execute(
            array(
                'idAuthor' => $idAuthor,
                'title' => $title,
                'content' => $content,
                'duration' => $duration,
                'cat' => $cat,
                'keyword1' => $keywords[0],
            ));
        break;
    case 2:
        $response = $db->prepare('SELECT publier(:idAuthor,:title, :content, :duration, :cat, :keyword1, :keyword2)');
        $response->execute(
            array(
                'idAuthor' => $idAuthor,
                'title' => $title,
                'content' => $content,
                'duration' => $duration,
                'cat' => $cat,
                'keyword1' => $keywords[0],
                'keyword2' => $keywords[1],
            ));
        break;
    case 3:
        $response = $db->prepare('SELECT publier(:idAuthor,:title, :content, :duration, :cat, :keyword1, :keyword2, :keyword3)');
        $response->execute(
            array(
                'idAuthor' => $idAuthor,
                'title' => $title,
                'content' => $content,
                'duration' => $duration,
                'cat' => $cat,
                'keyword1' => $keywords[0],
                'keyword2' => $keywords[1],
                'keyword3' => $keywords[2],
            ));
        break;
    default:
        break;
}

while ($data = $response->fetch()) {
    $idNews = $data['publier'];
}
header('Location: article.php?id='.$idNews);
exit();

