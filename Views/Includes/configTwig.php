<?php

    require_once PATH . '/vendor/autoload.php';

    /*$loader = new Twig_Loader_Filesystem('../Views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false, 
      'debug' => true
	));

	$twig->addExtension(new Twig_Extension_Debug());*/
	function get_twig()
	{
		$loader = new Twig_Loader_Filesystem('../Views'); // Dossier contenant les templates
	    $twig = new Twig_Environment($loader, array(
	      'cache' => false, 
	      'debug' => true
		));
 
		$twig->addExtension(new Twig_Extension_Debug());
		return $twig;
	}
