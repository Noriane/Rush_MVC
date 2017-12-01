<?php
require_once('./AppController.php');

class RegisterController extends AppController
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
        $this->fieldForm();
    }

    //Vérifie si username, email, password et password_confirm sont remplis
    private function fieldForm()
    {
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_verify']))
        {
            $_SESSION['message'] =  "<p class='error'>Incorrect email or password</p>";
            return FALSE;
        }
        return $this->check_datas();
    }

    //Vérifie si l'email existe déjà en bdd
    private function check_datas()
    {
        /*
        $email = secure_input($_POST['email']);
        $password = secure_input($_POST['password']);
        
        $this->_datasUser = $this->get_datas_user();

        if ($email == $this->_datasUser['email']) 
        {
            if ($this->_params['user']['ban'] == false)
            {
                return $this->match_pwd($password, $id);
            }
        }
        else
        {
            $_SESSION['message'] = "<p class='error'>Incorrect email/password</p>";
            return FALSE;
        }*/
    }

    
}
