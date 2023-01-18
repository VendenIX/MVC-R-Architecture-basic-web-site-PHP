<?php
    /*
    * Les chemins des fichiers qu'on inclut
    * seront relatifs au répertoire src.
    */
    set_include_path("./src");

    /* Inclusion des classes utilisées dans ce fichier */
    require_once("Router.php");
    require_once('/users/21904263/private/mysql_config.php');

    $router = new Router();


    /* Pour creer le pdo pour ma bdd sql */
    $dsn = 'mysql:host=' . MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DB . ';charset=utf8mb4';
    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //lancement du routeur
    $router->main(new RunStorageMySQL($pdo));

?>