<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/dossierPdf.controller.php
 * @Purpose: Ce contrôleur gère l'entité DossierPdf
 * @Author : Lionel Guissani
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action permet de voir les dossiers pdf d'une formation
	case "grille":
	{
		// On récupère le code formation
		$code = $_GET['code'];
		// On récupère la formation en question
		$formation = $formationManager->find($code);
		// On récupère les voeux de la formation
		$voeux = $voeuManager->findAllByFormation($formation);
		// On récupère les dossier pdf de la formation
		$dossiersPdf = $dossierPdfManager->findAllByFormation($formation);
		echo $twig->render('dossierPdf/grilleDossierPdf.html.twig', array('code' => $code,
			'voeux' => $voeux,
			'dossiersPdf' => $dossiersPdf));
	}
		break;
	// Cette action retourne les informations d'un dossier pdf au format JSON
	case 'consulter':
	{
		// On met en entête de fichier du JSON
		FileHeader::headerJson();
		// On récupère le dossiezr pdf
		$dossierPdf = $dossierPdfManager->find($_POST['idDossierPdf']);
		$json['id'] = $dossierPdf->getId();
		$json['nom'] = $dossierPdf->getNom();
		$json['informations'] = $dossierPdf->getInformations() === NULL ? '' : $dossierPdf->getInformations();
		$json['modalites'] = $dossierPdf->getModalites() === NULL ? '' : $dossierPdf->getModalites();
		$json['codeFormation'] = $dossierPdf->getCodeFormation();
		$response['dossierPdf'] = $json;
		echo json_encode($response);
	}
		break;
	case 'ajout' :
	{
		$dossierPdfManager->insert(new DossierPdf(0, $_POST['nom'], $_POST['informations'], $_POST['modalites'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	case 'modification' :
	{
		$dossierPdfManager->update(new DossierPdf($_POST['id'], $_POST['nom'], $_POST['informations'], $_POST['modalites'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	case 'suppression' :
	{
		$dossierPdf = $dossierPdfManager->find($_GET['idDossier']);
		$dossierPdfManager->delete($dossierPdf);
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $dossierPdf->getCodeFormation());
	}
		break;

	default:
		break;
}
