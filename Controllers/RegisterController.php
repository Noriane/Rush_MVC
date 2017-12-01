<?php

class RegisterController extends AppController
{
    private $_datasUser = [];
    //retourn l'instance en cours ou en crée une
    public static function getInstance($model, $file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new RegisterController($model, $file);
        }
        return self::$_instance;
    }

    protected function beforeRender()
    {
        $this->_params['session'] = $_SESSION;
        $this->checkDatas();
    }

    //Fais toutes les vérif sur la présence et la validité des champs du formulaire
    private function checkDatas()
    {
        $username = $this->secure_input($_POST['username']);
        $email = $this->secure_input($_POST['email']);
        $password = $this->secure_input($_POST['password']);
        $password_confirm = $this->secure_input($_POST['password_confirm']);

        $email_error = "Invalid email";
        $pwd_error = "Invalid password or password confirmation";
        $username_error = "Username is required";

        if (empty($username))
        {
            $_SESSION['message'] = $username_error; 
            return false;
        }
        if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            $_SESSION['message'] = $email_error;
            return false;
        }
        if (empty($password))
        {
            $_SESSION['message'] = $pwd_error;
            return false;
        }
        if (empty($password_confirm))
        {
            $_SESSION['message'] = $pwd_error;
            return false;
        }
        if ($password != $password_confirm)
        {
            $_SESSION['message'] = $pwd_error;
            return false;
        }
        return $this->uniqueEmail();
    }

    //Vérifie si l'email n'est pas déjà enregistré en bdd
    private function uniqueEmail()
    {
        $res = $this->_model->check_email($_POST['email']);
        if (!empty($res))
        {
            if ($res['email'] == $email)
            {
                $_SESSION['message'] = "This email is already taken.</p>";
                return false;
            }
        }
        return $this->hashPassword();
    }

    private function hashPassword()
    {
        $password = $_POST['password'];
        $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
        $verif_pwd = password_verify($password, $pwd_hashed);
        if ($verif_pwd)
        {
            return $this->add_user();
        }
        return false;
    }

    private function add_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value) 
        {
            $input[$key] = $this->secure_input($value);
        }
        if ($this->hashPassword())
        {
            $this->_model->add_user($input);
            $this->redirect(); 
            return true;
        }
        return false;
    }
}
