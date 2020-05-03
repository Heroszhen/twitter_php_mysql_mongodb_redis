<?php

namespace App\Repository;

use App\Entity\Message;
use Frameworkphp3wa\AbstractRepository;

class MessageRepository extends AbstractRepository{
	public function __construct() {
        parent::__construct("mongodb");
    }

    public function addMessage(Message $m){
    	$now = new \DateTime();
    	$now = $now->getTimestamp();
    	$now = $now * 1000;
    	$created = new \MongoDB\BSON\UTCDateTime($now);
    	$collection = $this->db->message;
    	$collection->insertOne( [ 
			"userid" => $m->getUserid() , 
			"content" => $m->getContent(),
			"created" => $created,
			"comments" => $m->getComments()
		]);
    }

    public function getAllMessages($userid=null){
    	$collection = $this->db->message;
    	if($userid == null)$result = $collection->find([],['sort' => ['created' => 1]]);
    	else $result =  $collection->find([ 'userid' => intval($userid)],['sort' => ['created' => -1]]);
    	$response = [];
    	foreach ($result as $k=>$value) {
    		$courant = [];
    		$courant["id"] = $value["_id"];
    		$courant["userid"] = $value["userid"];
    		$courant["content"] = $value["content"];
    		$courant["created"] = $value["created"]->toDateTime();
    		$courant["comments"] = $value["comments"];
    		array_push($response,$courant);
    	}

    	return $response;
    }
}
