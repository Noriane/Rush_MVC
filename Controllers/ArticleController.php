<?php
require_once('./AppController.php');

class ArticleController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new ArticleController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender(){

    }
}
