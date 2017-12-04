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
    $tmp = explode (',',$tags);
    $tag_list = array_map('trim',$tmp);

    $ret = [];
    foreach ($tag_list as $id) {
      $sql = "SELECT name FROM tags WHERE id ='$id'";
      $this->_connect->setQuery($sql);
      array_push($ret, $this->_connect->SQLquery(false));
    }
    return $ret;
  }
}
