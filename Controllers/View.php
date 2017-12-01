<?php
class View
{
	public function __construct($file, $params)
	{
		$this->_file = $file;
		$this->_params = $params;

	}
	public function renderView()
	{
		//global $twig;
		//Twig
		//$template = $twig->loadTemplate($file);
		$template = $twig->loadTemplate('index.twig');
    	echo $template->render($this->$_params);
	}
}