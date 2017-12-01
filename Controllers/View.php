<?php
class View
{
	public function __construct($file, $params)
	{

		$template = $twig->loadTemplate($file);
    	echo $template->render($this->$_params);
	}
	/*
	public function renderView()
	{
		//global $twig;
		//Twig
		//$template = $twig->loadTemplate('index.twig');
	}*/
}