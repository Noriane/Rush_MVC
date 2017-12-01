<?php

class AccueilModel extends AModel
{
    public function users()
    {
        $sql= "SELECT * FROM users;";

        $this->_connect->setQuery($sql);
        return $this->_connect->SQLquery(false);
    }


}
