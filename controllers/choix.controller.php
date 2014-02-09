<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "ajout";
} else {
	$action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "ajouter": {
			$types = $typeManager->findAll();
			echo $twig->render('choix/ajouterChoix.html.twig', array('information' => $_GET['information'], 'code' => $_GET['code']));
		} break;
	case "ajout": {
			foreach ($_POST['tb'] as $tb) {
				$choixManager->insert(new Choix(0, $_POST['information'], $tb));
			}
			header('location:index.php?uc=information&action=grille&code=' . $_POST['code']);
		} break;
	default: break;
}