<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Les runs dark souls</title>
        <link href="<?php echo $this->router->getCSSLink();?>" rel="stylesheet" type="text/css">
        <style>
            div {
                background-color: yellow;
            }
            p#first {
                background-color: black;
            }
            nav ul {
                display: grid;
                grid-gap: 15px;
                background-color: black;
                grid-template-columns: auto auto auto auto auto;
                padding: 35px;
                border-bottom: solid;
            }
            nav ul li a{
                color: white;
            }
        </style>
    </head>
    <body>
        <?php
        //affichage de ce qui a dans session feedback
        //echo "this->feedback: " . $this->feedback . "<br>";
        if (key_exists("feedback", $_SESSION)) {
            echo "<div id=first>";
            echo "<p>" . $_SESSION["feedback"] . "</p>"; //mon feedback vaut null
            echo "</div>";
        } 
        ?>
        <header> 
            <nav>
                <ul>
                    <li><a href="<?php echo $this->router->getHomePageUrl(); ?>">Accueil</a></li>
                    <li><a href="<?php echo $this->router->getListPageUrl(); ?>">Liste des runs</a></li>
                    <li><a href="<?php echo $this->router->getRunCreationURL(); ?>">Ajouter ta run</a></li>
                    <li><a href="<?php echo $this->router->getAProposURL(); ?>">A propos</a></li>
                </ul>
            </nav>
        </header>
