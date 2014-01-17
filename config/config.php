<?php

// main classes loader

require_once './classes/FormElements/loader.php';
require_once './classes/Translator/loader.php';

// Connexion PDO
$dbname = 'test';
$host = 'localhost';
$user = 'root';
$password = '';

static $conn = null;

try {
	$conn = new PDO('mysql:dbname=' . $dbname . ';host=' . $host, $user, $password);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}

$conn->query("SET CHARACTER SET utf8");

// entities loader
require_once './Entities/loader.php';

// Instanciations des Managers
$candidatManager = new CandidatManager($conn);
$cursusEtudiantManager = new CursusEtudiantManager($conn);
$dependanceManager = new DependanceManager($conn);
$formationManager = new FormationManager($conn);
$informationSuppManager = new InformationSuppManager($conn);
$pieceAJoindreGeneraleManager = new PieceAJoindreGeneraleManager($conn);
$pieceAJoindreManager = new PieceAJoindreManager($conn);
$typeChampsInformationsManager = new TypeChampsInformationsManager($conn);

include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array('cache' => false));
