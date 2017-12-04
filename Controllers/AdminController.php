<?php

class AdminController extends RegisterController
{
    protected function beforeRender()
    {
        //verif si c'est un admin
        if ($this->_params['user']['group'] == "ADMIN") {

            //si reçois add_users avec toutes les données nécessaires
            if (!empty($_POST['add_user'])) {
                $this->checkDatas();
            }

            //si reçois modif_users avec tous les champs user sauf password
            if (!empty($_POST['modif_user'])) {
                $this->modif_user();
            }

            //si reçois delete_users avec un id
            if (!empty($_POST['delete_user'])) {
                $this->delete_user();
            }

            //envois toutes les données de la bdd users pour la view
            $this->_params['data'] = $this->_model->users();

            $this->_params['users']=[];

            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['users'], $data);
            }
            unset($this->_params['users'][0]['password']);
            unset($this->_params['data']);
        } else {
            $this->redirect();
        }
    }

    protected function add_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }

        $this->_model->add_user($input);
        return true;
    }

    private function modif_user()
    {
        $email = $_POST['modif_user']['email'];

        $test_group = ['ADMIN','WRITER','USER'];

        if (in_array($_POST['modif_user']['groupe'], $test_group)) {
            foreach ($_POST['modif_user'] as $key => $value) {
                $this->_datasUser[$key] = $this->secure_input($value);
            }
            $this->_model->modif_user($this->_datasUser);
        }
    }

    private function delete_user()
    {
        $check_admin = new log($this->_id);
        if ($check_admin != "ADMIN") {
            $this->_model->delete_user($this->_id);
        }
    }
}
