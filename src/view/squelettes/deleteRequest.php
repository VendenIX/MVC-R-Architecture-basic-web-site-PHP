<h1><?php echo $this->title; ?></h1>
<p><?php echo $this->content["texte"]; ?></p>

<!-- Un bouton pour supprimer la run -->
<?php if(isset($this->run)) { ?>
    <form action="<?php echo $this->router->getRunDeletionURL($this->id);?>" method="post">
        <input type="hidden" name="id" value="<?php echo $this->run->getPlayer(); ?>">
        <input type="submit" value="Supprimer">
    </form>

<!-- Un bouton pour ne pas supprimer la run -->
    <button type="button" onclick="javascript:history.back()">Retour</button>
<?php } ?>
