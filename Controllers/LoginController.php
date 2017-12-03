<?php

class LoginController extends AppController
{
    private $_datasUser = [];

    //retourn l'instance en cours ou en crée une


    protected function beforeRender()
    {
        if (!empty($_POST))
        {
            $this->fieldForm();
            $this->_params['session'] = $_SESSION;
        }
        else
        {
            $_SESSION['message'] = "";
        }
        $this->_params['session'] = $_SESSION;
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
        $email = $this->secure_input($_POST['email']);
        $password = $this->secure_input($_POST['password']);
        
        $this->_datasUser = $this->_model->get_datas_user($email);
        $id = $this->_datasUser[0]['id'];

        if ($email == $this->_datasUser[0]['email']) 
        {
            if ($this->_datasUser[0]['ban'] == false)
            {   
                return $this->match_pwd($password, $id);
            }
            $_SESSION['message'] = "User is ban";
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
        $password_field = $this->secure_input($_POST['password']);
        $verif_pwd = password_verify($password_field, $this->_datasUser[0]['password']);
        if ($verif_pwd)
        {
            $_SESSION['log'] = $id;
            $_SESSION['groupe'] = $this->_datasUser[0]['groupe'];
            if (!empty($_POST['remember_me']) && $_POST['remember_me'] == 'on')
            {
                setcookie('log', $id, time()+3600);
            }
            return $this->fullredirect();
        }else
        {
            $_SESSION['message'] = "Invalid Password";  
            return FALSE;
        }
    }
}
