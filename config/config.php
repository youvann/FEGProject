<?php

// main classes loader

require_once './classes/FormElements/loader.php';
require_once './classes/Translator/loader.php';

// Connexion PDO
$dbname = 'fegtest1';
$host = 'localhost';
$user = 'root';
$password = 'root';

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
$choixManager = new ChoixManager($conn);
$cursusManager = new CursusManager($conn);
$documentManager = new DocumentManager($conn);
$documentSpecifiqueManager = new DocumentSpecifiqueManager($conn);
$dossierManager = new DossierManager($conn);
$etudiantManager = new EtudiantManager($conn);
$experienceManager = new ExperienceManager($conn);
$faireManager = new FaireManager($conn);
$formationManager = new FormationManager($conn);
$informationManager = new InformationManager($conn);
$seDeroulerManager = new SeDeroulerManager($conn);
$typeManager = new TypeManager($conn);
$villeManager = new VilleManager($conn);
$voeuManager = new VoeuManager($conn);

include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array('cache' => false));
