<?php
    $basePath = __DIR__;
 class Framework
 {
     public static function run()
     {
         echo "run()";
         self::init();
     }

     private static function init()
     {
         // Load core classes
         require $basePath."/Controllers/ArticlesController.php";
         require $basePath."/Controllers/UsersController.php";
         require $basePath."/Config/Db.php";
         require $basePath."/Models/Article.php";
         require $basePath."/Src/log.php";
         require $basePath."/Src/session.php";
         require $basePath."/Src/router.php";

         // Load configuration file
         include $basePath."/Config/config.php";


         // Start session
         session_start();
     }
 }
