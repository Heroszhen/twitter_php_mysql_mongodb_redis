<?php
namespace Fixtures;

use App\Entity\Infos;
use App\Repository\InfosRepository;

class InfosFixtures{
	public function load($n){
		$ir = new InfosRepository();
		for($i = 0;$i < $n;$i++){
			$faker = \Faker\Factory::create();
			$infos = new Infos();
			$infos->setId("infos_".uniqid());
			$infos->setTitle($faker->sentence($nbWords = 10, $variableNbWords = true));
			$infos->setContent($faker->text($minNbChars = 1000)  );
			$infos->setCreated(($faker->dateTime($max = 'now', $timezone = null))->format('Y-m-d h:i:s'));
			$ir->addInfos($infos);
		}
	}
}