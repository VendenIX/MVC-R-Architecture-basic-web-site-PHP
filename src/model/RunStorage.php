<?php
    interface RunStorage {
        // renvoyer l'instance de Run ayant pour identifiant celui passé en argument, ou null si aucun run n'a cet identifiant
        public function read($id);

        // renvoyer un tableau associatif identifiant ⇒ run contenant tous les animaux de la « base ».
        public function readAll();

        // créer un nouveau run dans la « base » à partir de l'instance de Run passée en argument.
        public function create(Run $run);
    }
?>