<?php

class View
{
    public function __construct($file, $params)
    {
        include_once PATH.'/Views/Includes/configTwig.php';

        $template = $twig->loadTemplate($file);
        echo $template->render($params); 
    }
}
