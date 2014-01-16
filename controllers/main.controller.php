<?php

if (!isset($_GET['action'])) {
	$action = "accueil";
} else {
	$action = $_GET['action'];
}

/*/ autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "accueil": {
			echo $twig->render('accueil.html.twig', array(
				'titre2' => 'Inscription pour l\'année scolaire 2014-2015'
			));
		} break;
	default: break;
}