<?php
    class RunStorageMySQL implements RunStorage {
        public $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
    
        /*
        * Retourne la run d'id $id
        */
        public function read($id) {
            $requete = "SELECT player,game,time,mode,date FROM runs WHERE id= :id";
            $stmt = $this->pdo->prepare($requete);
            $stmt->execute(array(':id' => $id));
            $run = $stmt->fetch();
            return new Run($run['player'],$run['game'],$run['time'],$run['mode'],$run['date']);
        }

        /*
        * Renvoie la liste de toutes les runs
        */
        public function readAll() {
            $requete = "SELECT * FROM runs;";
            $stmt = $this->pdo->query($requete);
            $data = $stmt->fetchAll();
            $runs = array();
            foreach($data as $d) {
                $run= new Run($d['player'],$d['game'],$d['time'],$d['mode'],$d['date']);
                $runs[$d['id']] = $run;
            }
            return $runs;
        }

        /*
        * Creer une run $run dans la base de données
        */
        public function create(Run $run) {
            $db = $this->getIds();
            $id = $this->generate_id($db);
            $requete = "INSERT INTO runs(id, player, game, time, mode, date) VALUES (:id, :player, :game, :time, :mode, :date);";
            $stmt = $this->pdo->prepare($requete);
            $stmt->execute(array(':id' => $id, ':player' => $run->getPlayer(), ':game' => $run->getGame(), ':time' => $run->getInGameTime(), ':mode' => $run->getMode(), ':date' => $run->getDate()));
            return $id;
        }

        /*
        * Met à jour la run d'id $id avec les nouvelles valeurs de run $run
        */
        public function update(Run $run, $id) {
            $requete = "UPDATE runs SET player= :player, game= :game ,time= :time, mode= :mode, date= :date WHERE id= :id;";
            $stmt = $this->pdo->prepare($requete);
            $stmt->execute(array(':id' => $id, ':player' => $run->getPlayer(), ':game' => $run->getGame(), ':time' => $run->getInGameTime(), ':mode' => $run->getMode(), ':date' => $run->getDate()));
        }

        /*
        *  Supprime la run d'id $id
        */
        public function delete($id) {
            $requete = "DELETE FROM runs WHERE id= :id";
            $stmt = $this->pdo->prepare($requete);
            return  $stmt->execute(array(':id' => $id));
        }

        /*
        * Genere un id unique pour une run (Repris de votre code ObjectFileDB)
        */
        static private function generate_id($db) {
            do {
                $id = bin2hex(openssl_random_pseudo_bytes(8));
            } while (is_numeric($id[0]) || key_exists($id, $db));
    
            return $id;
        }

        /*
        * Réinitilise la base de données avec uniquement les runs : 
        * Run("QueueKyoo","Dark Souls 1","00:20:50","any%", "2022-04-22"));
        * Run("catalystz","Dark Souls 1","00:21:17", "any%", " 2020-11-21"));
        * Run("Venden","Dark Souls 3","2:10:50", "any%", "2021-07-14"));
        * Run("Otzdarva", "Dark Souls 2","12:30:50", "All bosses no hit", "2021-07-14"));
        */
        public function resetDataBase() {
            $requete = "DELETE FROM runs;";
            $stmt = $this->pdo->prepare($requete);
            $stmt->execute();
            $this->create(new Run("QueueKyoo","Dark Souls 1","00:20:50","any%", "2022-04-22"));
            $this->create(new Run("catalystz","Dark Souls 1","00:21:17", "any%", " 2020-11-21"));
            $this->create(new Run("Venden","Dark Souls 3","2:10:50", "any%", "2021-07-14"));
            $this->create(new Run("Otzdarva", "Dark Souls 2","12:30:50", "All bosses no hit", "2021-07-14"));
            $this->create(new Run("Ambroise", "Dark Souls 2","15:12:42", "no death", "2017-07-27"));
        }

        public function getIds() {
            $requete = "SELECT id FROM runs;";
            $db = $this->pdo->query($requete)->fetchAll();
            $tabId = array();
            foreach($db as $d) {
                $tabId[$d['id']] = ($d['id']);
            }
            return $tabId;
        }
    }

?>