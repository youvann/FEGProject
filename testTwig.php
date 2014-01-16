<?php

require_once 'config/config.php';
/*
$formation = new Formation("Licence Informatique", 
		"L3 Parcours Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE)", 
		"3SIN", 
		"BIN303", 
		"111", 
		"Nicola Olivetti", 
		"Aix-en-Provence", 
		"FEG", 
		"fr");

echo $twig->render('formation/modifierFormation.html.twig', array(
    'formation' => $formation
));
*/

$formations = array();

$formations[] = new Formation("Licence Informatique", 
		"L3 Parcours Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE)", 
		"3SIN", 
		"BIN303", 
		"111", 
		"Nicola Olivetti", 
		"Aix-en-Provence", 
		"FEG", 
		"fr");

$formations[] = new Formation("Licence Gestion", 
		"L3 Parcours Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE)", 
		"3BGE", 
		"BGE303", 
		"111", 
		"Pierre-Yves Rolland", 
		"Aix-en-Provence", 
		"FEG", 
		"fr");

echo $twig->render('formation/grilleFormation.html.twig', array(
    'formations' => $formations
));