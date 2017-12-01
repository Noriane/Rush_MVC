<?php
if (!empty($_GET['url'])) {
    $router = new Router($_GET['url']);
} else {
    $router = new Router("");
}


$router->get('/', function () {
    require PATH."/Models/Accueil.php";
    require PATH."/Controllers/AccueilController.php";
    require PATH."/Views/View.php";

    AccueilController::getInstance("AccueilModel", "index.twig")->run();
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
