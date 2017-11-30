<?php
require_once('./AppController.php');

class SettingController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new SettingController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender(){

    }
}
