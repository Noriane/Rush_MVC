<?php

if (!empty($_GET['url'])) {
    $router = new Router($_GET['url']);
} else {
    $router = new Router("");
}


$router->get('/', function () {
    require_once PATH."/Models/Accueil.php";
    require_once PATH."/Controllers/AccueilController.php";
    require_once PATH."/Views/View.php";

    AccueilController::getInstance("AccueilModel", "index.twig")->run();
});

$router->get('/articles/:id', function ($id) {
    require_once PATH."/Models/Article.php";
    require_once PATH."/Controllers/ArticleController.php";
    require_once PATH."/Views/View.php";

    ArticleController::getInstance("ArticleModel", "article.twig")->run();
});

$router->get('/admin', function () {
    echo "Page admin";
});

$router->get('/writer', function () {
    echo "Page writer";
});

$router->get('/login', function () {
    require_once PATH."/Models/Login.php";
    require_once PATH."/Controllers/LoginController.php";
    require_once PATH."/Views/View.php";

    LoginController::getInstance("LoginModel", "login.twig")->run();
});

$router->get('/register', function () {
    require_once PATH."/Models/Register.php";
    require_once PATH."/Controllers/registerController.php";
    require_once PATH."/Views/View.php";

    RegisterController::getInstance("registerModel", "register.twig")->run();
});

$router->post('/register', function () {
    require_once PATH."/Models/Register.php";
    require_once PATH."/Controllers/registerController.php";
    require_once PATH."/Views/View.php";

    RegisterController::getInstance("registerModel", "register.twig")->run();
});


$router->get('/logout', function () {
    echo "Page logout";
});

$router->run();
