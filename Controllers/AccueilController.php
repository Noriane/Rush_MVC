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
            $tag_temp  = $this->_model->tags($data['tag_id']);

            while ($data_tag = $tag_temp->fetch(PDO::FETCH_ASSOC)) {
                $this->_params['articles'][$i]['tags'] = $data_tag;
            }

            $i++;
        }
        unset($this->_params['data']);
    }
}
