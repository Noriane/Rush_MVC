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
    require PATH."/Models/Article.php";
    require PATH."/Controllers/ArticleController.php";
    require PATH."/Views/View.php";

    ArticleController::getInstance("ArticleModel", "article.twig")->run();
});

$router->get('/admin', function () {
    echo "Page admin";
});

$router->get('/writer', function () {
    echo "Page writer";
});

$router->get('/login', function () {
    require PATH."/Models/Login.php";
    require PATH."/Controllers/LoginController.php";
    require PATH."/Views/View.php";

    LoginController::getInstance("LoginModel", "login.twig")->run();
});


$router->get('/logout', function () {
    echo "Page logout";
});

$router->run();
