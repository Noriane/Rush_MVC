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

    private function fieldForm()
    {
        if (empty($_POST['email']) || empty($_POST['password']))
        {
            $_SESSION['message'] =  "<p class='error'>Incorrect email or password</p>";
            return FALSE;
        }
        return $this->check_data();
    }

    private function check_data()
    {
        //Check if email set correspond to email bdd FOR LOGIN
        $email = $_POST['email'];
        $sql = "SELECT email FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();

        if ($email == $res['email']) 
        {
            return $this->pwd_checked();
        }
        else
        {
            $_SESSION['message'] = "<p class='error'>Incorrect email/password</p>";
            return FALSE;
        }
    }

    private function check_pwd()
    {
        
    }
}
