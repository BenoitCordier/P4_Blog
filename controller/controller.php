<?php

// Controller

require_once 'model/model_db.php';
require_once 'model/model_user.php';
require_once 'model/model_post.php';
require_once 'model/model_comment.php';

$db = dbConnection();
// Identification
function logIn()
{
    global $db;

    $userManager = new UserManager($db); // On charge le model UserManager
    $userName = !empty($_POST['userName']) ? $_POST['userName'] : null; // On vérifie l'existence de $userName
    $password = !empty($_POST['password']) ? $_POST['password'] : null; // On vérifie l'existence de $password
    $getInfo = $userManager->getInfo($userName); // On récupère les informations liées à $userName

    if ($getInfo) {
        $isPasswordCorrect = password_verify($_POST['password'], $getInfo['password']); // Vérification du mot de passe
        if ($isPasswordCorrect) { // Si le mot de passe correspond, on passe les informations de l'utilisateur à la session, sinon on affiche un message d'erreur
            $_SESSION['id'] = $getInfo['id'];
            $_SESSION['userName'] = $getInfo['userName'];
            $_SESSION['firstName'] = $getInfo['firstName'];
            $_SESSION['lastName'] = $getInfo['lastName'];
            $_SESSION['eMail'] = $getInfo['eMail'];
            $_SESSION['function'] = $getInfo['function'];
            header('Location: index.php');
        } else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
// Déconnexion
function logOut()
{
    session_unset();
    session_destroy();
    header('Location: index.php'); // On renvoie à la page d'accueil après la déconnexion
}
// Enregistrement
function signIn()
{
    global $db;

    // On vérifie la bonne conformité de tous les champs du formulaire d'enregistrement

    $userManager = new UserManager($db);
    $userName = !empty($_POST['userName']) ? $_POST['userName'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $confirmationPassword = !empty($_POST['confirmationPassword']) ? $_POST['confirmationPassword'] : null;
    $eMail = !empty($_POST['eMail']) ? $_POST['eMail'] : null;
    $firstName = !empty($_POST['firstName']) ? $_POST['firstName'] : null;
    $lastName = !empty($_POST['lastName']) ? $_POST['lastName'] : null;
    $checkUser = $userManager->getInfo($userName); // Vérification de la préexistence de l'utilisateur
    $checkEmail = $userManager->getInfo($eMail); // Vérification de la préexistence de l'email

    if ($userName === null) {
        echo "Veuillez saisir un nom d'utilisateur valide.";
    } elseif ($password === null) {
        echo "Veuillez saisir un mot de passe.";
    } elseif ($confirmationPassword !== $password || $confirmationPassword === null) {
        echo "Veuillez confirmer votre mot de passe.";
    } elseif ($eMail === null || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['eMail'])) { // Vérification du bon format de l'email avec une regex
        echo "Veuillez saisir une adresse e-mail valide.";
    } elseif ($firstName === null || $lastName === null) {
        echo "Veuillez indiquer vos noms et prénoms.";
    } elseif ($checkUser) {
        echo "Pseudonyme déjà utilisé, veuillez en choisir un autre.";
    } elseif ($checkEmail) {
        echo "Adresse mail déjà utilisée, veuillez en choisir un autre.";
    } else {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $req = $userManager->signIn($userName, $passHash, $eMail, $firstName, $lastName); // Enregistrement du nouvel utilisateur
        echo "<div id='home_button'>
                <button>
                    <a href='index.php?action=listPosts'>Retour</a>
                </button>
              </div>
                <p>Bienvenue " . $firstName . " " . $lastName . " ! Vous vous êtes enregistré sous le pseudonyme " . $userName . " !</p>";
    }
}

// Navigation
// Chargement des cinq derniers articles
function listPosts()
{
    global $db;
    $postManager = new PostManager($db);
    $posts = $postManager->getPosts();
    $titles = $postManager->getTitles();

    require 'view/home_view.php';
}
// Chargement d'un article et des commentaires associés
function postAndComments($postId)
{
    global $db;
    $postManager = new PostManager($db);
    $commentManager = new CommentManager($db);
    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);

    require 'view/post_view.php';
}
// Ajout d'un commentaire à un article
function addComment($postId, $userName, $commentContent)
{
    global $db;
    $commentManager = new CommentManager($db);
    $commentContentOnPost = !empty($_POST['commentContent']) ? $_POST['commentContent'] : null; // Vérification de la présence du contenu d'un commentaire

    if ($commentContentOnPost === null) {
        echo 'Impossible d\'ajouter le commentaire !';
        header('Location: index.php?action=post&id=' . $postId);
    } else {
        $affectedLines = $commentManager->addComment($postId, $userName, $commentContent);
        header('Location: index.php?action=post&id=' . $postId);

        if ($affectedLines === false) {
            echo 'Impossible d\'ajouter le commentaire !';
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    
    require 'view/post_view.php';
}
// Signalement d'un commentaire
function alertComment($id, $postId)
{
    global $db;
    $commentManager = new CommentManager($db);
    $alertComment = $commentManager->alertComment($id);
    header('Location: index.php?action=post&id='. $postId);

    require 'view/post_view.php';
}

// Administration
// Chargement des fonctions utiles à l'administration
function adminDashboardOnLoad()
{
    global $db;
    $postManager = new PostManager($db);
    $userManager = new UserManager($db);
    $commentManager = new CommentManager($db);
    $checkPost = $postManager->checkPost();
    $checkComment = $commentManager->checkComment();
    $checkAllComment = $commentManager->checkAllComment();
    $checkUsers = $userManager->checkUsers();

    require 'view/admin_view.php';
}
// Ecriture d'un nouvel article
function newPost($postTitle, $postContent)
{
    global $db;
    $postManager = new PostManager($db);
    $newPost = $postManager->newPost($postTitle, $postContent);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Chargement du contenu d'un article pour modification
function modifyPost($id)
{
    global $db;
    $postManager = new PostManager($db);
    $modifiedPost = $postManager->modifyPost($id);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Envoi de l'article modifié
function updatePost($id, $newTitle, $newContent)
{
    global $db;
    $postManager = new PostManager($db);
    $modifyPost = $postManager->updatePost($id, $newTitle, $newContent);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Suppression d'un article
function deletePost($id)
{
    global $db;
    $postManager = new PostManager($db);
    $commentManager = new CommentManager($db);
    $deletePost = $postManager->deletePost($id);
    $deleteAllComment = $commentManager->deleteAllComment($id); // On supprime aussi tous les commentaires associés à cet article
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Rétablissement d'un commentaire signalé
function clearComment($id)
{
    global $db;
    $commentManager = new CommentManager($db);
    $clearComment = $commentManager->clearComment($id);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Suppression d'un commentaire
function deleteComment($id)
{
    global $db;
    $commentManager = new CommentManager($db);
    $deleteComment = $commentManager->deleteComment($id);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
// Suppression d'un utilisateur
function deleteUser($id)
{
    global $db;
    $userManager = new UserManager($db);
    $deleteUser = $userManager->deleteUser($id);
    header('Location: index.php?action=admin');

    require 'view/admin_view.php';
}
