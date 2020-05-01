<?php

namespace Frameworkphp3wa;


use App\Controller\SecurityController;
use FastRoute;

class Router{
    public function setRoutes($twig) 
    {
        $_GET["twig"] = $twig;
        $routes = include dirname(__DIR__).'/routes.php';
        return FastRoute\simpleDispatcher($routes);
    }

    public function getRouter($twig,$dispatcher){
        $uri = $_SERVER['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        
        $routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], rawurldecode($uri));
        if($routeInfo[0] == FastRoute\Dispatcher::NOT_FOUND || $routeInfo[0] == FastRoute\Dispatcher::METHOD_NOT_ALLOWED){
            header('HTTP/1.0 404 Not Found');
            $security = new SecurityController($twig);
            $response = $security->index();
            echo $twig->render($response[0], ["parameters"=>$response[1]]); 
        }elseif($routeInfo[0] == FastRoute\Dispatcher::FOUND) { 
            foreach ($routeInfo[2] as $key => $value) {
               array_push($routeInfo[1][2],$value);
            }
            call_user_func_array(array($routeInfo[1][0], $routeInfo[1][1]),$routeInfo[1][2]);
        }
    }
}


/*
$routeInfo[1][0] -> objet, la classe à instancier
$routeInfo[1][1] -> le nom de la méthode
$routeInfo[1][2] -> un tableau contenant les paramètres
*/