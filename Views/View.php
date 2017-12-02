<?php

class View
{
    public function __construct($file, $params)
    {
        include_once PATH.'/Views/Includes/configTwig.php';
        $twig = get_twig();
       	/*
        echo "<pre>";
        var_dump($params);
        echo "<pre>";
        echo "</pre>";
        var_dump($file);
        echo "</pre>";
   		*/

        $template = $twig->loadTemplate($file);
        echo $template->render($params); 
    }
}
