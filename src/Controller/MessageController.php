<?php

namespace App\Controller;

use Frameworkphp3wa\AbstractController;
use Frameworkphp3wa\FlashBag;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Service\EntityService;

class MessageController extends AbstractController{

    public function index($post=null,$id){
        $flash = new FlashBag();
        $flash->empty();
        $ur = new UserRepository();
        $mr = new MessageRepository();

        $user = $ur->getNameById($id);
        if($post != null){
            $message = new Message();
            $message->setUserid($id);
            $message->setContent($post["messagecontent"]);
            if($message->getContent() == "")$flash->set("Veuillez écrire quelque mots","danger");
            else{
                $mr->addMessage($message);
                $post["messagecontent"] = "";
            }
        }

        $followed = false;
        if($_SESSION["user"]["id"] != $id){
            $followed = $ur->checkFollowed($_SESSION["user"]["id"], $id);
        }
        
        $hismessages = $mr->getAllMessages($id);
        return $this->render("message.index.twig",[
            "flash" => $flash->get(),
            "id" => $id,
            "user" => $user,
            "post" => $post,
            "hismessages" => $hismessages,
            "followed" => $followed
        ]);
    }

    public function follow($query){
        $tab = explode('_', $query);
        $ur = new UserRepository();
        $ur->follow($tab);
        $this->Toredirect("profil/".$tab[0]);
    }
}
