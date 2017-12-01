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

    protected function beforeRender()
    {
        $id = $_GET['id'];

        $this->_params['data'] = $this->_model->article($id);

        $this->_params['article']=[];

        while ($data = $this->_params['data']->fetch()) {
            array_push($this->_params['article'], $data);
            $this->_params['article']['nb_comment']= $this->_model->nb_comment($data['id']);
        }

        $this->_params['data']= null;

        if ($this->_params['article']['nb_comment'] > 0) {
            $this->_params['comments'] = [];

            $this->_params['data'] = $this->_model->comments($id);

            while ($data = $this->_params['data']->fetch()) {
                array_push($this->_params['comments'], $data);
            }
        }

        array_shift($this->_params);
    }
}
