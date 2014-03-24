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
				'dateLimites' => $datesLimites,
				'titulaires' => $titulaires));
		} break;
	// Cette action modifie les date limite d'un dossier en base données
	case "modification":
	{

	}
		break;
	default:
		break;
}