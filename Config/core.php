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
         include_once PATH."/Config/config.php";

         // Load core classes
         require_once PATH."/Config/Db.php";
         require_once PATH."/Src/Route.php";
         require_once PATH."/Src/Router.php";
         require_once PATH."/Src/session.php";
         require_once PATH."/Src/log.php";
         require_once PATH."/Controllers/AppController.php";
         require_once PATH."/Models/AModel.php";
         require_once PATH."/Dispatcher.php";
     }
 }
