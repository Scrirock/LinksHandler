<?php

namespace Scrirock\Links\Controller;

use Scrirock\Links\Controller\Traits\RenderViewTrait;
use Scrirock\Links\Entity\Link;
use Scrirock\Links\Manager\DB;
use Scrirock\Links\Manager\LinkManager;
use Muffeen\UrlStatus\UrlStatus;

class LinkController {

    use RenderViewTrait;

    /**
     * Add a link
     * @param array $fields
     */
    public function addLink(array $fields){
        $db = new DB();
        if(isset($fields['link'], $fields['title'], $fields['target'])) {
            $link = $db->sanitize($fields['link']);
            $title = $db->sanitize($fields['title']);
            $target = $db->sanitize($fields['target']);

            $url_status = UrlStatus::get($fields['link']);
            $linkObject = new Link($link, $title, $target);
            if($url_status->getStatusCode() === 200) (new LinkManager())->addLink($linkObject, $_SESSION['mail']);

        }

        $this->render('add.link', "Ajouter un lien");
    }

    /**
     * Add a link
     * @param array $fields
     * @param $rawId
     */
    public function modifyLink(array $fields, $rawId){
        $db = new DB();
        if(isset($fields['link'], $fields['title'], $fields['target'])) {
            $link = $db->sanitize($fields['link']);
            $title = $db->sanitize($fields['title']);
            $target = $db->sanitize($fields['target']);
            $id = $db->sanitize($rawId);

            $linkObject = new Link($link, $title, $target, $id);
            $url_status = UrlStatus::get($fields['link']);
            if($url_status->getStatusCode() === 200) (new LinkManager())->modifyLink($linkObject);
        }

        $this->render('modify.link', "Modifier un lien", [
            'link' => (new LinkManager())->getOneLink($rawId)
        ]);
    }

    public function delete($id){
        $id = (new DB)->sanitize($id);
        (new LinkManager())->deleteLink($id);
    }

}