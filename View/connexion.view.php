<div id="containerConnexionPage">
    <form action="" method="POST" class="connexionForm">
        <div class="card">
            <div class="card-form">
                <div class="input">
                    <input type="text" class="input-field" id="mail" name="mail" required/>
                    <label class="input-label" for="mail">Email</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" id="password" name="password" required/>
                    <label class="input-label" for="password">Mot de passe</label>
                </div>
                <div class="action">
                    <input type="submit" class="action-button" id="divAdd" value="Se connecter">
                </div>
            </div>
        </div>
        <div><a href="?controller=addUser" id="inscription">Pas encore inscrit ?</a></div>
    </form>
</div>
