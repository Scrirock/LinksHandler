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
        $this->render('home', 'Accueil');
    }

    public function contactForm(){
        $this->render('contact', 'Contact');
    }

    public function deco(){
        session_destroy();
        session_start();
        header('Location: /');
    }

}