<?php

abstract class AModel
{
  protected $_connect;

  public function __construct()
  {
    $this->_connect = Db::getInstance();
  }
}
