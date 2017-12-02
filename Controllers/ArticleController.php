<?php

class ArticleController extends AppController
{
    protected function beforeRender()
    {
        global $id;

        $this->_params['data'] = $this->_model->article($id);

        $this->_params['article']=[];

        while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
            array_push($this->_params['article'], $data);
            $this->_params['article'][0]['nb_comment']= $this->_model->nb_comment($data['id']);
        }

        $this->_params['data']= null;

        if (!empty($this->_params['article']['nb_comment'])) {
            $this->_params['comments'] = [];

            $this->_params['data'] = $this->_model->comments($id);

            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['comments'], $data);
            }
        }

        array_shift($this->_params);
    }
}
