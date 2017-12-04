<?php

class SettingController extends RegisterController
{
    protected function beforeRender()
    {
        if (!empty($this->_params['user'])) {
            if (!empty($_POST['modif_user'])) {
            
                $this->modif_user();
            }

            $this->_params['data'] = $this->_model->user();

            $this->_params['all_data_user']=[];

            while ($data = $this->_params['data']->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->_params['all_data_user'], $data);
            }

            unset($this->_params['data']);
        } else {
            $this->redirect();
        }
    }

    private function modif_user()
    {
        $email = $_POST['modif_user']['email'];

        foreach ($_POST['modif_user'] as $key => $value) {
            $this->_datasUser[$key] = $this->secure_input($value);
        }

        if (empty($_POST['modif_user']['password'])) {
            $this->_model->modif_user_sp($this->_datasUser);
        } else {
            $this->hashPassword();
        }
    }

    protected function hashPassword()
    {
        $password = $this->_datasUser['password'];
        $pwd_hashed = password_hash($password, \PASSWORD_DEFAULT);
        $verif_pwd = password_verify($password, $pwd_hashed);
        if ($verif_pwd) {
            $this->_model->modif_user($this->_datasUser, $pwd_hashed);
        }
        return false;
    }
}
