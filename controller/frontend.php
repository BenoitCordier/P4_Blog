<?php

require('user_model.php');

function listPosts()
{
    $posts = getPosts();

    require('home_view.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('post_view.php');
}