<?php

class AccueilController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new AccueilController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender()
    {
        $this->_params['articles'] = $this->_model->ten_articles();

        foreach ($this->_params['articles'] as $value) {
            $this->_params['articles']['nb_comment']= $this->_model->nb_comment($this->_params['articles']['id']);
        }
    }
}
