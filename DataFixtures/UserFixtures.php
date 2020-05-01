<?php
namespace Fixtures;

use App\Entity\User;
use App\Repository\UserRepository;

class UserFixtures{
	public function load($n){
		for($i = 0;$i < $n;$i++){
			$faker = \Faker\Factory::create();
			$user = new User();
			$user->setName($faker->firstName);
			$user->setEmail($faker->email);
			$user->setPassword("aaaaa");
			$user->setStatus("USER");
			$ur = new UserRepository();
			$ur->addUser($user);
		}
	}
}