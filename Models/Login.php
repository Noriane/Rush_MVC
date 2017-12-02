<?php

class LoginModel extends AModel
{
    public function get_datas_user($email)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
        return $res;
    }
}
