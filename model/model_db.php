<?php
function dbConnection()
{
    try {
        return new PDO('mysql:host=db5006527767.hosting-data.io;dbname=dbs5416493;charset=utf8', 'dbu905972', '2308040691', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
}
