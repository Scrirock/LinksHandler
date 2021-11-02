<nav>
    <?php
        if (isset($_SESSION['mail'])){?>
            <i class="fas fa-plus-square" id="addButton"></i>
            <a href="?controller=deco" class="buttonMenu">Se déconnecter</a>
        <?php }
        else{ ?>
            <a href="?controller=connexion"><i class="fas fa-user-circle"></i></a>
        <?php }
    ?>
</nav>