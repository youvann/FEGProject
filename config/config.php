<?php

// main classes loader

require_once './classes/FormElements/loader.php';
require_once './classes/Translator/loader.php';


include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array('cache' => false));
