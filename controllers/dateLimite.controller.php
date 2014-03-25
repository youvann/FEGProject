<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/dateLimite.controller.php
 * @Purpose: Ce contrôleur gère l'entité choix
 * @Author : Lionel Guissani
 */

if (!isset($_GET['action'])) {
	$action = "modifier";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action ajoute des choix en base données
	case "modifier":
	{
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		$formations = $formationManager->findAll();
		$datesLimites = $dateLimiteManager->findAllByDossierPdf($dossierPdf);
		$titulaires = $titulaireManager->findAll();
			echo $twig->render('dateLimite/modifierDatesLimites.html.twig', array(
				'dossierPdf' => $dossierPdf,
				'formations' => $formations,
				'datesLimites' => $datesLimites,
				'titulaires' => $titulaires));
		} break;
	// Cette action modifie les date limite d'un dossier en base données
	case "modification":
	{
		$datesLimites = $dateLimiteManager->findAllByDossierPdf($dossierPdfManager->find($_POST['dossier_pdf']));
		$titulaires = $titulaireManager->findAll();

		foreach($datesLimites as $dateLimite) {
			$dateLimiteManager->delete($dateLimite);
		}

		foreach($titulaires as $titulaire) {
			$dateLimite = explode("/", $_POST['date_limite_'.$titulaire->getId()]);
			$dateLimite = $dateLimite[2] . $dateLimite[0] . $dateLimite[1];
			$dateLimiteManager->insert(new DateLimite($_POST['dossier_pdf'], $titulaire->getId(), $dateLimite));
		}
		header("location:index.php?uc=dateLimite&action=modifier&dossierPdf=".$_POST['dossier_pdf']);
	}
		break;
	default:
		break;
}