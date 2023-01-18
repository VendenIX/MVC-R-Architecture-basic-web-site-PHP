<form action="<?php echo $this->router->getSaveModificationURL($this->id); ?>" method="post">

            <!-- Champ pour le nom du joueur -->
            <label for="player">Player:</label><br>
            <input id="player" type="text" name="<?php echo RunBuilder::PLAYER_REF; ?>"  placeholder="Pseudo" value="<?php echo $this->content["dataForm"][RunBuilder::PLAYER_REF]; ?>"><br>
            
            <!-- Affichage de l'erreur si le nom du joueur n'est pas valide -->
            <?php if (isset($this->content["error"])): 
                if(isset($this->content["error"]["player"])) {
                    echo $this->content["error"]["player"];
                }
            endif; ?>

            <!-- Champ pour le jeu -->
            <label for="game">Game:</label><br>
            <select name="game" id="<?php echo RunBuilder::GAME_REF; ?>">
                <?php foreach(RunBuilder::GAME_LIST as $game): ?>
                    <option value="<?php echo $game; ?>" <?php if ($game == $this->content["dataForm"]["game"]) { echo "selected=\"selected\"";} ?>> <?php echo $game; ?></option>
                <?php endforeach; ?>
            </select><br>
            
            <!-- Champ pour le temps -->
            <label for="inGameTime">In game time:</label><br>
            <input type="text" id="<?php echo RunBuilder::IGT_REF; ?>" placeholder="34:14:02" value="<?php echo $this->content["dataForm"]["inGameTime"] ?>" name="inGameTime"><br>
            
            <!-- Affichage de l'erreur si le temps n'est pas valide -->
            <?php if (isset($this->content["error"])): 
                if(isset($this->content["error"]["inGameTime"])) {
                    echo $this->content["error"]["inGameTime"];
                }
            endif; ?>

            <!-- Champ pour le mode -->
            <label for="mode">Mode:</label><br>
            <select id="mode" name="<?php echo RunBuilder::MODE_REF; ?>">
                <?php foreach(RunBuilder::MODE_LIST as $mode): ?>
                    <option value="<?php echo $mode; ?>" <?php if ($mode == $this->content["dataForm"]["mode"]) { echo "selected=\"selected\"";} ?>> <?php echo $mode; ?></option> 
                <?php endforeach; ?>
            </select><br>

            <!-- Affichage de l'erreur si le mode n'est pas valide -->
            <?php if (isset($this->content["error"])): 
                if(isset($this->content["error"]["mode"])) {
                    echo $this->content["error"]["mode"];
                }
            endif; ?>


            <!-- Champ pour la date -->
            <label for="date">Date:</label><br>
            <input id="date" type="date" name="<?php echo RunBuilder::DATE_REF; ?>" value="<?php echo $this->content["dataForm"]["date"] ?>" min="2011-09-22" max=<?php echo $this->dateDuJour; ?>><br><br>
            
            <!-- Affichage de l'erreur si la date n'est pas valide -->
            <?php if (isset($this->content["error"])): 
                if(isset($this->content["error"]["date"])) {
                    echo $this->content["error"]["date"];
                }
            endif; ?>

            <!-- Bouton pour valider le formulaire -->
            <input type="submit" value="Submit">
</form>