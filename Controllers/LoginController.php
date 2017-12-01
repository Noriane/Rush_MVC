<?php

class LoginController extends AppController
{
    private $_datasUser = [];

    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new LoginController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender()
    {
        $this->_params['session'] = $_SESSION;
        $this->fieldForm();
    }

    //Vérifie si les 2 champs sont remplis
    private function fieldForm()
    {
        if (empty($_POST['email']) || empty($_POST['password']))
        {
            $_SESSION['message'] =  "Incorrect email or password";
            return FALSE;
        }
        return $this->checkDatas();
    }

    //Vérifie si l'email existe déjà en bdd
    private function checkDatas()
    {
        $email = secure_input($_POST['email']);
        $password = secure_input($_POST['password']);
        
        $this->_datasUser = $this->_model->get_datas_user();

        if ($email == $this->_datasUser['email']) 
        {
            if ($this->_params['user']['ban'] == false)
            {
                return $this->match_pwd($password, $id);
            }
        }
        else
        {
            $_SESSION['message'] = "Incorrect email/password";
            return FALSE;
        }
    }

    //Verifie si le password match
    private function match_pwd($password, $id)
    {
        $password_field = $_POST['password'];
        $verif_pwd = password_verify($password_field, $password);

        if ($verif_pwd)
        {
            $_SESSION['log'] = $id;
            if ($_POST['remember_me'] == 'on')
            {
                create_cookie('log', $id);
            }
            return $this->redirect();
        }else
        {
            $_SESSION['message'] = "Passwords don't match";  
            return FALSE;
        }
    }
}
