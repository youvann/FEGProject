<?php

/**
 * @Project: FEG Project
 * @File: /controllers/information.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	case "grille":
	{
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		$types = $typeManager->findAll();
		$informations = $informationManager->findAllByDossierPdf($dossierPdf);
		echo $twig->render('information/grilleInformation.html.twig', array('informations' => $informations, 'types' => $types, 'dossierPdf' => $dossierPdf));
	}
		break;
	case "consulter":
	{
		$information = $informationManager->find($_GET['id']);
		$types = $typeManager->findAll();
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		$choix = $choixManager->findAllByInformation($information);
		echo $twig->render('information/consulterInformation.html.twig', array('information' => $information, 'choix' => $choix, 'types' => $types, 'dossierPdf' => $dossierPdf));
	}
		break;
	case "ajouter":
	{
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		$types = $typeManager->findAll();
		echo $twig->render('information/ajouterInformation.html.twig', array('types' => $types, 'dossierPdf' => $dossierPdf));
	}
		break;
	case "ajout":
	{
		$informationManager->insert(new Information(0, $_POST["type"], $_POST["dossier_pdf"], $_POST["libelle"], $_POST["explications"], 0));
		if ($_POST["type"] === 'RadioButtonGroup' || $_POST["type"] === 'CheckBoxGroup') {
			$lastInsertId = $informationManager->maxId();
			foreach ($_POST['tb'] as $tb) {
				$choixManager->insert(new Choix(0, $lastInsertId, $tb));
			}
		}
		header('location:index.php?uc=information&action=grille&dossierPdf=' . $_POST['dossier_pdf']);
	}
		break;
	case "suppression":
	{
		$information = $informationManager->find($_GET['id']);
		$informationManager->delete($information);
		header('location:index.php?uc=information&action=grille&dossierPdf=' . $information->getDossierPdf());
	}
		break;
	case "ordonnancement":
	{
		$i = 1;
		foreach ($_POST['info'] as $id) {
			$information = $informationManager->find($id);
			$information->setOrdre($i++);
			$informationManager->update($information);
		}
	}
		break;
	default:
		break;
}