<?php

class WriterMainController extends AppController
{
    protected function beforeRender()
    {
        //verif si c'est un admin
        if ((($this->_params['user']['group'] == "ADMIN") || ($this->_params['user']['group'] == "WRITER")) && ($this->_params['user']['ban'] == false)) {


            //si reçois delete_article avec un id
            if (!empty($_POST['delete_article'])) {
                $this->delete_article();
            }

            //envois toutes les données de la bdd articles pour la view
            $this->_params['data'] = $this->_model->articles();

            $this->_params['articles']=[];
            $i=0;
            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['articles'], $data);
                $this->_params['articles'][$i]['nb_comment']= $this->_model->nb_comment($data['id']);
                $i++;
            }
            unset($this->_params['data']);
        } else {
            $this->redirect();
        }
    }

    private function delete_article()
    {
        $id = $_POST['delete_article'];
        $this->_model->delete_article($id);
    }
}
