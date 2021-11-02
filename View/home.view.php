<input type="hidden" id="userId" value="<?= (new \Scrirock\Links\Manager\UserManager())->getUserByMail($_SESSION['mail'])['id'] ?>">
<div id="containerEditLink"></div>
<div id="containerAddLink"></div>
<div id="containerHomePage"></div>