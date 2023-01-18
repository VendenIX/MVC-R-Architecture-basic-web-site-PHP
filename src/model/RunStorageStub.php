<?php

    class RunStorageStub implements RunStorage {
        private $RunsTab;
        function __construct() {
            $this->RunsTab = array(
                "queueKyoo" => new Run("QueueKyoo","Dark Souls 1","00:20:50", "any%", "2022-04-22"),
                "catalystz" => new Run("catalystz","Dark Souls 1","21:17", "any%", " 2020-11-21"),
                "venden" => new Run("Venden","Dark Souls 3","2:10:50", "any%", "2021-07-14"),
                "otzdarva" => new Run("Otzdarva","Dark Souls 2","12:30:50", "All bosses no hit", "2021-07-14")
            );
        }
        public function read($id) {
            if(key_exists($id,$this->RunsTab)) {
                return $this->RunsTab[$id];
            } else {
                return null;
            }
        }
        public function readAll() {
            return $this->RunsTab;
        }

        public function create(Run $run) {
            return $this->RunsTab[$run->getPlayer()] = $run;
            //le return est peut être de trop
        }
    }

?>