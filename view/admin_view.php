<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Projet 4</title>
        <link href="public/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <p><a href='/P4_Blog/index.php'> < Retour à l'accueil</a></p>
        <?php
        if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['function'] == 'admin')
        {
        ?>

        <div id="new_article">
            <button class="admin_button" type="button">
                Poster un nouvel article
            </button>
        </div>

        <div id="manage_article">
            <button class="admin_button" type="button">
                Gérer les articles
            </button>
        </div>

        <div id="manage_comment">
            <button class="admin_button" type="button">
                Gérer les commentaires
            </button>
        </div>

        <div id="manage_user">
            <button class="admin_button" type="button">
                Gérer les utilisateurs
            </button>
        </div>
        <?php
        }
        else
        {
        ?>
        <div>
            <h1>
                Cette page n'est accessible qu'à un administrateur !
            </h1>
        </div>
        <?php
        }
        ?>
    </body>
</html>