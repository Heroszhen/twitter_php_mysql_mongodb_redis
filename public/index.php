<?php

require_once "../vendor/autoload.php";

use Frameworkphp3wa\Kernel;

session_start();
$kernel = new Kernel();
$kernel->run();
