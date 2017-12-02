<?php

class WriterMainController extends AppController
{
    protected function beforeRender()
    {
        //verif si c'est un admin
        if ((($this->_params['user']['group'] == "ADMIN") || ($this->_params['user']['group'] == "WRITER")) && ($this->_params['user']['ban'] == false)) {

              //si reçois add_users avec toutes les données nécessaires
            if (!empty($_POST['add_article'])) {
                $this->add_article();
            }

            //si reçois modif_users avec tous les champs user sauf password
            if (!empty($_POST['modif_article'])) {
                $this->modif_article();
            }

            //si reçois delete_users avec un id
            if (!empty($_POST['delete_article'])) {
                $this->delete_article();
            }

            //envois toutes les données de la bdd articles pour la view
            $this->_params['data'] = $this->_model->articles();

            $this->_params['articles']=[];
            $i=0;
            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['articles'], $data);
            }
            array_shift($this->_params);
        } else {
            $this->redirect();
        }
    }

    private function add_article()
    {
        $input=[];
        foreach ($_POST['add_article'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $input['author_id']= $_SESSION["log"];
        $this->_model->add_article($input);
    }

    private function modif_article()
    {
        $input=[];
        foreach ($_POST['add_article'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $this->_model->modif_article($input);
    }

    private function delete_article()
    {
        $id = $_POST['delete_article'];
        $this->_model->delete_article($id);
    }
}
