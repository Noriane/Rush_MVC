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
            array_shift($this->_params);
        } else {
            $this->redirect();
        }
    }

    protected function add_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value)
        {
            $input[$key] = $this->secure_input($value);
        }

        $this->_model->add_user($input);
        return true;
    }

    private function modif_user()
    {
        $email = $_POST['modif_user']['email'];
        $res = $this->_model->check_email($_POST['modif_user']['email']);
        //var_dump($res);
        if (!empty($res)) {
            if ($res[0]['email'] == $email) {
                $_SESSION['message'] = "This email is already taken";
                return false;
            }
            $test_group = ['ADMIN','WRITER','USER'];

            if (in_array($_POST['modif_user']['groupe'], $test_group)) {
                foreach ($_POST['modif_user'] as $key => $value) {
                    $this->_datasUser[$key] = $this->secure_input($value);
                }
                $this->_model->modif_user($this->_datasUser);
            }
        }
    }

    private function delete_user()
    {
        $id = $_POST['delete_user'];
        $check_admin = new log($id);
        if ($check_admin != "ADMIN") {
            $this->_model->delete_user($id);
        }
    }
}
