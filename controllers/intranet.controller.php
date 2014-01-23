<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "accueil";
} else {
	$action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "accueil": {
			echo $twig->render('intranet/accueil.html.twig');
		} break;
	case "carte": {
			echo $twig->render('intranet/carte.html.twig');
		} break;
	case "explorateur": {
			echo $twig->render('intranet/explorateur.html.twig', array('directory' => str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))).'/'));
		} break;
	default: break;
}