<?php 

    class Run {
        private $player;
        private $inGameTime;
        private $game;
        private $mode;
        private $date;

        public function __construct($player, $game, $inGameTime, $mode, $date) {
            $this->player = $player;
            $this->inGameTime = $inGameTime;
            $this->game = $game;
            $this->mode = $mode;
            $this->date = $date;
        }

        public function getPlayer() {
            return $this->player;
        }

        public function getInGameTime() {
            return $this->inGameTime;
        }

        public function getGame() {
            return $this->game;
        }

        public function getMode() {
            return $this->mode;
        }

        public function getDate() {
            return $this->date;
        }
    }

?>