<?php

// Droits utilisateurs
require_once './config/rights.php';

// fonctions
require_once './lib/functions.php';

// main classes loader
require_once './classes/FormElements/loader.php';
require_once './classes/Translator/loader.php';
// Connexion PDO
require_once './model/PDO.php';
// entities loader
require_once './Entities/loader.php';

// Chargement des ressources francais/anglais
$ressources = xml2array(simplexml_load_file('./ressources/ressources_1.xml'));


include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array('cache' => false));
$twig->addGlobal('get', $_GET);

// Module connexion
session_start();

if (empty($_SESSION)) {
	$_SESSION['name'] = 'Anonymous';
	$_SESSION['rights'] = $anonymous;
}
if (isset($_GET['uc']) && isset($_GET['action'])) {
	if(!in_array(array($_GET['uc'], $_GET['action']), $_SESSION['rights'])) {
		header('location:index.php');
	}
}