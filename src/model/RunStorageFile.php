<?php

    class RunStorageFile implements RunStorage {
        private $db;
        function __construct($path = "data/runs") {
            $this->db = new ObjectFileDB($path);
        }

        function reinit() {
            /*je remet à 0 les données*/
            $this->db->deleteAll();
            $this->db->insert(new Run("QueueKyoo","Dark Souls 1","00:20:50","any%", "2022-04-22"));
            $this->db->insert(new Run("catalystz","Dark Souls 1","00:21:17", "any%", " 2020-11-21"));
            $this->db->insert(new Run("Venden","Dark Souls 3","2:10:50", "any%", "2021-07-14"));
            $this->db->insert(new Run("Otzdarva", "Dark Souls 2","12:30:50", "All bosses no hit", "2021-07-14"));
            echo "reinit";
        }

        public function read($id) {
            if($this->db->exists($id)) {
                return $this->db->fetch($id);
            } else {
                return null;
            }
        }

        public function readAll() {
            return $this->db->fetchAll();
        }

        public function create(Run $run) {
            return $this->db->insert($run);
        }

        /*    /* Remplace l'objet d'identifiant $id dans la base
     * par celui passé en paramètre.
     * Lance une exception si l'identifiant est inconnu.
     */
    /*
    public function update($id, $obj) {
        $db = $this->loadArray();
        if ( ! key_exists($id, $db)) {
            throw new Exception("Key does not exist");
        }
        $db[$id] = $obj;
        $this->file_store->saveData($db);
    }*/

        public function update(Run $run, $id) {
            return $this->db->update($id, $run);
        }

        public function updateAll($tabRuns) {
            $this->db->deleteAll();
            foreach($tabRuns as $run) {
                $this->db->insert($run);
            }
        }

        public function delete($id) {
            $this->db->delete($id);
        }
        
    }
?>