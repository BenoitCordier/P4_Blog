<?php
require 'controller/controller.php';

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'logIn')
    {
        logIn();
    }
    elseif ($_GET['action'] == 'signIn')
    {
        signIn();
    }
}
else
{
echo "";
}

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'listPosts')
    {
        listPosts();
    }
    elseif ($_GET['action'] == 'post')
    {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            postAndComments();
        }
        else
        {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'addComment')
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment']))
            {
                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else
            {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else
        {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}
else
{
    listPosts();
}
