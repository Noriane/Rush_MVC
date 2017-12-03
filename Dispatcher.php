<?php

if (!empty($_GET['url'])) {
    $router = new Router($_GET['url']);
} else {
    $router = new Router("");
}


$router->get('/', function () {
    echo "Route / ";
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
    require_once PATH."/Models/Admin.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Controllers/AdminController.php";
    require_once PATH."/Views/View.php";

    AdminController::getInstance("AdminModel", "admin.twig")->run();
});

$router->post('/admin', function () {
    require_once PATH."/Models/Admin.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Controllers/AdminController.php";
    require_once PATH."/Views/View.php";

    AdminController::getInstance("AdminModel", "admin.twig")->run();
});

$router->get('/setting', function () {
    require_once PATH."/Models/Setting.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Controllers/SettingController.php";
    require_once PATH."/Views/View.php";

    SettingController::getInstance("SettingModel", "setting.twig")->run();
});

$router->post('/settig', function () {
    require_once PATH."/Models/Setting.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Controllers/SettingController.php";
    require_once PATH."/Views/View.php";

    SettingController::getInstance("SettingModel", "setting.twig")->run();
});

$router->get('/writer', function () {
    require_once PATH."/Models/Writer.php";
    require_once PATH."/Controllers/WriterMainController.php";
    require_once PATH."/Views/View.php";

    WriterMainController::getInstance("WriterModel", "writerMain.twig")->run();
});

$router->post('/writer', function () {
    require_once PATH."/Models/Writer.php";
    require_once PATH."/Controllers/WriterMainController.php";
    require_once PATH."/Views/View.php";

    WriterMainController::getInstance("WriterModel", "writerMain.twig")->run();
});

$router->get('/login', function () {
    echo "Route /login ";
    require_once PATH."/Models/Login.php";
    require_once PATH."/Controllers/LoginController.php";
    require_once PATH."/Views/View.php";

    LoginController::getInstance("LoginModel", "login.twig")->run();
});

$router->post('/login', function () {
    echo "Route /login post ";
    require_once PATH."/Models/Login.php";
    require_once PATH."/Controllers/LoginController.php";
    require_once PATH."/Views/View.php";

    LoginController::getInstance("LoginModel", "login.twig")->run();
});

$router->get('/register', function () {
    require_once PATH."/Models/Register.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Views/View.php";

    RegisterController::getInstance("RegisterModel", "register.twig")->run();
});

$router->post('/register', function () {
    require_once PATH."/Models/Register.php";
    require_once PATH."/Controllers/RegisterController.php";
    require_once PATH."/Views/View.php";

    RegisterController::getInstance("RegisterModel", "register.twig")->run();
});


$router->get('/logout', function () {
    echo "Page logout";
});

$router->run();
