<?php
/**
 * @Project: FEG Project
 * @File: /controllers/main.controller.php
 * @Purpose:
 * @Author:
 */

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
    case "candidatFormation" : {
        echo $twig->render('formulaire/formCandidat.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
        ));
    }break;
    case "infoPerso" : {
        echo $twig->render('formulaire/infoPerso.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
        ));
    }break;
    case "choixSpe" : {
        echo $twig->render('formulaire/choixSpe.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
        ));
    }break;
    case "postBac" : {
        echo $twig->render('formulaire/postBac.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
        ));
    }break;
    case "intranet" : {
        echo $twig->render('pdf.html.twig', array(
            'titre2' => 'Modification d\'un document pdf'
        ));
    }break;

	default: break;
}