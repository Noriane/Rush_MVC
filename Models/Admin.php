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
        $group = $user['groupe'];
        $ban = $user['ban'];
        $sql = "INSERT INTO users VALUES (null,'$name','$pass','$email','$group','$ban',NOW(),NOW())";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function modif_user($user)
    {
        $id = $user['id'];
        $name = $user['username'];
        $ban = $user['ban'];
        $email = $user['email'];
        $group = $user['groupe'];
        $sql = "UPDATE users SET username = '$name',email = '$email', groupe = '$group',ban = $ban, edit_date = NOW() WHERE id = '$id'";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function delete_user($id)
    {
        $sql = "DELETE FROM users WHERE id = '$id'";

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
