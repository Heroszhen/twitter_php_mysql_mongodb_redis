<?php

namespace App\Controller\admin;

use Frameworkphp3wa\AbstractController;
use Frameworkphp3wa\FlashBag;
use App\Entity\Infos;
use App\Repository\InfosRepository;

class AdminInfosController extends AbstractController{

	public function index($post=null){
        $flash = new FlashBag();
        $flash->empty();

        $ir = new InfosRepository();
        if($post != null){
        	$infos = new Infos();
        	$infosid = "infos_".uniqid();
        	$infos->setId($infosid);
        	$infos->setTitle($_POST['title']);
        	$infos->setContent($_POST['content']);
        	$d = new \DateTime();
        	$format = $d->format("d/m/Y h:i:s");
        	$infos->setCreated($format);
        	if($infos->getTitle() == "" || $infos->getContent() == "")$flash->set("Veuillez remplir tous les champs","danger");
        	else {
        		$ir->addInfos($infos);
        		$flash->set("Enregistré","success");
        		$post = null;
        	}
        }
        $allinfos = $ir->getAllInfos();
        return $this->render("admininfos.index.twig",[
            "flash" => $flash->get(),
            "post" => $post,
            "allinfos" => $allinfos
        ]);
    }

    public function deleteInfos($key){
		$ir = new InfosRepository();
		$ir->deleteInfos($key);
		$this->Toredirect("admin/infos");
	}
}