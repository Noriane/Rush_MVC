<?php

    $basePath = __DIR__."/../";

    //require $basePath.'Config/core.php';
    require $basePath.'Views/Includes/configTwig.php';

    //Framework::run();

    $template = $twig->loadTemplate('index.twig');
    	echo $template->render(array(
		'moteur_name' => 'Twig'
    ));
