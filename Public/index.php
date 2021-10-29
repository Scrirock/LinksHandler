<?php

use Scrirock\Links\Controller\PageController;
use Scrirock\Links\Controller\UserController;
use Scrirock\Links\Controller\LinkController;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

ini_set('session.gc_maxlifetime', 600);
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'connexion':
            (new UserController())->connexion($_POST);
            break;
        case 'addUser':
            (new UserController())->addUser($_POST);
            break;
        case 'addLink':
            (new LinkController())->addLink($_POST);
            break;
        case 'modifyLink':
            (new LinkController())->modifyLink($_POST, $_GET['id']);
            break;
        case 'deleteLink':
            (new LinkController())->delete($_GET['id']);
            break;
        case 'contactForm':
            (new PageController())->contactForm();
            break;
        case 'deco':
            (new PageController())->deco();
            break;
    }
}
else {
    (new PageController())->homePage();
}
