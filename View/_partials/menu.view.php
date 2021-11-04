<nav>
    <?php
        if (isset($_SESSION['mail'])){?>
            <i class="fas fa-plus-square" id="addButton"><div id="hiddenText">Ajouter un lien</div></i>
            <a href="/" class="buttonMenu">Acceuil</a>
            <a href="?controller=stats" class="buttonMenu">Statistique</a>
            <a href="?controller=deco" class="buttonMenu">Se déconnecter</a>
        <?php }
        else{ ?>
            <a href="?controller=connexion"><i class="fas fa-user-circle"></i></a>
        <?php }
    ?>
</nav>