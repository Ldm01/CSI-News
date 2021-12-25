<?php //require 'connectDb.php'?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>News en ligne - CSI</title>
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/article.css">
        <meta name="viewport" contect="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/f3b2d82c4d.js" crossorigin="anonymous"></script>
    </head>
    <body>
<?php include 'menu.php'; displayMenu('news'); ?>

        <h2>TITRE DE L'ARTICLE</h2>
        <p class="headerNews">Ecrit par Person le 00/00/00 à 00:00 | Catégorie : Sciences | Etat : En attente de validation</p>
        <p class="contentNews"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae, lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobortis nisl ultrices. Phasellus in dui nisl. Duis eget metus erat. Phasellus eget nisi erat. Vivamus dapibus malesuada diam nec aliquet. Duis nec elit quis odio pulvinar convallis. Aliquam vitae augue congue, egestas turpis in, fermentum quam. Quisque molestie tincidunt augue non volutpat. Etiam placerat tincidunt lorem, non ultricies nunc. Integer lacinia massa dui, eu commodo ex interdum quis. Nunc sollicitudin aliquet libero. Mauris aliquet, lacus ac fermentum pellentesque, nisi eros luctus sem, ut fermentum turpis felis ut quam. Maecenas nibh velit, efficitur ut nunc sit amet, euismod semper dolor.

            Vestibulum fermentum urna eget neque aliquam, eget tincidunt enim luctus. Cras semper nunc in neque rutrum, sed congue risus molestie. In at est aliquam, efficitur velit a, ultrices elit. Integer consectetur magna vel est eleifend, cursus gravida sapien sollicitudin. Nulla facilisi. Fusce in hendrerit dolor. Aliquam erat volutpat. Sed feugiat, ipsum sit amet venenatis efficitur, orci magna dignissim nisi, a cursus eros velit ut quam. Morbi id turpis sit amet arcu tincidunt dignissim id a ex. Fusce eget ligula in velit iaculis pharetra. Aliquam fermentum vehicula odio, nec cursus neque ornare non. Duis ultrices est tempus, vulputate neque sed, egestas magna.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi est, euismod commodo lacus vitae, lobortis commodo turpis. Integer mollis ante id velit condimentum, et lobortis nisl ultrices. Phasellus in dui nisl. Duis eget metus erat. Phasellus eget nisi erat. Vivamus dapibus malesuada diam nec aliquet. Duis nec elit quis odio pulvinar convallis. Aliquam vitae augue congue, egestas turpis in, fermentum quam. Quisque molestie tincidunt augue non volutpat. Etiam placerat tincidunt lorem, non ultricies nunc. Integer lacinia massa dui, eu commodo ex interdum quis. Nunc sollicitudin aliquet libero. Mauris aliquet, lacus ac fermentum pellentesque, nisi eros luctus sem, ut fermentum turpis felis ut quam. Maecenas nibh velit, efficitur ut nunc sit amet, euismod semper dolor.

            Vestibulum fermentum urna eget neque aliquam, eget tincidunt enim luctus. Cras semper nunc in neque rutrum, sed congue risus molestie. In at est aliquam, efficitur velit a, ultrices elit. Integer consectetur magna vel est eleifend, cursus gravida sapien sollicitudin. Nulla facilisi. Fusce in hendrerit dolor. Aliquam erat volutpat. Sed feugiat, ipsum sit amet venenatis efficitur, orci magna dignissim nisi, a cursus eros velit ut quam. Morbi id turpis sit amet arcu tincidunt dignissim id a ex. Fusce eget ligula in velit iaculis pharetra. Aliquam fermentum vehicula odio, nec cursus neque ornare non. Duis ultrices est tempus, vulputate neque sed, egestas magna.
        </p>
        SEULEMENT VU PAR L'ABONNE DE CONFIANCE QUI A ETE CHOISI ALEATOIREMENT POUR VALIDER
        <fieldset style="text-align: center;" id="validateNews">
            <legend>Valider la news</legend>
            <form>
                <label for="oui">Oui</label>
                <input type="radio" value="oui" name="choice" id="oui" checked>
                <label for="non">Non</label>
                <input type="radio" value="non" name="choice" id="non"><br/>
                <label for="justif">Justification de ce choix :</label><br/>
                <textarea id="justif" name="justification" rows="8" cols="45" placeholder="Justifiez votre choix ici..." required></textarea><br/>
                <input type="submit" value="Soumettre mon choix">
            </form>
        </fieldset>
