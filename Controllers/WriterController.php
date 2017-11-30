<?php
require_once('./AppController.php');

class WriterController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new WriterController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender(){

    }
}
