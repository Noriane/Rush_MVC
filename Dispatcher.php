<?php
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
//$router->get('/login', 'login.php');

$router->get('/logout', function () {
    echo "Page logout";
});

$router->run();
