<?php

namespace Frameworkphp3wa;


use Frameworkphp3wa\Router;
use Frameworkphp3wa\Database\ConnectSql;
use Twig;

class Kernel{
    public function run(){
        $loader = new Twig\Loader\FilesystemLoader(Dirname(Dirname(__DIR__)).'/templates'); 
        $twig = new Twig\Environment($loader, [
            'cache' => false,
        ]);
        $twig->addGlobal('session', $_SESSION);
        
        $router = new Router();
        $dispatcher = $router->setRoutes($twig);
        $router->getRouter($twig,$dispatcher);
    }

    public function getDB($db){
        return ConnectSql::getDB($db);
    }
}