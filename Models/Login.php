<?php

class LoginModel extends AModel
{
    public function get_datas_user()
    {
        $sql = "SELECT email, password, id FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
    }
}
