<?php

    require_once __DIR__ . '/../../vendor/autoload.php';
    
    $loader = new Twig_Loader_Filesystem('../Views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
));