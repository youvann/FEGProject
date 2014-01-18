<?php

/**
 * @Project: FEG Project
 * @File: /controllers/formation.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "grille": {
			$formations = array();
			$formations[] = new Formation("Licence Informatique", "L3 Parcours Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE)", "3SIN", "BIN303", "111", "Nicola Olivetti", "Aix-en-Provence", "FEG", "fr");
			$formations[] = new Formation("Licence Gestion", "L3 Parcours Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE)", "3BGE", "BGE303", "111", "Pierre-Yves Rolland", "Aix-en-Provence", "FEG", "fr");
			echo $twig->render('formation/grilleFormation.html.twig', array('formations' => $formations, "titre2" => "Liste des formations"));
		} break;
	case "ajouter": {
			echo $twig->render('formation/ajouterFormation.html.twig', array('titre2' => 'Ajouter une formation'));
		} break;
	case "ajout": {
			$formationManager->insert(new Formation($_POST['mention'], $_POST['etape'], $_POST['code_diplome'], $_POST['code_etape'], $_POST['code_vet'], $_POST['responsable'], $_POST['ville'], $_POST['faculte'], $_POST['langue_pdf']));
			header('location:index.php?uc=formation&action=grille');
		} break;
	case "modifier": {
			$formation = $formationManager->find($_GET['code_etape'], $_GET['code_vet']);
			echo $twig->render('formation/ajouterFormation.html.twig', array('formation' => $formation));
		} break;
	case "modification": {
			$formation = new Formation($_POST['mention'], $_POST['etape'], $_POST['code_diplome'], $_POST['code_etape'], $_POST['code_vet'], $_POST['responsable'], $_POST['ville'], $_POST['faculte'], $_POST['langue_pdf']);
			$formationManager->update($formation);
			header('location:index.php?uc=formation&action=grille');
		} break;
	case "suppression": {
			$formation = $formationManager->find($_GET['code_etape'], $_GET['code_vet']);
			$formationManager->delete($formation);
			header('location:index.php?uc=formation&action=grille');
		} break;
	default: break;
}