<?php 
    
    class RunBuilder {
        private $data;
        private $error = null;
        //ajout des constantes player, game, inGameTime, mode, date:
        const PLAYER_REF = "player";
        const GAME_REF = "game";
        const IGT_REF = "inGameTime";
        const MODE_REF = "mode";
        const DATE_REF = "date";
        const GAME_LIST = ["Dark Souls 1", "Dark Souls 2", "Dark Souls 3"];
        const MODE_LIST = ["No death", "No bonfire", "No hit", "ABNH (All bosses no hit)", "any%", "100%", "SL1 (Soul Level 1)"];

        public function __construct(array $data = array()) {
            if($data === array()) {
                $this->data = array(
                    self::PLAYER_REF => '',
                    self::GAME_REF => '',
                    self::IGT_REF => '',
                    self::MODE_REF => '',
                    self::DATE_REF => ''

                );
            } else {
                $this->data = $data;
            }
        }

        public function getData() {
            return $this->data;
        }

        public function getError() {
            return $this->error;
        }
        
        public function createRun() {
            return new Run($this->data[self::PLAYER_REF], $this->data[self::GAME_REF], $this->data[self::IGT_REF], $this->data[self::MODE_REF], $this->data[self::DATE_REF]);
        }

        public function modifyRun(Run $run) {
            $run->setPlayer($this->data[self::PLAYER_REF]);
            $run->setGame($this->data[self::GAME_REF]);
            $run->setInGameTime($this->data[self::IGT_REF]);
            $run->setMode($this->data[self::MODE_REF]);
            $run->setDate($this->data[self::DATE_REF]);
        }

        public function setPlayer($player) {
            $this->data[self::PLAYER_REF] = $player;
        }

        public function setGame($game) {
            $this->data[self::GAME_REF] = $game;
        }

        public function setInGameTime($inGameTime) {
            $this->data[self::IGT_REF] = $inGameTime;
        }

        public function setMode($mode) {
            $this->data[self::MODE_REF] = $mode;
        }

        public function setDate($date) {
            $this->data[self::DATE_REF] = $date;
        }

        /*
        * Vérifie si les données sont valides
        */
        public function isValid() {
            $errorData = array();
            foreach($this->data as $key => $value) {
                if($value == "") {
                    $this->error = true;
                }
                if($key == self::IGT_REF) {
                    //si le temps n'est pas au bon format, on affiche une erreur
                    if(!preg_match("/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/",$value)) {
                        $this->error = true;
                        $errorData[$key] = "Le temps n'est pas au bon format (hh:mm:ss) <br>";
                    }
                }

                if($key === self::DATE_REF) {
                    //si la date n'est pas au bon format, on affiche une erreur
                    if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$value)) {
                        $this->error_clear_lasterror = true;
                        $errorData[$key] = "La date n'est pas au bon format (format attendu : AAAA-MM-JJ) <br>";
                    }
                }

                if($key === self::MODE_REF) {
                    //si value n'est pas dans notre listes de modes, on affiche une erreur
                    if(!in_array($value, self::MODE_LIST)) {
                        $this->error = true;
                        $errorData[$key] = "Veuillez choisir parmis les jeux proposés <br>";
                    }
                }

                if($key === self::GAME_REF) {
                    //si value n'est pas dans notre listes de modes, on affiche une erreur
                    if(!in_array($value, self::GAME_LIST)) {
                        $this->error = true;
                        $errorData[$key] = "Veuillez choisir parmis les jeux proposés <br>";
                    }
                }

                if($key === self::PLAYER_REF) {
                    //si le pseudo comporte des caractères spéciaux et que sa longueur est inférieur a 3 ou superieure a 20:
                    if(!preg_match("/^[a-zA-Z0-9 ]*$/",$value) || strlen($value) < 3 || strlen($value) > 20) {
                        $this->error = true;
                        $errorData[$key] = "Le pseudo doit contenir entre 3 et 20 caractères alphanumériques <br>";
                    } 
                }
            }
            if($this->error) {
                $this->error = $errorData;
                return false;
            } else {
                return true;
            }
        }
     }
    
?>