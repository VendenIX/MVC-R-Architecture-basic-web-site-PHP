<table>
    <?php foreach($this->tabRuns as $key => $run): ?>
        <tr>
            <td><a href="<?= $this->router->getRunUrl($key) ?>"><?= $run->getPlayer() ?></a></td> <td>a fait une run en <strong><?= $run->getInGameTime() ?></strong> sur <?= $run->getGame() ?> en <strong><?= $run->getMode() ?></strong> le <?= $run->getDate() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
