<?php

class RegisterController extends AppController
{
    protected $_datasUser = [];

    protected function beforeRender()
    {
        if (!empty($_POST))
        {
            $this->checkDatas();
            $this->_params['session'] = $_SESSION;
        }
        else
        {
            $_SESSION['message'] = "";
        }
    }

    //Fais toutes les vérif sur la présence et la validité des champs du formulaire
    protected function checkDatas()
    {
        $name = $this->secure_input($_POST['add_user']['name']);
        $email = $this->secure_input($_POST['add_user']['email']);
        $password = $this->secure_input($_POST['add_user']['password']);
        $password_confirm = $this->secure_input($_POST['add_user']['password_confirm']);

        $email_error = "Invalid email";
        $pwd_error = "Invalid password or password confirmation";
        $name_error = "Username is required";

        if (empty($name))
        {
            $_SESSION['message'] = $name_error;
            return false;
        }
        if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            $_SESSION['message'] = $email_error;
            return false;
        }
        if (empty($password) || empty($password_confirm))
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
    protected function uniqueEmail()
    {
        $email = $_POST['add_user']['email'];
        $res = $this->_model->check_email($_POST['add_user']['email']);
        if (!empty($res))
        {
            if ($res[0]['email'] == $email)
            {
                $_SESSION['message'] = "This email is already taken";
                return false;
            }
        }
        return $this->hashPassword();
    }

    protected function hashPassword()
    {
        $password = $this->secure_input($_POST['add_user']['password']);
        $pwd_hashed = password_hash($password, \PASSWORD_DEFAULT);
        $verif_pwd = password_verify($password, $pwd_hashed);
        if ($verif_pwd)
        {
            $_POST['add_user']['password'] = $pwd_hashed;
            return $this->add_user();
        }
        return false;
    }

    protected function add_user()
    {
        $input=[];
        foreach ($_POST['add_user'] as $key => $value)
        {
            $input[$key] = $this->secure_input($value);
        }

        $this->_model->add_user($input);
        $this->fullredirect("/login");
        return true;
    }
}
