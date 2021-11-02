<?php


namespace Scrirock\Links\Manager;

use Scrirock\Links\Entity\User;

class UserManager
{

    /**
     * Add a user into the database
     * @param User $user
     */
    public function addUser(User $user)
    {
        if ($this->checkUserMail($user->getMail())) {
            $request = DB::getRepresentative()->prepare("
            INSERT INTO prefix_user (nom, prenom, mail, pass)
                VALUES (:firstName, :lastName, :mail, :pass)
            ");

            $firstname = $user->getFirstName();
            $lastName = $user->getLastName();
            $mail = $user->getMail();
            $password = $user->getPassword();

            $request->bindParam(":firstName", $firstname);
            $request->bindParam(":lastName", $lastName);
            $request->bindParam(":mail", $mail);
            $request->bindParam(":pass", $password);
            if ($request->execute()) {
                header("Location: /");
            } else {
                $_SESSION["error?"] = "Une erreur est survenu, veuillez réessayer";
                header("Location: ?controller=addUser");
            }
        } else {
            $_SESSION["error?"] = "Ce mail est deja prit";
            header("Location: ?controller=addUser");
        }
    }

    /**
     * Avoid an user to have the same mail of another one
     * @param $mail
     * @param null $id
     * @return bool
     */
    public function checkUserMail($mail, $id = null): bool
    {
        $request = DB::getRepresentative()->prepare("SELECT id, mail FROM prefix_user");
        $request->execute();
        $check = true;

        $userData = $request->fetchAll();
        foreach ($userData as $username) {
            if ($username['mail'] === $mail && $username['id'] != $id) {
                $check = false;
            }
        }
        return $check;
    }

    /**
     * Return true if the user exist and the password is correct
     * @param $mail
     * @param $password
     * @return bool
     */
    public function checkUser($mail, $password): bool
    {
        $request = DB::getRepresentative()->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
        $request->bindValue(':mail', $mail);

        if ($request->execute()) {
            $userData = $request->fetch();
            if (password_verify($password, $userData["pass"])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUserByMail($mail){
        $request = DB::getRepresentative()->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
        $request->bindValue(':mail', $mail);
        if ($request->execute()) return $request->fetch();
    }
}