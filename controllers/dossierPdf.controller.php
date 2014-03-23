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
		// On renseigne l'identifiant dans le JSON
		$json['id'] = $dossierPdf->getId();
		// On renseigne le nom dans le JSON
		$json['nom'] = $dossierPdf->getNom();
		// On renseigne les informations dans le JSON
		$json['informations'] = $dossierPdf->getInformations() === NULL ? '' : $dossierPdf->getInformations();
		// On renseigne les modalités dans le JSON
		$json['modalites'] = $dossierPdf->getModalites() === NULL ? '' : $dossierPdf->getModalites();
		// On renseigne le code formation dans le JSON
		$json['codeFormation'] = $dossierPdf->getCodeFormation();
		$response['dossierPdf'] = $json;
		echo json_encode($response);
	}
		break;
	// Cette action ajout un dossier pdf en base de données
	case 'ajout' :
	{
		// On insère un dossier pdf en base de données à travers le manager
		$dossierPdfManager->insert(new DossierPdf(0, $_POST['nom'], $_POST['informations'], $_POST['modalites'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	// Cette action modifie un dossier pdf en base de données
	case 'modification' :
	{
		// On met à jour un dossier pdf en base de données à travers le manager
		$dossierPdfManager->update(new DossierPdf($_POST['id'], $_POST['nom'], $_POST['informations'], $_POST['modalites'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	// Cette action suppime un dossier pdf en base de données
	case 'suppression' :
	{
		// On récupère l'identifiant du dossier pdf passé en variable GET
		$dossierPdf = $dossierPdfManager->find($_GET['idDossier']);
		// On supprime un dossier pdf en base de données à travers le manager
		$dossierPdfManager->delete($dossierPdf);
		header('location:index.php?uc=dossierPdf&action=grille&code=' . $dossierPdf->getCodeFormation());
	}
		break;

	default:
		break;
}
