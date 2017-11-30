<?php
    $basePath = __DIR__."/../";

    require $basePath.'Config/core.php';

    Framework::run();

    $router = new Router($_GET['url']);

    $router->get('/', function () {
        echo "tous les articles";
    });

    $router->get('/articles/:id', function ($id) {
        echo "affiche l'article ".$id;
    });

    $router->get('/admin', function () {
        echo "Page admin";
    });

    $router->get('/writer', function () {
        echo "Page writer";
    });

    $router->get('/login', function () {
        echo "Page login";
    });

    $router->get('/logout', function () {
        echo "Page logout";
    });

    $router->run();
