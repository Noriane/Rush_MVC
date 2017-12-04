<?php

class ArticleController extends AppController
{
    protected function loadModel($model)
    {
        $this->_model = new $model();
        require_once PATH."/Models/Comment.php";
        $this->_modelComment = new CommentModel();
    }
    protected function beforeRender()
    {
        global $id;

        $this->_params['data'] = $this->_model->article($id);

        if (!empty($_POST['add_comment'])) {
            $id_comment = ($this->add_comment());
        }

        //si reçois modif_comment avec les données nécessaires
        if (!empty($_POST['modif_comment'])) {
            $this->modif_comment();
        }

        $this->_params['article']=[];

        while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
            array_push($this->_params['article'], $data);
            $this->_params['article'][0]['nb_comment']= $this->_model->nb_comment($data['id']);

            $tag_temp  = $this->_model->tags($data['tag_id']);

            foreach ($tag_temp as $temp) {
                while ($data_tag = $temp->fetch(PDO::FETCH_ASSOC)) {
                    $this->_params['articles'][0]['tags'] = $data_tag;
                }
            }


            $this->_params['data']= null;

            if (!empty($this->_params['article']['nb_comment'])) {
                $this->_params['comments'] = [];

                $this->_params['data'] = $this->_modelComment->comments($id);

                while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                    array_push($this->_params['comments'], $data);
                }
            }

            unset($this->_params['data']);
        }
    }
}
