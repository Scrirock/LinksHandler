<?php


namespace Scrirock\Links\Controller;

use Scrirock\Links\Controller\Traits\RenderViewTrait;
use Scrirock\Links\Manager\DB;
use Scrirock\Links\Entity\User;
use Scrirock\Links\Manager\UserManager;

class UserController{

    use RenderViewTrait;

    /**
     * Log a user
     * @param array $fields
     */
    public function connexion(array $fields)
    {
        if (isset($fields['mail'], $fields['password'])) {
            $mail = (new DB)->sanitize($fields['mail']);
            $password = (new DB)->sanitize($fields['password']);
            if ((new UserManager)->checkUser($mail, $password)){
                $_SESSION['mail'] = $mail;
                header("Location: /");
            }
        }

        $this->render('connexion', 'Connexion');
    }

    /**
     * Add an user
     * @param $fields
     */
    public function addUser(array $fields){
        $db = new DB();
        if(isset($fields['firstName'], $fields['lastName'], $fields['password'], $fields['mail'])) {
            if ((strlen($fields['firstName']) > 1 && strlen($fields['firstName']) < 50) &&
                (strlen($fields['lastName']) > 1 && strlen($fields['lastName']) < 50)){
                $firstName = $db->sanitize($fields['firstName']);
                $lastName = $db->sanitize($fields['lastName']);
                $mail = $db->sanitize($fields['mail']);
                $password = password_hash($db->sanitize($fields['password']), PASSWORD_BCRYPT);

                $userObject = new User($firstName, $lastName, $mail, $password);
                (new UserManager())->addUser($userObject);
            }
        }

        $this->render('add.user', "S'inscrire");
    }
}