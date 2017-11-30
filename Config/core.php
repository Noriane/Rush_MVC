<?php

 class Framework
 {
     public static function run()
     {
         self::init();
     }

     private static function init()
     {
       global $basePath;

       // Load configuration file
       include $basePath."/Config/config.php";


         // Load core classes
         require $basePath."/Config/Db.php";
         require $basePath."/Src/Route.php";
         require $basePath."/Src/Router.php";
         require $basePath."/Src/session.php";
         require $basePath."/Src/log.php";
         require $basePath."/Dispatcher.php";

         // Start session
         session_start();
     }
 }
