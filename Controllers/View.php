<?php
class View
{
	protected $_file;
	protected $_params = [];
	public function __construct($file, $params)
	{
		$this->_file = $file;
		$this->_params = $params;

	}
	public function renderView()
	{
		//global $twig;
		//Twig
		//$template = $twig->loadTemplate('index.twig');
		$template = $twig->loadTemplate($file);
    	echo $template->render($this->$_params);
	}
}