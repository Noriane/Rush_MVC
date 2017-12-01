<?php

 class Framework
 {
     public static function run()
     {
         self::init();
     }

     private static function init()
     {
         // Start session
         session_start();

         // Load configuration file
         include PATH."/Config/config.php";

         // Load core classes
         require PATH."/Config/Db.php";
         require PATH."/Src/Route.php";
         require PATH."/Src/Router.php";
         require PATH."/Src/session.php";
         require PATH."/Src/log.php";
         require PATH."/Controllers/AppController.php";
         require PATH."/Models/AModel.php";
         require PATH."/Dispatcher.php";
     }
 }
