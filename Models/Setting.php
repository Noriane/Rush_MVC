<?php

class SettingModel extends AModel
{
    public function user()
    {
        $id = $_SESSION['log'];
        $sql= "SELECT * FROM users WHERE id = '$id';";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }

    public function check_email($email)
    {
        $sql = "SELECT email FROM users WHERE email='$email'";
        $this->_connect->setQuery($sql);
        $res = $this->_connect->SQLquery();
        return $res;
    }

    public function modif_user_sp($user)
    {
        $id = $_SESSION['log'];
        $name = $user['name'];
        $email = $user['email'];

        $sql = "UPDATE users username = '$name',email = '$email', edit_date = NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }

    public function modif_user($user, $pass)
    {
        $id = $_SESSION['log'];
        $name = $user['name'];
        $email = $user['email'];

        $sql = "UPDATE users username = '$name',email = '$email', password = '$pass', edit_date = NOW()";

        $this->_connect->setQuery($sql);
        $this->_connect->SQLquery(false);
    }
}
