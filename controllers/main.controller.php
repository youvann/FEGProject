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

/* / autorisations
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
    case "form-candidat-formation" : {
        echo $twig->render('form.formationCandidat.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
            'formTitle' => 'Etape 1/4 : Parcours de l\'étudiant',
            'pathAction' => '#',
            'idForm' => 'form-candidat-formation'
        ));
    }break;
    case "form-info-perso" : {
        echo $twig->render('form.infoPerso.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
            'formTitle' => 'Etape 2/4 : Candidature/pré-inscription pour la formation ...',
            'pathAction' => '#',
            'idForm' => 'form-info-perso'
        ));
    }break;
    case "form-voeux" : {
        echo $twig->render('form.voeux.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
            'formTitle' => 'Etape 3/4 : Choisissez votre spécialité',
            'pathAction' => '#',
            'idForm' => 'form-voeux'
        ));
    }break;
    case "form-post-bac" : {
        echo $twig->render('form.postBac.html.twig', array(
            'titre2' => 'Formulaire d\'inscription pour l\'année soclaire 2014-2015',
            'formTitle' => 'Etape 4/4 : Parcours post-bac',
            'pathAction' => '#',
            'idForm' => 'form-post-bac'
        ));
    }break;

	default: break;
}