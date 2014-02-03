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
    case "consulter":
    {
        $formation = $formationManager->find($_GET['code']);
        echo $twig->render('formation/consulterFormation.html.twig', array('formation' => $formation));
    }
        break;
    case "grille":
    {
        $formations = $formationManager->findAll();
        echo $twig->render('formation/grilleFormation.html.twig', array('formations' => $formations));
    }
        break;
    case "ajouter":
    {
        $facultes = $faculteManager->findAll();
        $langues = $langueManager->findAll();
        echo $twig->render('formation/ajouterFormation.html.twig', array('facultes' => $facultes, 'langues' => $langues));
    } break;
    case "ajout": {
		$formationManager->insert(new Formation($_POST['code_formation'], $_POST['mention'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']));
        header('location:index.php?uc=formation&action=grille');
    } break;
    case "modifier": {
		$facultes = $faculteManager->findAll();
        $formation = $formationManager->find($_GET['code']);
        echo $twig->render('formation/modifierFormation.html.twig', array('facultes' => $facultes, 'formation' => $formation));
    } break;
    case "modification": {
        $formation = new Formation($_POST['code_formation'], $_POST['mention'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']);
        $formationManager->update($formation);
        header('location:index.php?uc=formation&action=grille');
    }
        break;
    case "suppression":
    {
        $formation = $formationManager->find($_GET['code']);
        $formationManager->delete($formation);
        header('location:index.php?uc=formation&action=grille');
    }
        break;
	case "codeFormationPossible": {
		$q = $conn->prepare("SELECT IF(count(*) = 1, FALSE, TRUE) as ok FROM `formation` WHERE `code_formation` = ?;");
		$q->execute(array($_POST['code']));
		$rs = $q->fetch();
		$response['response'] = $rs['ok'];
		echo json_encode($response);
	} break;
    default:
        break;
}