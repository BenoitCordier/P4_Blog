<?php
    if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['function'] == 'admin')
    {
?>
<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Projet 4</title>
        <link href="public/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <div id="home_button">
            <form action="index.php?action=listPosts">
                <input type="submit" value="Retour à l'accueil" />
            </form>
        </div>
       
        <div id="admin_button">
            <form action="index.php?action=newPost">
                <input type="submit" value="Poster un nouvel article" />
            </form>
        </div>

        <div id="admin_button">
            <form action="index.php?action=managePost">
                <input type="submit" value="Gérer les articles" />
            </form>
        </div>

        <div id="admin_button">
            <form action="index.php?action=manageComment">
                <input type="submit" value="Modérer les commentaires" />
            </form>
        </div>

        <div id="admin_button">
            <form action="index.php?action=manageUser">
                <input type="submit" value="Gérer les utilisateurs" />
            </form>
        </div>
    </body>
</html>
<?php
    }
    else
    {
        header('Location: index.php?action=listPosts');
    }
?>