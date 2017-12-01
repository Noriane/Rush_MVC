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
        $this->_params['data'] = $this->_model->ten_articles();

        while ($data = $this->_params['data']->fetch()) {
            $this->_params['articles'].push($data);
            $this->_params['articles']['nb_comment']= $this->_model->nb_comment($data['id']);
        }
    }
}
