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

        $this->_params['articles']=[];
        $i=0;
        while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
            array_push($this->_params['articles'], $data);
            $this->_params['articles'][$i]['nb_comment']= $this->_model->nb_comment($data['id']);
            $i++;
        }
        array_shift($this->_params);
    }
}
