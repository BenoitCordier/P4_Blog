<?php
require('controller/controller.php');

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
            post();
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
