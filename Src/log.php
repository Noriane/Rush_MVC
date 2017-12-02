<?php

class Log
{
    private $_id;
    private $_bdd;

    public function __construct($id)
    {
        $this->_id = $id;
        $this->connect();
    }

    private function connect()
    {
        $this->_bdd = Db::getInstance();
    }

    public function is_group()
    {
        $req = "SELECT groupe from users WHERE id = '$this->_id'";
        $this->_bdd->setQuery($req);
        $donne = $this->_bdd->SQLquery();
        if ($donne[0]["groupe"] == "ADMIN") {
            return "ADMIN";
        } elseif ($donne[0]["group"] == "WRITER") {
            return "WRITER";
        } else {
            return "USER";
        }
    }


    public function this_name()
    {
        $req = "SELECT username from users WHERE id = '$this->_id'";
        $this->_bdd->setQuery($req);
        $donne = $this->_bdd->SQLquery();
        return $donne[0]["username"];
    }

    public function is_ban()
    {
        $req= "SELECT ban FROM users WHERE id = '$this->_id'";
        $this->_bdd->setQuery($req);
        $donne = $this->_bdd->SQLquery();
        if (empty($donne["ban"])) {
            return false;
        } else {
            return true;
        }
    }

    // public function __sleep()
    // {
    //     return array('_id');
    // }
    //
    // public function __wakeup()
    // {
    //     $this->connect();
    // }
}
