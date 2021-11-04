<?php
    if (!isset($_SESSION['mail'])){
     header('Location: ?controller=connexion');
    }
    else{ ?>
        <div id="containerEditLink"></div>
        <div id="containerAddLink"></div>
        <h1>Vos liens</h1>
        <div id="containerHomePage"></div>
    <?php }