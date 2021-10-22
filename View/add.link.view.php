<h1 class="littleTitle">Ajouter un lien</h1>

<form action="" method="POST" class="connexionForm">
    <div>
        <label for="link">Lien: </label>
        <input type="text" id="link" name="link">
    </div>
    <div>
        <label for="title">Titre: </label>
        <input type="text" id="title" name="title">
    </div>
    <div>
        <label for="target">S'ouvre: </label>
        <select name="target" id="target">
            <option value="_blank">Dans une autre page</option>
            <option value="_self">Sur la même page</option>
        </select>
    </div>
    <div>
        <input type="submit" value="Ajouter">
    </div>
</form>