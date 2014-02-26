<?php

/**
 * @Project: FEG Project
 * @File: /controllers/dossierPdf.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	case "grille": {
		$code = $_GET['code'];
		$formation = $formationManager->find($code);
		$voeux = $voeuManager->findAllByFormation($formation);
		$dossiersPdf = $dossierPdfManager->findAllByFormation($formation);
		echo $twig->render('dossierPdf/grilleDossierPdf.html.twig', array('code' => $code,
			'voeux' => $voeux,
			'dossiersPdf' => $dossiersPdf));
	} break;
	case 'consulter':
	{
		FileHeader::headerJson();
		$dossierPdf = $dossierPdfManager->find($_POST['idDossierPdf']);
		$json['id'] = $dossierPdf->getId();
		$json['nom'] = $dossierPdf->getNom();
		$json['codeFormation'] = $dossierPdf->getCodeFormation();
		$response['dossierPdf'] = $json;
		echo json_encode($response);
	}
		break;
	case 'ajout' :
	{

		$dossierPdfManager->insert(new DossierPdf(0, $_POST['nom'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code='.$_POST['code_formation']);
	}
		break;
	case 'modification' :
	{
		$dossierPdfManager->update(new DossierPdf($_POST['id'], $_POST['nom'], $_POST['code_formation']));
		header('location:index.php?uc=dossierPdf&action=grille&code='.$_POST['code_formation']);
	}
		break;
	case 'suppression' :
	{
		$dossierPdf = $dossierPdfManager->find($_GET['idDossier']);
		$dossierPdfManager->delete($dossierPdf);
		header('location:index.php?uc=dossierPdf&action=grille&code='.$dossierPdf->getCodeFormation());
	}
		break;

	default: break;
}
