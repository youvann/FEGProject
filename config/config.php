<?php

// Droits utilisateurs
require_once './config/rights.php';

// fonctions
require_once './lib/functions.php';

// main classes loader
require_once './classes/FormElements/loader.php';
require_once './classes/Translator/loader.php';
require_once './classes/FileHeader.class.php';

// Connexion PDO
require_once './model/PDO.php';
// entities loader
require_once './Entities/loader.php';

// Chargement des ressources francais/anglais
//$ressources = xml2array(simplexml_load_file('./ressources/ressources_1.xml'));

// Module connexion
session_start();

if (empty($_SESSION)) {
	$_SESSION['name'] = 'Anonymous';
	$_SESSION['grade'] = 0;
	$_SESSION['rights'] = $droits[$_SESSION['grade']];
}
// Pare-feu
if (isset($_GET['uc']) && isset($_GET['action'])) {
	if (!in_array(array($_GET['uc'], $_GET['action']), $_SESSION['rights'])) {
		header('location:index.php');
	}
}

// Années
$anneeBasse = (int)date('Y');
$anneeHaute = ((int)date('Y')) + 1;

// Chargement de TWIG
include_once('Twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array('cache' => false));
$twig->addGlobal('get', $_GET);
$twig->addGlobal('session', $_SESSION);

$twig->addGlobal('anneeBasse', $anneeBasse);
$twig->addGlobal('anneeHaute', $anneeHaute);

$twig->addGlobal('random', rand(10000, 900000));

$twig->addGlobal('departements', array('01' => 'Ain',
	'02' => 'Aisne',
	'03' => 'Allier',
	'04' => 'Alpes-de-Haute-Provence',
	'05' => 'Hautes-Alpes',
	'06' => 'Alpes-Maritimes',
	'07' => 'Ardèche',
	'08' => 'Ardennes',
	'09' => 'Ariège',
	'10' => 'Aube',
	'11' => 'Aude',
	'12' => 'Aveyron',
	'13' => 'Bouches-du-Rhône',
	'14' => 'Calvados',
	'15' => 'Cantal',
	'16' => 'Charente',
	'17' => 'Charente-Maritime',
	'18' => 'Cher',
	'19' => 'Corrèze',
	'2A' => 'Corse-du-Sud',
	'2B' => 'Haute-Corse',
	'21' => 'Côte-d’Or',
	'22' => 'Côtes-d’Armor',
	'23' => 'Creuse',
	'24' => 'Dordogne',
	'25' => 'Doubs',
	'26' => 'Drôme',
	'27' => 'Eure',
	'28' => 'Eure-et-Loir',
	'29' => 'Finistère',
	'30' => 'Gard',
	'31' => 'Haute-Garonne',
	'32' => 'Gers',
	'33' => 'Gironde',
	'34' => 'Hérault',
	'35' => 'Ille-et-Vilaine',
	'36' => 'Indre',
	'37' => 'Indre-et-Loire',
	'38' => 'Isère',
	'39' => 'Jura',
	'40' => 'Landes',
	'41' => 'Loir-et-Cher',
	'42' => 'Loire',
	'43' => 'Haute-Loire',
	'44' => 'Loire-Atlantique',
	'45' => 'Loiret',
	'46' => 'Lot',
	'47' => 'Lot-et-Garonne',
	'48' => 'Lozère',
	'49' => 'Maine-et-Loire',
	'50' => 'Manche',
	'51' => 'Marne',
	'52' => 'Haute-Marne',
	'53' => 'Mayenne',
	'54' => 'Meurthe-et-Moselle',
	'55' => 'Meuse',
	'56' => 'Morbihan',
	'57' => 'Moselle',
	'58' => 'Nièvre',
	'59' => 'Nord',
	'60' => 'Oise',
	'61' => 'Orne',
	'62' => 'Pas-de-Calais',
	'63' => 'Puy-de-Dôme',
	'64' => 'Pyrénées-Atlantiques',
	'65' => 'Hautes-Pyrénées',
	'66' => 'Pyrénées-Orientales',
	'67' => 'Bas-Rhin',
	'68' => 'Haut-Rhin',
	'69' => 'Rhône',
	'70' => 'Haute-Saône',
	'71' => 'Saône-et-Loire',
	'72' => 'Sarthe',
	'73' => 'Savoie',
	'74' => 'Haute-Savoie',
	'75' => 'Paris',
	'76' => 'Seine-Maritime',
	'77' => 'Seine-et-Marne',
	'78' => 'Yvelines',
	'79' => 'Deux-Sèvres',
	'80' => 'Somme',
	'81' => 'Tarn',
	'82' => 'Tarn-et-Garonne',
	'83' => 'Var',
	'84' => 'Vaucluse',
	'85' => 'Vendée',
	'86' => 'Vienne',
	'87' => 'Haute-Vienne',
	'88' => 'Vosges',
	'89' => 'Yonne',
	'90' => 'Territoire de Belfort',
	'91' => 'Essonne',
	'92' => 'Hauts-de-Seine',
	'93' => 'Seine-Saint-Denis',
	'94' => 'Val-de-Marne',
	'95' => 'Val-d’Oise',
	'971' => 'Guadeloupe',
	'972' => 'Martinique',
	'973' => 'Guyane',
	'974' => 'La Réunion',
	'976' => 'Mayotte'));

$twig->addGlobal('paysUe', array('DE' => 'Allemagne',
	'AT' => 'Autriche',
	'BE' => 'Belgique',
	'BG' => 'Bulgarie',
	'CY' => 'Chypre',
	'HR' => 'Croatie',
	'DK' => 'Danemark',
	'ES' => 'Espagne',
	'EE' => 'Estonie',
	'FI' => 'Finlande',
	'FR' => 'France',
	'EL' => 'Grèce',
	'HU' => 'Hongrie',
	'IE' => 'Irlande',
	'IT' => 'Italie',
	'LV' => 'Lettonie',
	'LT' => 'Lituanie',
	'LU' => 'Luxembourg',
	'MT' => 'Malte',
	'NL' => 'Pays-Bas',
	'PL' => 'Pologne',
	'PT' => 'Portugal',
	'CZ' => 'République tchèque',
	'RO' => 'Roumanie',
	'GB' => 'Royaume-Uni',
	'SK' => 'Slovaquie',
	'SI' => 'Slovénie',
	'SE' => 'Suède'));
