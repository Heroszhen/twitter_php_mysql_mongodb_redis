<?php


use App\Controller\SecurityController;
use FastRoute\RouteCollector;


return function(RouteCollector $r) {
    $r->addRoute('GET', '/',array(new App\Controller\HomeController($_GET["twig"]), "index",[]));
    $r->addRoute('GET', '/logup',array(new App\Controller\HomeController($_GET["twig"]), "logup",[]));
    $r->addRoute('POST', '/logup',array(new App\Controller\HomeController($_GET["twig"]), "logup",[$_POST]));
    $r->addRoute('GET', '/login',array(new App\Controller\HomeController($_GET["twig"]), "login",[]));
    $r->addRoute('POST', '/login',array(new App\Controller\HomeController($_GET["twig"]), "login",[$_POST]));
    $r->addRoute('GET', '/logout',array(new App\Controller\HomeController($_GET["twig"]), "logout",[]));
};