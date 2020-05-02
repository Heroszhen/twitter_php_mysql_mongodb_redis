<?php


require_once "vendor/autoload.php";

use Fixtures\UserFixtures;
use Fixtures\InfosFixtures;

//php -f Fixtures.php -- user
if($argv[1] == "user"){
	$uf = new UserFixtures();
	$uf->load(5);
}elseif($argv[1] == "infos"){
	$uf = new InfosFixtures();
	$uf->load(5);
}