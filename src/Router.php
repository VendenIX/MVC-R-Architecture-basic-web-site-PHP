<?php
    include "model/Run.php";
    include "model/RunStorage.php";
    include "model/RunStorageStub.php";
    include "model/RunStorageFile.php";
    include "model/RunBuilder.php";
    include "model/RunStorageMySQL.php";
    include "view/View.php";

    include "control/Controller.php";

    include "lib/ObjectFileDB.php";
    include "lib/FileStore.php";
    
    class Router {
        
        /*
        *   gère les différentes routes, et qui appelle les fonctions du controlleur en fonction de la route de l'utilisateur
        */        
        public function main($storage) {
            session_start();
            //si on a pas de feedback dans la session, on en crée un
            
            if(!(key_exists("feedback",$_SESSION))){
                $_SESSION["feedback"] = "";
                $view = new View($this,$_SESSION["feedback"]);
            } else {
                $view = new View($this,$_SESSION["feedback"]);
            }
            
            $controler = new Controller($view, $storage);

            if(key_exists("PATH_INFO",$_SERVER)) {
                            //pareil en utilisant $_SERVER["PATH_INFO"] et pas $_SERVER["REQUEST_URI"]:
                $url = $_SERVER["PATH_INFO"]; //donne l'url de la page
                $url = explode("/", $url); //découpe mon url en tableau
                $url = array_filter($url); //enlève les éléments vides du tableau genre ""
                
            
                if(isset($url[1]) && !isset($url[2])) {
                    
                    switch($url[1]) {
                        case "liste":
                            $controler->showList();
                            break;
                        case "aPropos":
                            $controler->showAPropos();
                            break;
                        case "nouveau":
                            $controler->makeDefaultForm($controler->newRun(array()));
                            break;
                        case "sauverNouveau":
                            $controler->saveNewRun($_POST);
                            break;
                        default:
                            $controler->makeErrorPage();
                            break;
                    }
                } elseif(isset($url[2])) {
                    switch($url[1]) {
                        case "run":
                            $controler->showInformation($url[2]);
                            break;
                        case "delete":
                            $controler->deleteRun($url[2]);
                            break;
                        case "deleteRequest":
                            $controler->askRunDeletion($url[2]);
                            break;
                        case "modification":
                            $controler->makeModificationRunPage($url[2]);
                            break;
                        case "sauverNouveau":
                            $controler->saveModificationRun($_POST,$url[2]);
                            break;
                        default:
                            $controler->makeErrorPage();
                            break;
                    }
                } else {
                    $controler->showHome();
                }
            } else {
                $controler->showHome();
            }

            

            $view->render(); 
            unset($_SESSION["feedback"]);    
            
            
            
        }

        public function getRunUrl($id) {
            return $_SERVER['SCRIPT_NAME'] . "/run/" . $id;
        }

        public function getId() {
            //faudra modif et prendre le 3e element du tableau
            if(key_exists("id",$_GET)) {
                return $_GET["id"];
            } else {
                return null;
            }
        }

        public function getRunCreationURL() {
            return $_SERVER['SCRIPT_NAME'] . "/nouveau";
        }

        public function getRunSaveURL() {
            return $_SERVER['SCRIPT_NAME'] . "/sauverNouveau";
        }

        public function getSaveModificationURL($id) {
            return $_SERVER['SCRIPT_NAME'] . "/sauverNouveau/" . $id;
        }

        public function getRunModificationURL($id) {
            return $_SERVER['SCRIPT_NAME'] . "/modification/" . $id;
        }

        public function getHomePageUrl() {
            return $_SERVER['SCRIPT_NAME'];
        }

        public function getListPageUrl() {
            return $_SERVER['SCRIPT_NAME'] . "/liste";
        }

        //page demandant à l'internaute de confirmer son souhait de supprimer la run
        public function getRunAskDeletionURL($id) {
            return $_SERVER['SCRIPT_NAME'] . "/deleteRequest/" . $id;
        }

        //page supprimant effectivement la run
        public function getRunDeletionURL($id) {
            return $_SERVER['SCRIPT_NAME'] . "/delete/" . $id;
        }

        public function getAProposURL() {
            return $_SERVER['SCRIPT_NAME'] . "/aPropos";
        }

        //fonction qui permet d'envoyer une réponse HTTP de type 303 See Other demandant au client de se rediriger vers l'URL $url
        public function POSTredirect($url,$feedback) {
            $_SESSION["feedback"] = $feedback;
            header("Location: " . $url, true, 303);
            exit();
        }

        /*
        * Donne l'url du css
        * J'aime pas faire comme ça mais j'ai pas trouver d'autre solution
        */
        public function getCSSLink() {
            return "https://dev-21904263.users.info.unicaen.fr/2022/TP11/versionRunsDS1/src/view/styles/styles.css";
        }

    }

?>
