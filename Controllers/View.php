<?php
class View
{

    public function __construct($file, $params)
    {
        global $twig;
				var_dump($file);
        $template = $twig->loadTemplate($file);
        echo $template->render($this->$_params);
    }
}
