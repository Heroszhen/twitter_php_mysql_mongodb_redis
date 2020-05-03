<?php
namespace Fixtures;

use App\Entity\Message;
use App\Repository\MessageRepository;

class MessageFixtures{
	
	public function load($n){
		$mr = new MessageRepository();
		for($i = 0;$i < $n;$i++){
			$faker = \Faker\Factory::create();
			$m = new Message();
			$m->setUserid($faker->numberBetween($min = 1, $max = 5));
			$m->setContent($faker->text);
			$mr->addMessage($m);
		}
	}
}