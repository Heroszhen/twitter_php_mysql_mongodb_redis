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
    $r->addRoute('GET', '/infos/{id}',array(new App\Controller\HomeController($_GET["twig"]), "oneInfos",[]));
    $r->addRoute('GET', '/profil/{id}',array(new App\Controller\MessageController($_GET["twig"]), "index",[null]));
    $r->addRoute('POST', '/profil/{id}',array(new App\Controller\MessageController($_GET["twig"]), "index",[$_POST]));
    $r->addRoute('GET', '/profil/follow/{query}',array(new App\Controller\MessageController($_GET["twig"]), "follow",[]));


    $r->addRoute('GET', '/admin/infos',array(new App\Controller\admin\AdminInfosController($_GET["twig"]), "index",[]));
    $r->addRoute('POST', '/admin/infos',array(new App\Controller\admin\AdminInfosController($_GET["twig"]), "index",[$_POST]));
    $r->addRoute('GET', '/admin/infos/deleteinfos/{id}',array(new App\Controller\admin\AdminInfosController($_GET["twig"]), "deleteInfos",[]));
};