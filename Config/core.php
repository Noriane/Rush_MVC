<?php

 class Framework
 {
     public static function run2()
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
         require $basePath."/Src/Router.php";
         require $basePath."/Src/Route.php";

         // Load configuration file
         include $basePath."/Config/config.php";


         // Start session
         session_start();
     }
 }
