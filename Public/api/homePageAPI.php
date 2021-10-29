<?php

use Scrirock\Links\Manager\LinkManager;

require "../../vendor/autoload.php";

header('Content-Type: application/json');

$manager = new LinkManager();
if ($_SERVER['REQUEST_METHOD'] === "GET"){
    echo getLinks($manager);
}

function getLinks(LinkManager $manager): string {
    $response = [];

    $data = $manager->getLink();
    foreach($data as $link) {

        $response[] = [
            'user' => $link["fk_user"],
            'href' => $link["href"],
            'title' => $link["title"],
            'target' => $link["target"],
            'name' => $link["name"],
            'id' => $link["id"]
        ];
    }
    return json_encode($response);
}