<?php


require_once "vendor/autoload.php";

use Fixtures\UserFixtures;
use Fixtures\InfosFixtures;
use Fixtures\MessageFixtures;

//php -f Fixtures.php -- user
if($argv[1] == "user"){
	$uf = new UserFixtures();
	$uf->load(5);
}elseif($argv[1] == "infos"){
	$if = new InfosFixtures();
	$if->load(5);
}elseif($argv[1] == "message"){
	$mf = new MessageFixtures();
	$mf->load(5);
}