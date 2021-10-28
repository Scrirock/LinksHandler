<div id="containerContactPage">
    <form action="" method="POST" class="connexionForm">
        <label for="topic">Sujet: </label>
        <input type="text" id="topic" name="topic">
        <label for="message">Votre message: </label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
    </form>
</div>

<?php

if (isset($_POST['topic'], $_POST['message'])){
    $to      = 'contact@sc2zmml7017.universe.wf';
    $subject = $_POST['topic'];
    $message = $_POST['message'];
    $headers = 'From: '.$_SESSION['mail'];

    mail($to, $subject, $message, $headers);
}
