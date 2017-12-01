<?php
define('PATH', __DIR__."/../");

    //$basePath = __DIR__."/../";

    require PATH.'Config/core.php';
  // require $basePath.'Views/Includes/configTwig.php';


    Framework::run();

    //$template = $twig->loadTemplate('index.twig');
  /*  $template = $twig->loadTemplate('article.twig');
    	echo $template->render(array(
		'moteur_name' => 'Twig'
    ));
*/
