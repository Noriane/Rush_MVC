<?php
require_once('./AppController.php');

class WriterArticleController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new WriterArticleController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender(){

    }
}
