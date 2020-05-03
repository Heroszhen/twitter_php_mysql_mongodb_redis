<?php

namespace App\Repository;


use App\Entity\User;
use Frameworkphp3wa\AbstractRepository;

class UserRepository extends AbstractRepository{
	public function __construct() {
        parent::__construct("mysql");
    }

    public function addUser(User $user){
    	$query = "insert into user (email,password,name,status) values (:email,:password ,:name,:status)";
		$this->execRequete($query,[
			"email" => $user->getEmail(),
			"password" => password_hash($user->getPassword(), PASSWORD_BCRYPT),
			"name" => $user->getName(),
			"status" => $user->getStatus()
		]);
    }

    public function checkRegistration(User $user){
    	$response = 0;
    	$query = "select * from user where email = :email";
		$result = $this->execRequete($query,[
			"email" => $user->getEmail()
		]);
		$result = $result->fetch();
		if($result != false){
			if (password_verify($user->getPassword(), $result["password"])) {
				unset($result["password"]);
				$response = $result;
			}
		}
    	return $response;
    }

    public function getNameById($id){
    	$response = false;
    	$query = "select name from user where id = :id";
		$result = $this->execRequete($query,[
			"id" => $id
		]);
		$response = $result->fetch();
		
		return $response;
    }

    public function checkFollowed($followerid, $followedid){
    	$response = false;
    	$query = "select * from follow where follower = :follower and followed = :followed";
		$result = $this->execRequete($query,[
			"follower" => $followerid,
			"followed" => $followedid
		]);
		$response = $result->fetch();
		
		return $response;
    }

    public function follow($tab){
    	if($tab[1] == 1){
    		$query = "insert into follow (follower, followed) values (:follower, :followed)";
			$this->execRequete($query,[
				"follower" => $_SESSION['user']['id'],
				"followed" => $tab[0]
			]);
    	}elseif($tab[1] == 0){
    		$query = "delete from follow where follower = :follower and followed = :followed";
			$this->execRequete($query,[
				"follower" => $_SESSION['user']['id'],
				"followed" => $tab[0]
			]);
    	}
    }

}
