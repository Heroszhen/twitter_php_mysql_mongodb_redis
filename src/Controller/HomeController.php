<?php

namespace App\Controller;

use Frameworkphp3wa\AbstractController;
use Frameworkphp3wa\FlashBag;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Infos;
use App\Repository\InfosRepository;
use App\Service\EntityService;

class HomeController extends AbstractController{

    public function index(){
        $ir = new InfosRepository();
        $allinfos = $ir->getAllInfos();
        
        return $this->render("home.index.twig",[
            "allinfos" => $allinfos
        ]);
    }

    public function logup($post=null){
    	$flash = new FlashBag();
        $flash->empty();
        if($post != null){
        	$user = new User();
        	$user->setName($_POST['name']);
        	$user->setEmail($_POST['email']);
        	$user->setPassword($_POST['password']);
        	$user->setStatus("USER");
        	if($user->getName() == "" || $user->getEmail() == "" || $user->getPassword() == "")$flash->set("Veuillez remplir tous les champs","danger");
        	else{
        		$return = EntityService::checkPassword($user->getPassword(),5);
        		if($return == 1){
	        		$ur = new UserRepository();
	        		$ur->addUser($user);
	        		$flash->set("Votre inscription a été faite avec succès","success");
        		}
        		else $flash->set("Le mot de passe doit contenir au moins 5 caractères:<br>Au moins 1 lettre<br>Au moins 1 chiffre<br>Au moins 1 caractère spécial : & , # , - , _ , @ , | , + , - , / , *","danger");
        	}
        }
    	return $this->render("home.logup.twig",[
            "flash"=>$flash->get(),
            "post"=>$post
        ]);
    }

    public function login($post=null){
        $flash = new FlashBag();
        $flash->empty();
        if($post != null){
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setStatus("USER");
            if($user->getEmail() == "" || $user->getPassword() == "")$flash->set("Veuillez remplir tous les champs","danger");
            else{
                $ur = new UserRepository();
                $response = $ur->checkRegistration($user);
                if($response == 0)$flash->set("L'identifiant ou le mot de passe n'existe pas","danger");
                else{
                    $_SESSION["user"] = $response;
                    $this->Toredirect("");
                } 
            }
        }
        return $this->render("home.login.twig",[
            "flash"=>$flash->get(),
            "post"=>$post
        ]);
    }

    public function logout($post=null){
        unset($_SESSION["user"]);
        $this->Toredirect("");
    }
}
