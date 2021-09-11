<?php
session_start();
require 'controller/controller.php';

switch ($_GET['action'])
{
    case 'logIn':
    case 'signIn':
    case 'logOut':
        identification();
    break;

    case 'listPosts':
    case 'post':
    case 'addComment':
    case 'admin':
        navigation();
    break;

    default:
        listPosts();
}