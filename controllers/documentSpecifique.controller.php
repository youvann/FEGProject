<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/pieceAJoindre.controller.php
 * @Purpose: Ce contrôleur gère l'entité DocumentSpecifique
 * @Author : Lionel Guissani
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action permet de consulter la listes des documents
	// spécifiques demandés dans un dossier pdf sous forme de grille
	case "grille":
	{
		// On récupère le dossier pdf dont l'identifiant est passé par variable GET
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		// On récupère tous les documents spécifiques demandés dans le dossier pdf
		$documentsSpecifiques = $documentSpecifiqueManager->findAllByDossierPdf($dossierPdf);
		echo $twig->render('documentSpecifique/grilleDocumentSpecifique.html.twig', array('documentsSpecifiques' => $documentsSpecifiques, 'dossierPdf' => $dossierPdf));
	}
		break;
	// Cette action mène au formulaire d'ajout d'un document spécifique
	case "ajouter":
	{
		// On récupère le dossier pdf dont l'identifiant est passé en variable GET
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		echo $twig->render('documentSpecifique/ajouterDocumentSpecifique.html.twig', array('dossierPdf' => $dossierPdf));
	}
		break;
	// Cette action ajoute un document spécifique en base données
	case "ajout":
	{
		// On insère un document spécifique en base de données
		$documentSpecifiqueManager->insert(new DocumentSpecifique(0, $_POST['dossier_pdf'], $_POST['nom'], $_POST['visible'], $_POST['url']));
		header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf=' . $_POST['dossier_pdf']);
	}
		break;
	// Cette action mène au formulaire d'ajout d'un document spécifique
	case "modifier":
	{
		// On récupère le document spécifique dont l'identifiant est passé en paramètre
		$documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
		// On récupère le dossier pdf qui demande le document spécifique courant
		$dossierPdf = $dossierPdfManager->find($documentSpecifique->getDossierPdf());
		echo $twig->render('documentSpecifique/modifierDocumentSpecifique.html.twig', array('documentSpecifique' => $documentSpecifique, 'dossierPdf' => $dossierPdf));
	}
		break;
	// Cette action modifie un document spécifique en base données
	case "modification":
	{
		// On hydrate un objet à partir du formulaire
		$documentSpecifique = new documentSpecifique($_POST['id'], $_POST['dossier_pdf'], $_POST['nom'], $_POST['visible'], $_POST['url'], $_POST['multiple']);
		// On met à jour le document spécifique à travers le manager
		$documentSpecifiqueManager->update($documentSpecifique);
		header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf=' . $_POST['dossier_pdf']);
	}
		break;
	case "suppression":
	{
		// On récupère le document spécifique dont l'identifiant est passé en paramètre
		$documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
		// On le supprime à travers le manager
		$documentSpecifiqueManager->delete($documentSpecifique);
		header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf=' . $documentSpecifique->getDossierPdf());
	}
		break;
	default:
		break;
}
