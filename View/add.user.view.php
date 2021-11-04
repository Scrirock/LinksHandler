<?php
if(isset($_SESSION['error?'])){
    echo "<div id='error'>".$_SESSION['error?']."</div>";
    session_destroy();
    session_start();
}
else{
    session_destroy();
    session_start();
}
?>
<h1 class="littleTitle">S'inscrire</h1>

<form action="" method="POST" class="connexionForm">
    <div class="card">
        <div class="card-form">
            <div class="input">
                <input type="text" class="input-field" id="firstName" name="firstName" required/>
                <label class="input-label" for="firstName">Prénom</label>
            </div>
            <div class="input">
                <input type="text" class="input-field" id="lastName" name="lastName" required/>
                <label class="input-label" for="lastName">Nom</label>
            </div>
            <div class="input">
                <input type="text" class="input-field" id="mail" name="mail" required/>
                <label class="input-label" for="mail">Email</label>
            </div>
            <div class="input">
                <input type="password" class="input-field" id="password" name="password" required/>
                <label class="input-label" for="password">Mot de passe</label>
            </div>
            <div class="action">
                <input type="submit" class="action-button" id="divAdd" value="S'inscrire">
            </div>
        </div>
    </div>
</form>

