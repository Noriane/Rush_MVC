<?php

abstract class AModel
{
  protected $_connect;

  public function __construct()
  {
    $this->_connect = Db::getInstance();
  }

  public function tags($tags)
  {
    $tag_list = trim(explode (',',$tags));

    $ret = [];
    foreach ($tag_list as $id) {
      $sql = "SELECT name FROM tags WHERE id ='$id'";
      $this->_connect->setQuery($sql);
      array_push($ret, $this->_connect->SQLquery(false));  
    }
    return $ret;
  }
}
