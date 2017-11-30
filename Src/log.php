<?php
include_once($basePath."/Config/Db.php");

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
        $req = "SELECT admin from users WHERE id = '$this->_id'";
        $this->_bdd->setQuery($req);
        $donne = $this->_bdd->SQLquery();
        if ($donne["group"] == "admin") {
            return "admin";
        } else {
            if ($donne["group"] == "writer") {
                return "writer";
            }
            return "user";
        }
    }

    public function this_name()
    {
        $req = "SELECT username from users WHERE id = '$this->_id'";
        $this->_bdd->setQuery($req);
        $donne = $this->_bdd->SQLquery();
        return $donne["username"];
    }

    public function __sleep()
    {
        return array('_id');
    }

    public function __wakeup()
    {
        $this->connect();
    }
}
