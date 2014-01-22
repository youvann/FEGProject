<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
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
			$formation = $formationManager->find($_GET['code']);
			$informations = $informationManager->findAllByFormation($formation);
			echo $twig->render('information/grilleInformation.html.twig', array('informations' => $informations, 'code' => $_GET['code']));
		} break;
	case "consulter": {
			$information = $informationManager->find($_GET['id']);
			$choix = $choixManager->findAllByInformation($information);
			echo $twig->render('information/consulterInformation.html.twig', array('information' => $information, 'choix' => $choix, 'code' => $_GET['code']));
		} break;
	case "ajouter": {
			$types = $typeManager->findAll();
			echo $twig->render('information/ajouterInformation.html.twig', array('types' => $types, 'code' => $_GET['code']));
		} break;
	case "ajout": {
			$informationManager->insert(new Information(0, $_POST["type"], $_POST["code_formation"], $_POST["libelle"], $_POST["explications"], 0));
			if ($_POST["type"] === 'RadioButtonGroup' || $_POST["type"] === 'CheckBoxGroup') {
				$lastInsertId = $informationManager->maxId();
				foreach ($_POST['tb'] as $tb) {
					$choixManager->insert(new Choix(0, $lastInsertId, $tb));
				}
			}
			header('location:index.php?uc=information&action=grille&code=' . $_POST['code_formation']);
		} break;
	case "suppression": {
			$information = $informationManager->find($_GET['id']);
			$informationManager->delete($information);
			header('location:index.php?uc=information&action=grille&code=' . $_GET['code']);
		} break;
	default: break;
}