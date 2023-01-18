<?php 
    class Controller {
        private $view;
        private $storage;
        private $run;
        /*
        * Constructeur de la classe Controller
        * @param View $view
        * @param Storage $storage
        */
        function __construct($view, RunStorage $storage) {
            $this->view = $view;
            $this->storage = $storage;
        }

        /*
        OK
        *  Demande la page run de l'id passé en paramètre si elle existe, sinon affiche une page d'erreur
        */
        public function showInformation($id) {
            if(key_exists($id,$this->storage->readAll())) {
                $value = $this->storage->read($id);
                $this->view->makeRunPage(new Run($value->getPlayer(),$value->getGame(),$value->getInGameTime() , $value->getMode(), $value->getDate()), $id);
            } else {
                $this->view->makeUnknownRunPage();
            }
        }

        /*
        OK
        *   Demande la page d'accueil
        */
        public function showHome() {
            $this->view->makeHomePage();
        }

        /*
        OK
        *   Demande la page avec la liste de toutes les runs
        */
        public function showList() {
            $this->view->makeListPage($this->storage->readAll());
        }
        
        /*
        OK
        * Retourne une Run avec les informations passées en paramètre en tenant compte de SESSION
        *
        */
        public function newRun($data) {
            if(key_exists("currentCreationBuilder",$_SESSION) && $_SESSION["currentCreationBuilder"] != null) {
                return $_SESSION["currentCreationBuilder"];
            } else {
                return new RunBuilder($data);
            }
        }

        /*
        OK
        * Choisis d'afficher la page a propos
        */
        public function showAPropos() {
            $this->view->makeAProposPage();
        }

        /*
        SEMBLE OK
        *   Fonction qui gère les données entrées par l'utilisateur quand il envoie un formulaire de run
        */
        public function saveNewRun($data) {
            
            $runBuilder = new RunBuilder($data);
            $run = $runBuilder->createRun();
            /*Si les données entrées sont correctes */
            if($runBuilder->isValid()) {
                ///////////////////////////////////////////////////////////////////////////
                //$this->storage->updateAll($this->tabRuns);
                $id = $this->storage->create($run);
                $_SESSION["currentCreationBuilder"] = null;
                $this->view->displayRunCreationSuccess($id); 
                
                //petit console.log de $this->storage->create($run) pour voir si ça marche
                
            } else {
                //var_dump($data);
                //si des données ne sont pas correctes, on renvoie le même formulaire avec les données déjà entrées
                $_SESSION['currentCreationBuilder'] = $runBuilder;
                //$this->view->makeRunCreationPage($runBuilder);
                $this->view->displayRunCreationFailure();
            }
        }

        /*
        SEMBLE OK
        * Faire la page de modification de la run id
        */
        public function makeModificationRunPage($id) {
            //si l'id existe dans la base de données
            if (key_exists($id, $this->storage->readAll())) {
                if(!key_exists("currentModificationBuilder",$_SESSION) || $_SESSION["currentModificationBuilder"] == null) {
                    $value = $this->storage->read($id);
                    $run = array();
                    $run["player"] = $value->getPlayer();
                    $run["game"] = $value->getGame();
                    $run["inGameTime"] = $value->getInGameTime();
                    $run["mode"] = $value->getMode();
                    $run["date"] = $value->getDate();
                    $runBuilder = new RunBuilder($run);
                    $this->view->makeModificationRunPage($runBuilder, $id);
                } else {
                    $this->view->makeModificationRunPage($_SESSION["currentModificationBuilder"], $id);
                }
            } else {
                $this->view->makeUnknownRunPage();
            }
        }

        /*
        * A VOIR
        *  Fonction qui gère les données entrées par l'utilisateur quand il envoie un formulaire de run
        */
        public function saveModificationRun($data, $id) {
            $this->run = $this->storage->read($id);
            $runBuilder = new RunBuilder($data);
            $run = $runBuilder->createRun();
            /*Si les données entrées sont correctes */
            if($runBuilder->isValid()) {
                $this->storage->update($run,$id);
                $this->view->displaySaveRunModificationSuccess($id);
                $_SESSION["currentModificationBuilder"] = null;
            } else {
                //si des données ne sont pas correctes, on renvoie le même formulaire avec les données déjà entrées
                $_SESSION['currentModificationBuilder'] = $runBuilder;
                $this->view->displaySaveRunModificationFailure($id);
                
            }
        }

        /*
        * OK
        *   Demande la page de création de run (Formulaire)
        */
        public function makeDefaultForm($data) {
            $this->view->makeRunCreationPage($data);
        }

        /*
        * OK
        *   Demande la page d'erreur
        */
        public function makeErrorPage() {
            $this->view->makeUnknownRunPage();
        }

        /*
        * OK
        *   Demande la page de suppression
        */
        public function makeDeletePage() {
            $this->view->makeRunDeletePage();
        }

        /*
        * OK
        *   vérifie que la run existe avant d'appeler makeRunDeletionPage($id) (un message d'erreur doit être affiché dans le cas contraire).
        */
        public function askRunDeletion($id) {
            if(key_exists($id,$this->storage->readAll())) {
                $this->view->makeRunDeleteRequestPage($this->storage->read($id), $id);
            } else {
                $this->makeErrorPage();
            }
        }

        /*
        * OK
        *   Supprime la run de l'id passé en paramètre
        */
        public function deleteRun($id) {
            $this->storage->delete($id);
            if (key_exists($id,$this->storage->readAll())) {
                $this->view->displayRunDeleteFailure($id);
            } else {
                $this->view->displayRunDeleteSuccess();
            }
            //$this->makeDeletePage();
        }


    }
?>