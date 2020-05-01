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

}
