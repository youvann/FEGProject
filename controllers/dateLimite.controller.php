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
			$dateLimiteCandidature = explode("/", $_POST['date_limite_'.$titulaire->getId().'_ca']);
			$dateLimiteCandidature = $dateLimiteCandidature[2] . $dateLimiteCandidature[0] . $dateLimiteCandidature[1];

			$dateLimitePreinscription = explode("/", $_POST['date_limite_'.$titulaire->getId().'_pi']);
			$dateLimitePreinscription = $dateLimitePreinscription[2] . $dateLimitePreinscription[0] . $dateLimitePreinscription[1];

			$dateLimiteManager->insert(new DateLimite($_POST['dossier_pdf'], $titulaire->getId(), $dateLimiteCandidature, $dateLimitePreinscription));
		}
		header("location:index.php?uc=dateLimite&action=modifier&dossierPdf=".$_POST['dossier_pdf']);
	}
		break;
	default:
		break;
}