<?php

use Muffeen\UrlStatus\UrlStatus;
use Scrirock\Links\Entity\Link;
use Scrirock\Links\Manager\DB;
use Scrirock\Links\Manager\LinkManager;
use Scrirock\Links\Manager\UserManager;

require "../../vendor/autoload.php";

header('Content-Type: application/json');

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$manager = new LinkManager();
$user = (new UserManager())->getUserByMail($_SESSION['mail']);

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        echo getLinks($manager);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($_POST['deleteId'])){
            if ($manager->checkUserFk($user['id'], $_POST['deleteId']) || $user['id'] === "1"){
                $manager->deleteLink($_POST['deleteId']);
            }
        }
        if(isset($_POST['editId'], $_POST['editLink'], $_POST['editTitle'], $_POST['editTarget'])){
            $db = new DB();
            $id =  $db->sanitize($_POST['editId']);
            $link =  $db->sanitize($_POST['editLink']);
            $title =  $db->sanitize($_POST['editTitle']);
            $target = $db->sanitize($_POST['editTarget']);

            $linkObject = new Link($link, $title, $target, $id);

            if ($manager->checkUserFk($user['id'], $id) || $user['id'] === "1"){
                $url_status = UrlStatus::get($link);
                if($url_status->getStatusCode() === 200){
                    $manager->modifyLink($linkObject);
                }
            }
        }
        if(isset($_POST['addLink'], $_POST['addTitle'], $_POST['addTarget'])){
            $db = new DB();
            $link =  $db->sanitize($_POST['addLink']);
            $title =  $db->sanitize($_POST['addTitle']);
            $target = $db->sanitize($_POST['addTarget']);

            $linkObject = new Link($link, $title, $target);

            $url_status = UrlStatus::get($link);
            if($url_status->getStatusCode() === 200){
                $manager->addLink($linkObject, $user['id']);
            }
        }
        if (isset($_POST['topic'], $_POST['message'])){
            $to      = 'contact@sc2zmml7017.universe.wf';
            $subject = $_POST['topic'];
            $message = $_POST['message'];
            $headers = 'From: '.$_SESSION['mail'];

            mail($to, $subject, $message, $headers);
        }
        if (isset($_POST['linkId'])){
            $manager->addOne($_POST['linkId']);
        }
        break;
}

function getLinks(LinkManager $manager): string {
    $response = [];

    $data = $manager->getLink();
    foreach($data as $link) {

        $embed_key = 'X4OWrcEVmFHYy0tEF2ITE4jLOrCu';
        $secret = 'pRkuGtewJmQOrZpmdvdIZNqJFB';

        $query = 'url=' . urlencode($link["href"]);

        $token = md5($query . $secret);

        $response[] = [
            'user' => $link["fk_user"],
            'userName' => $link["nom"],
            'href' => $link["href"],
            'title' => $link["title"],
            'target' => $link["target"],
            'name' => $link["name"],
            'id' => $link["linkId"],
            'timeClicked' => $link["timeClicked"],
            'img' => "https://api.thumbalizr.com/api/v1/embed/$embed_key/$token/?$query"
        ];
    }
    return json_encode($response);
}