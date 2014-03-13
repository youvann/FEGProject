<?php

/**
 * @Project: FEG Project
 * @File: /controllers/information.controller.php
 * @Purpose: Ce contrôleur gère l'entité informations spécifiques
 * @Author:
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

switch ($action) {
	// Cette action affiche la liste des informations rattachées à un dossier pdf sous forme de grille
    case "grille":
    {
		// On récupère le dossier pdf dont l'identifiant est passé en paramètre
        $dossierPdf   = $dossierPdfManager->find ($_GET['dossierPdf']);
		// On récupère les type d'élément de formulaire HTML
        $types        = $typeManager->findAll ();
		// On récupère les informations rattachées au dossier pdf
        $informations = $informationManager->findAllByDossierPdf ($dossierPdf);
        echo $twig->render ('information/grilleInformation.html.twig', array ('informations' => $informations, 'types' => $types, 'dossierPdf' => $dossierPdf));
    }
        break;
	// Cette action permet de consulter les données d'une information
    case "consulter":
    {
		// On récupère l'information dont l'identifiant est passé en paramètre
        $information = $informationManager->find ($_GET['id']);
		// On récupère les type d'élément de formulaire HTML
        $types       = $typeManager->findAll ();
		// On récupère le dossier pdf dont l'identifiant est passé en paramètre
        $dossierPdf  = $dossierPdfManager->find ($_GET['dossierPdf']);
		// On récupère les choix rattachés à l'information
        $choix       = $choixManager->findAllByInformation ($information);
        echo $twig->render ('information/consulterInformation.html.twig', array ('information' => $information, 'choix' => $choix, 'types' => $types, 'dossierPdf' => $dossierPdf));
    }
        break;
	// Cette action permet de consulter les données d'une information
    case "ajouter":
    {
		// On récupère l'information dont l'identifiant est passé en paramètre
        $dossierPdf = $dossierPdfManager->find ($_GET['dossierPdf']);
		// On récupère les type d'élément de formulaire HTML
        $types      = $typeManager->findAll ();
        echo $twig->render ('information/ajouterInformation.html.twig', array ('types' => $types, 'dossierPdf' => $dossierPdf));
    }
        break;
	// Cette action ajoute en base de données une information
    case "ajout":
    {
		// On insère en base de données une information
        $informationManager->insert (new Information(0, $_POST["type"], $_POST["dossier_pdf"], $_POST["libelle"], $_POST["explications"], 0));
		// Si l'élément inséré est un groupe de boutons radio ou de cases à cocher
        if ($_POST["type"] === 'RadioButtonGroup' || $_POST["type"] === 'CheckBoxGroup') {
            $lastInsertId = $informationManager->maxId ();
            foreach ($_POST['tb'] as $tb) {
				// On insère en base de données les différents choix rattachés à la nouvelle information
                $choixManager->insert (new Choix(0, $lastInsertId, $tb));
            }
        }
		// On redirige vers la grille des informations d'un dossier
        header ('location:index.php?uc=information&action=grille&dossierPdf=' . $_POST['dossier_pdf']);
    }
        break;
	// Cette action supprime une information en base données
    case "suppression":
    {
		// On récupère l'information dans l'indentifiant est passé en variable GET
        $information = $informationManager->find ($_GET['id']);
		// On la supprime
        $informationManager->delete ($information);
		// On redirige vers la grille des informations d'un dossier
        header ('location:index.php?uc=information&action=grille&dossierPdf=' . $information->getDossierPdf ());
    }
        break;
    case "ordonnancement":
    {
        $i = 1;
        foreach ($_POST['info'] as $id) {
            $information = $informationManager->find ($id);
            $information->setOrdre ($i++);
            $informationManager->update ($information);
        }
    }
        break;
    default:
        break;
}
