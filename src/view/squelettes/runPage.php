<h1><?php echo $this->title; ?></h1>
<p><?php echo $this->content["texte"]; ?></p>

<!-- Un bouton pour supprimer la run -->
<?php if(isset($this->run)) { ?>
    <form action="<?php echo $this->router->getRunAskDeletionURL($this->id); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $this->run->getPlayer(); ?>">
        <input type="submit" value="Supprimer">
    </form>

<!-- Un bouton pour modifier la run -->
    <form action="<?php echo $this->router->getRunModificationURL($this->id); ?>" method="post">
        <input type="submit" value="Modifier">
    </form>
<?php } ?>