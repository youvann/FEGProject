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
	case "consulter": {
			//$formation = $formationManager->find($_GET['code']);
			//echo $twig->render('formation/consulterFormation.html.twig', array('formation' => $formation));
		} break;
	case "grille": {
			$formation = $formationManager->find($_GET['code']);
			$voeux = $voeuManager->findAllByFormation($formation);
			echo $twig->render('voeu/grilleVoeu.html.twig', array('voeux' => $voeux, 'code' => $_GET['code']));
		} break;
	case "ajouter": {
			$villes = $villeManager->findAll();
			echo $twig->render('voeu/ajouterVoeu.html.twig', array('code' => $_GET['code'], 'villes' => $villes));
		} break;
	case "ajout": {
			$voeuManager->insert(new Voeu($_POST['code_etape'], $_POST['code_formation'], $_POST['etape'], $_POST['responsable']));

			foreach ($_POST['villes'] as $ville) {
				$seDeroulerManager->insert(new SeDerouler($ville, $_POST['code_etape']));
			}
			header('location:index.php?uc=voeu&action=grille&code=' . $_POST['code_formation']);
		} break;
	/* case "modifier": {
	  $formation = $formationManager->find($_GET['code']);
	  echo $twig->render('formation/modifierFormation.html.twig', array('formation' => $formation));
	  } break;
	  case "modification": {
	  $formation = new Formation($_POST['code'], $_POST['mention'], $_POST['ouverte']);
	  $formationManager->update($formation);
	  header('location:index.php?uc=formation&action=grille');
	  } break; */
	case "suppression": {
			$voeu = $voeuManager->find($_GET['codeEtape']);
			$voeuManager->delete($voeu);
			header('location:index.php?uc=formation&action=grille' . $voeu->getCode());
		} break;
	default: break;
}