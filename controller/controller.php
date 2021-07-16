<?php
require_once 'model/model_db.php';
require_once 'model/model_user.php';
require_once 'model/model_post.php';
require_once 'model/model_comment.php';
require 'view/home_view.php';

// method login et signin avec les vérifications

function logIn() {
    $db = dbConnection();
    $user_manager = new UserManager($db);
    $user_name = !empty($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
    $is_user_exist = $user_manager->getUser($user_name);
    $get_pass_hash = $user_manager->getPassHash($user_name);

    if ($is_user_exist)
    {
        $is_password_correct = password_verify($_POST['password'], $get_pass_hash['password']);
        if ($is_password_correct)
        {
            session_start();
            $_SESSION['user_name'] = $user_name;
            echo "Bonjour " . $user_name . ". Vous êtes connecté !";
        }
        else
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }
    else
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

function signIn() {
    $db = dbConnection();
    $user_manager = new UserManager($db);    
    $user_name = !empty($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
    $confirmation_password = !empty($_POST['confirmation_password']) ? $_POST['confirmation_password'] : NULL;
    $e_mail = !empty($_POST['e_mail']) ? $_POST['e_mail'] : NULL;
    $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : NULL;
    $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : NULL;
    $check_user = $user_manager->checkUser($user_name);
    $check_email = $user_manager->checkEmail($e_mail);

    if ($user_name === NULL)
    {
        echo "Veuillez saisir un nom d'utilisateur valide.";
    }
    elseif($password === NULL)
    {
        echo "Veuillez saisir un mot de passe.";
    }
    elseif($confirmation_password !== $password || $confirmation_password === NULL)
    {
        echo "Veuillez confirmer votre mot de passe.";
    }
    elseif ($e_mail === NULL || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['e_mail']))
    {
        echo "Veuillez saisir une adresse e-mail valide.";
    }
    elseif ($first_name === NULL || $last_name === NULL)
    {
        echo "Veuillez indiquer vos noms et prénoms.";
    }
    elseif ($check_user)
    {
        echo "Pseudonyme déjà utilisé, veuillez en choisir un autre.";
    }
    elseif ($check_email)
    {
        echo "Adresse mail déjà utilisée, veuillez en choisir un autre.";
    }
    else
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $req = $user_manager->signIn($user_name, $pass_hash, $e_mail, $first_name, $last_name);
        echo "Bienvenue " . $first_name . " " . $last_name . " ! Vous vous êtes enregistré sous le pseudonyme " . $user_name . " !";
    }
}

// method article et commentaire

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/home_view.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/post_view.php');
}