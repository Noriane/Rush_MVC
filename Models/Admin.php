<?php

class AdminModel extends AModel
{
    public function users()
    {
        $sql= "SELECT * FROM users;";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }

    public function add_user($user)
    {
        $name = $user['name'];
        $pass = $user['password'];
        $email = $user['email'];
        $group = $user['group'];
        $sql = "INSERT INTO users VALUES (null,'$name','$pass','$email','$group','0',NOW(),NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function modif_user($user)
    {
        $name = $user['name'];
        $ban = $user['ban'];
        $email = $user['email'];
        $group = $user['group'];
        $sql = "UPDATE users username = '$name',email = '$email', group = '$group',ban = $ban, edit_date = NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function delete_user($id)
    {
        $sql = " DELETE users WHERE id = '$id'";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function check_email($email)
    {
        $sql = "SELECT email FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
        return $res;
    }
}
