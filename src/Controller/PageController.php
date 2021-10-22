<?php

namespace Scrirock\Links\Controller;

use Scrirock\Links\Controller\Traits\RenderViewTrait;
use Scrirock\Links\Manager\LinkManager;

class PageController {

    use RenderViewTrait;

    /**
     * Show the home page
     */
    public function homePage() {
        $this->render('home', 'Accueil', [
            'link' => (new LinkManager())->getLink()
        ]);
    }

}