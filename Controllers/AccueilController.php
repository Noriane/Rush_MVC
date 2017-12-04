<?php

class AccueilController extends AppController
{

    protected function beforeRender()
    {
        $this->_params['data'] = $this->_model->ten_articles();

        $this->_params['articles']=[];
        $i=0;
        while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
            array_push($this->_params['articles'], $data);
            $this->_params['articles'][$i]['nb_comment']= $this->_model->nb_comment($data['id']);
            $this->_params['articles'][$i]['tags']= $this->_model->tags($data['tag_id']);

            $i++;
        }
        unset($this->_params['data']);
    }
}
