<?php

namespace App\Repository;


use App\Entity\Infos;
use Frameworkphp3wa\AbstractRepository;


class InfosRepository extends AbstractRepository{
	public function __construct() {
        parent::__construct("redis");
    }

    public function addInfos(Infos $infos){
    	$key = $infos->getId();
    	$this->db->hset($key, 'title', $infos->getTitle());
        $this->db->hset($key, 'content', $infos->getContent());
        $this->db->hset($key, 'created', $infos->getCreated());
    }

    public function getAllInfos(){
    	$response = [];
    	$allkeys = $this->db->keys('infos_*');
    	foreach($allkeys as $k=>$v){
			$courant = [];
			$courant = $this->db->hgetall($v);
			$courant["created"] = new \DateTime($courant["created"]);
			$courant["infosid"] = $v;
			array_push($response,$courant);
		}

		return $response;
    }

    public function deleteInfos($key){
		$this->db->del($key, 'title');
        $this->db->del($key, 'content');
        $this->db->del($key, 'created');
	}

}
