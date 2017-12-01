<?php
require_once('./AppController.php');

class LoginController extends AppController
{
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
        $this->fieldForm();
    }

    //Vérifie si les 2 champs sont remplis
    private function fieldForm()
    {
        if (empty($_POST['email']) || empty($_POST['password']))
        {
            $_SESSION['message'] =  "<p class='error'>Incorrect email or password</p>";
            return FALSE;
        }
        return $this->check_datas();
    }


    //Vérifie si l'email existe déjà en bdd
    private function check_datas()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT email, password, id, ban FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();

        if ($email == $res['email']) 
        {
            if ($this->user_ban($res['ban']))
            {
                return $this->match_pwd($password, $id);
            }

            return $this->redirect();
        }
        else
        {
            $_SESSION['message'] = "<p class='error'>Incorrect email/password</p>";
            return FALSE;
        }
    }

    //Verifie le password match
    private function match_pwd($password, $id)
    {
        $password_field = $_POST['password'];
        $verif_pwd = password_verify($password_field, $password);

        if ($verif_pwd)
        {
            $_SESSION['log'] = $id;
            //if (!empty($_POST['remember_me']))
            if ($_POST['remember_me'] == 'on')
            {
                create_cookie('log', $id);
            }
            return true;
        }else
        {
            $_SESSION['message'] = "<p class='error'>Incorrect email/password</p>";  
            return FALSE;
        }
    }

}
