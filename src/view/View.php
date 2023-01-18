<?php 
    class View {
        private $title;
        private $content = array();
        private $router;
        private $run;
        private $tabRuns;
        private $dateDuJour = "";
        private $id;
        private $runBuilder;

        private string $squelette;

        /*
        * Constructeur de la classe View
        * @param Router $router
        */
        function __construct($router,$feedback) {
            $this->router = $router;
            $this->squelette = "homePage";
            $this->dateDuJour = date("Y-m-d");
            $this->feedback = $feedback;
        }

        /*
        *   Fait l'affichage, le rendu final de la page en fonction du squelette choisit
        */
        public function render() {
            include "squelettes/header.php";

            include "squelettes/$this->squelette.php";

            include "squelettes/footer.php";
            
        }

        /*
        *  Choisis une page Run avec les informations de la run passée en paramètre
        */
        public function makeRunPage(Run $run, $id) {
            $this->id = $id;
            $this->title = "[" . $run->getPlayer() . "] ";
            $this->content["texte"] = "In game time: " . $run->getInGameTime() . "<br>Game: " . $run->getGame() . "<br>Route: " . $run->getMode() . "<br>Date: " . $run->getDate();
            $this->run = $run;
            $this->squelette = "runPage";
            
        }

        /*
        *   Choisis une page d'erreur
        */
        public function makeUnknownRunPage() {
            $this->title = "Unknown run";
            $this->content["texte"] = "Error: unknown run";
            $this->squelette = "unknownRunPage";
        }

        public function makeAProposPage() {
            $this->title = "A propos";
            $this->content["texte"] = "Page d'information";
            $this->squelette = "aProposPage";
        }

        /*
        *   Choisis la page d'accueil
        */
        public function makeHomePage() {
            $this->title = "Les meilleurs runs de Dark Souls";
            $this->content["texte"] = "Ce site vous présentera les meilleurs runs sur les jeux vidéos Dark Souls 1, 2 et 3.
            Un challenge run est une session de jeu dans laquelle le joueur doit réaliser un objectif particulier, comme par exemple finir le jeu sans mourir, ou encore finir le jeu en moins de 10 minutes.";
            $this->squelette = "homePage";
        }

        /*
        *   Choisis la page avec la liste des runs
        */
        public function makeListPage($tabRuns) {
            $this->title = "Liste des runs:";
            $this->content["texte"] = "Voici la liste des runs: <br>";
            $this->tabRuns = $tabRuns;
            $this->squelette = "listPage"; 
        }

        /*
        *   Choisis la page de création de run
        *  (FORMULAIRE DE CREATION)
        */
        public function makeRunCreationPage(RunBuilder $runBuilder) {
            $this->title = "Création d'un run";
            $this->content["texte"] = "Création d'un run";
            $this->content["dataForm"] = $runBuilder->getData();
            $this->content["error"] = $runBuilder->getError();
            //$this->runBuilder = $runBuilder;
            $this->squelette = "newRunForm";        
        }

        /*
        *  Choisis la page de modification de run
        */
        public function makeModificationRunPage(RunBuilder $runBuilder, $id) {
            $this->title = "Modification d'un run";
            $this->content["texte"] = "Modification d'un run";
            $this->content["dataForm"] = $runBuilder->getData();
            $this->content["error"] = $runBuilder->getError();
            $this->id = $id;
            //$this->runBuilder = $runBuilder;
            $this->squelette = "modificationPage";        
        }

        /*
        *   Choisis la page de demande de suppression de run
        */
        public function makeRunDeleteRequestPage(Run $run, $id) {
            $this->id = $id;
            $tmp = $run->getPlayer();
            $this->run = $run;
            $this->title  = "Demande de suppresion d'une run";
            $this->content["texte"] = "Voulez-vous supprimer la run $tmp ?";
            $this->squelette = "deleteRequest";
        }

        /*
        *   Choisis la page de confirmation de suppression de run
        */
        public function makeRunDeletePage() {
            $this->title = "Suppression d'une run";
            $this->content["texte"] = "La run a bien été supprimée";
            $this->squelette = "deletePage";
        }

        //DISPLAY CREATION
        public function displayRunCreationSuccess($id) {
            $this->feedback = "La run a bien été créée, je vous renvoie vers lage page de la run";
            $this->router->POSTredirect($this->router->getRunURL($id), $this->feedback);
        }
        public function displayRunCreationFailure() {
            $this->feedback = "La run n'a pas pu être créée, je vous renvoie au formulaire";
            $this->router->POSTredirect($this->router->getRunCreationURL(), $this->feedback);
        }
        //DISPLAY DELETE 
        public function displayRunDeleteSuccess() {
            $this->feedback = "La run a bien été supprimée, je vous redirige vers la page d'accueil";
            $this->router->POSTredirect($this->router->getHomePageUrl(), $this->feedback);
        }
        public function displayRunDeleteFailure($id) {
            $this->feedback = "La run n'a pas pu être supprimée, je vous redirige vers la page de demande de suppression de la run";
            $this->router->POSTredirect($this->router->getRunDeletionURL($id), $this->feedback);
        }
        //DISPLAY MODIFICATION
        public function displaySaveRunModificationSuccess($id) {
            $this->feedback = "La run a bien été modifiée, je vous redirige vers la page de la run";
            $this->router->POSTredirect($this->router->getRunURL($id), $this->feedback);
        }
        public function displaySaveRunModificationFailure($id) {
            $this->feedback = "La run n'a pas pu être modifiée, vous avez fait une erreur";
            $this->router->POSTredirect($this->router->getRunModificationURL($id), $this->feedback);
        }

        
    }
?>