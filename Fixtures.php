<?php


require_once "vendor/autoload.php";

use Fixtures\UserFixtures;

//php -f Fixtures.php -- user
if($argv[1] == "user"){
	$uf = new UserFixtures();
	$uf->load(5);
}