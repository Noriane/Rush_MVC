<?php

class View
{
    public function __construct($file, $params)
    {
        include_once PATH.'/Views/Includes/configTwig.php';
        $twig = get_twig();
        $params['session'] = $_SESSION; 
        
        /*
        echo "<pre>";
        var_dump($params);
        echo "<pre>";
        */
        

        $template = $twig->loadTemplate($file);
        echo $template->render($params); 
    }
}
