<nav>
    <?php
        if (isset($_SESSION['mail'])){?>
            <a href="?controller=addLink"><i class="fas fa-plus-square"></i>Ajouter un lien</a>
        <?php }
        else{ ?>
            <a href="?controller=connexion"><i class="fas fa-user-circle"></i></a>
        <?php }
    ?>
</nav>