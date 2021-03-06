<?php


namespace Scrirock\Links\Manager;

use Scrirock\Links\Entity\Link;

class LinkManager{

    /**
     * Add a user into the database
     * @param Link $linkObject
     * @param $user
     */
    public function addLink(Link $linkObject, $user){
        $request = DB::getRepresentative()->prepare("
        INSERT INTO prefix_link (fk_user, href, title, target, name)
            VALUES (:fk_user, :link, :title, :target, :name)
        ");

        $link = $linkObject->getLink();
        $title = $linkObject->getTitle();
        $target = $linkObject->getTarget();

        $request->bindParam(":fk_user", $user);
        $request->bindParam(":link", $link);
        $request->bindParam(":title", $title);
        $request->bindParam(":target", $target);
        $request->bindParam(":name", $title);
        if ($request->execute()){
            header("Location: /");
        }
        else{
            $_SESSION["error?"] = "Une erreur est survenu, veuillez réessayer";
            header("Location: ?controller=addLink");
        }
    }

    /**
     * Return all link
     * @return array
     */
    public function getLink(): array{
        $request = DB::getRepresentative()->prepare("SELECT 
                                                                l.id as linkId, u.id as userId,
                                                                fk_user, href, title, target, name, timeClicked,
                                                                nom, prenom, mail, pass       
                                                            FROM prefix_link as l
                                                            INNER JOIN prefix_user as u
                                                                ON l.fk_user = u.id
                                                            ");
        $request->execute();
        return $request->fetchAll();
    }

    /**
     * modify a link
     * @param Link $linkObject
     * @param $id
     */
    public function modifyLink(Link $linkObject){
        $request = DB::getRepresentative()->prepare("
            UPDATE prefix_link
            SET href = :href, title = :title, target = :target, name = :title
            WHERE id = :id
        ");

        $link = $linkObject->getLink();
        $title = $linkObject->getTitle();
        $target = $linkObject->getTarget();
        $id = $linkObject->getId();

        $request->bindParam(":href", $link);
        $request->bindParam(":title", $title);
        $request->bindParam(":target", $target);
        $request->bindParam(":id", $id);
        if ($request->execute()){
            header("Location: /");
        }
        else{
            $_SESSION["error?"] = "Une erreur est survenu, veuillez réessayer";
            header("Location: ?controller=addLink");
        }
    }

    public function deleteLink($id){
        $request = DB::getRepresentative()->prepare("DELETE FROM prefix_link WHERE id = :id");
        $request->bindParam(":id", $id);
        $request->execute();
    }

    public function getOneLink($rawId) {
        $request = DB::getRepresentative()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $request->bindParam(":id", $rawId);
        $request->execute();
        return $request->fetch();
    }

    public function checkUserFk($user, $linkId): bool{
        $request = DB::getRepresentative()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $request->bindParam(":id", $linkId);
        $request->execute();
        $data = $request->fetch();
        return $data['fk_user'] === $user;
    }

    public function addOne($linkId){
        $requestClick = $this->getOneLink($linkId);
        $timeClicked = $requestClick['timeClicked'];
        $timeClickedAndOne = $timeClicked + 1;

        $request = DB::getRepresentative()->prepare("
            UPDATE prefix_link
            SET timeClicked = :clicked
            WHERE id = :id
        ");
        $request->bindParam(":id", $linkId);
        $request->bindParam(":clicked", $timeClickedAndOne);
        $request->execute();
    }

}