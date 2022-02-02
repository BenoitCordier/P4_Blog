<?php
// Routeur

session_start();
require 'controller/controller.php';

// Routing des requêtes liées à l'indentification
function registrationRouting()
{
    switch ($_GET['action']) {
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
            header("HTTP/1.0 404 Not Found");
    }
}
// Routing des requêtes liées à la navigation
function postAndCommentsRouting()
{
    switch ($_GET['action']) {
        case 'listPosts':
            listPosts();
        break;
        
        case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                postAndComments($_GET['id']);
            }
        break;

        case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                addComment($_GET['id'], $_SESSION['userName'], $_POST['commentContent']);
            }
        break;

        case 'alertComment':
            alertComment($_GET['id'], $_GET['postId']);
        break;

        default:
            header("HTTP/1.0 404 Not Found");
    }
}
// Routing des requêtes liées à l'administration
function administrationRouting()
{
    switch ($_GET['action']) {
        case 'admin':
            adminDashboardOnLoad();
        break;

        case 'newPost':
            newPost($_POST['postTitle'], $_POST['postContent']);
        break;

        case 'modifyPost':
            modifyPost($_GET['id']);
        break;

        case 'updatePost':
            updatePost($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
        break;

        case 'deletePost':
            deletePost($_GET['id']);
        break;

        case 'deleteComment':
            deleteComment($_GET['id']);
        break;

        case 'clearComment':
            clearComment($_GET['id']);
        break;

        case 'deleteUser':
            deleteUser($_GET['id']);
        break;

        default:
            header("HTTP/1.0 404 Not Found");
    }
}
// Paramétrage erreur 404
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'logIn':
        case 'signIn':
        case 'logOut':
            registrationRouting();
        break;
    
        case 'listPosts':
        case 'post':
        case 'addComment':
        case 'alertComment':
            postAndCommentsRouting();
        break;

        case 'admin':
        case 'deleteComment':
        case 'clearComment':
        case 'deleteUser':
        case 'deletePost':
        case 'modifyPost':
        case 'updatePost':
        case 'newPost':
            administrationRouting();
        break;
    
        default:
            header("HTTP/1.0 404 Not Found");
    }
} else {
    listPosts();
}
