<?php

class RegisterModel extends AModel
{
    public function check_email($email)
    {
    	$sql = "SELECT email FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
        return $res;
    }

    public function add_user($user)
    {
        $name = $user['name'];
        $pass = $user['password'];
        $email = $user['email'];
        $group = "USER";
        $sql = "INSERT INTO users VALUES (null,'$name','$pass','$email','$group','0',NOW(),NOW())";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }
}
