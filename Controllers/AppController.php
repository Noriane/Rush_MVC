<?php

abstract class AppController
{
	protected $_model;
	protected $_file;
	protected $_params = [];

	private function __construct()
	{
		# code...
	}

	public function loadModel($model)
	{
		$this->_model = new $model();
	}

	public function beforeRender();

	public function render($file=null)
	{
		$this->_file = new View($file);
	}

	protected function redirect($url)
	{
		
	}
}
?>
