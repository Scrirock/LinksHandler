<?php

use Scrirock\Links\Manager\UserManager;

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/10b102adea.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Asset/css/style.css">
    <title><?= $title ?></title>
</head>
<body>
<?php include "../View/_partials/menu.view.php"?>
<input type="hidden" id="userId" value="<?= (new UserManager())->getUserByMail($_SESSION['mail'])['id'] ?>">

    <?= $html ?>

<?php include "../View/_partials/footer.view.php"?>
<script src="./Asset/js/app.js" type="module"></script>
</body>
</html>