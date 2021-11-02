<div id="statContainer">
    <h1>Statistique</h1>
    <?php

    use Scrirock\Links\Manager\UserManager;

    if (isset($var['links'])){
        $linksNumber = 0;
        $totalTimeClicked = 0;
        $user = (new UserManager())->getUserByMail($_SESSION['mail'])['id'];
        $linksArray = [];
        $commonLinks = 0;
        foreach ($var['links'] as $link){
            if ($link["fk_user"] === $user){
                $totalTimeClicked += $link['timeClicked'];
                $linksNumber ++;
                $linksArray[] = $link['href'];
            }
        }?>
        <p class="statLine">Vous avez <?= $linksNumber ?> lien(s)</p>
        <p class="statLine">Vous avez cliqué sur <?= $totalTimeClicked ?> lien(s) en tout</p>
        <?php
        foreach ($var['links'] as $link){
            if (in_array($link['href'], $linksArray) && $link['fk_user'] !== $user){
                $commonLinks++;
            }
        } ?>
        <p>Vous avez <?= $commonLinks ?> lien(s) en commun avec les autres utilisateurs</p> <?php
        }
    ?>
</div>
<div id="graph">
    <canvas id="myChart" width="50" height="50"></canvas>
</div>