<?php
require_once 'model/model_db.php';
require_once 'model/model_user.php';
require_once 'model/model_post.php';
require_once 'model/model_comment.php';

// routeur config

function identification() {
    switch ($_GET['action'])
    {
        case 'logIn':
            logIn();
        break;

        case 'signIn':
            signIn();
        break;

        case 'logOut':
            logOut();
        break;

        default:
            listPosts();
    }
}

function navigation() {
    switch ($_GET['action'])
    {
        case 'listPosts':
            listPosts();
        break;
        
        case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                postAndComments($_GET['id']);
                }
        break;

        case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['comment_content']))
                {
                addComment($_GET['id'], $_SESSION['user_name'], $_POST['comment_content']);
                }
        break;

        case 'admin':
           echo "Futur lien vers le panneau d'admin.";
        break;    

        default:
            echo 'Une erreur est survenue !';
    }
}

// identification

$db = dbConnection();

function logIn() {
    $db = dbConnection();

    $user_manager = new UserManager($db);
    $user_name = !empty($_POST['user_name']) ? $_POST['user_name'] : NULL;
    $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
    $get_info = $user_manager->getInfo($user_name);

    if ($get_info)
    {
        $is_password_correct = password_verify($_POST['password'], $get_info['password']);
        if ($is_password_correct)
        {
            $_SESSION['id'] = $get_info['id'];
            $_SESSION['user_name'] = $get_info['user_name'];
            $_SESSION['first_name'] = $get_info['first_name'];
            $_SESSION['last_name'] = $get_info['last_name'];
            $_SESSION['e_mail'] = $get_info['e_mail'];
            $_SESSION['function'] = $get_info['function'];
            header('Location: index.php');
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

function logOut() {
    session_unset();
    session_destroy();
    header('Location: index.php');
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
    $check_user = $user_manager->getInfo($user_name);
    $check_email = $user_manager->getInfo($e_mail);

    if ($user_name === NULL)
    {
        echo "Veuillez saisir un nom d'utilisateur valide.";
    }
    elseif ($password === NULL)
    {
        echo "Veuillez saisir un mot de passe.";
    }
    elseif ($confirmation_password !== $password || $confirmation_password === NULL)
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
        echo "<div id='home_button'>
                    <form action='index.php?action=listPosts'>
                        <input type='submit' value='Retour' />
                    </form>
                </div>
                <p>Bienvenue " . $first_name . " " . $last_name . " ! Vous vous êtes enregistré sous le pseudonyme " . $user_name . " !</p>";
    }
}

// navigation

    function listPosts()
    {
        $db = dbConnection();

        $postManager = new PostManager($db);
        $posts = $postManager->getPosts();

        require 'view/home_view.php';
    }

    function postAndComments($post_id)
    {
        $db = dbConnection();

        $postManager = new PostManager($db);
        $commentManager = new CommentManager($db);

        $post = $postManager->getPost($post_id);        
        $comments = $commentManager->getComments($post_id);

        require 'view/post_view.php';
    }

    function addComment($post_id, $user_name, $comment_content)
    {
        $db = dbConnection();

        $commentManager = new CommentManager($db);

        $affected_lines = $commentManager->postComment($post_id, $user_name, $comment_content);

        if ($affected_lines === false) {
            die('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $post_id);
        }
        require 'view/post_view.php';
    }

    // administration
    
    