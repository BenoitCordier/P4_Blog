<?php
function dbConnection() {
    try
	{
	    return new PDO('mysql:host=localhost;dbname=project_4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
}

