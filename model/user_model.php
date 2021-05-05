<?php
function getBillets()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=article;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->query('SELECT id, article_name, article_content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date FROM article ORDER BY post_date DESC LIMIT 0, 5');

    return $req;
}
?>