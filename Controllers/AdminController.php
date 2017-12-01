<?php

class AdminController extends AppController
{
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new AdminController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender()
    {
        //verif si c'est un admin
        if ($this->_params['user']['group'] == "ADMIN") {

            //si reçois add_users avec toutes les données nécessaires
            if (!empty($_POST['add_user'])) {
                $this->add_user();
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
            $i=0;
            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['users'], $data);
            }
            array_shift($this->_params);
        }else {
          $this->redirect();
        }
    }

    private function add_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        if ($input['password'] == $input['password_confirm'])
          {
            $input['password'] = password_hash($input['password'],PASSWORD_DEFAULT);
            $this->_model->add_user($input);
          }else {
            $_SESSION['message'] = "<p class='error'> password not match </p>";
          }
    }

    private function modif_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value) {
            $input[$key] = $this->secure_input($value);
        }
        $this->_model->modif_user($input);
    }

    private function delete_user()
    {
        $id = $_POST['delete_user'];
        $this->_model->delete_user($id);
    }
}
