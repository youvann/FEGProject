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
		$formation = $formationManager->find($_GET['code']);
		$dossiersPdf = $dossierPdfManager->findAllByFormation($formation);
		echo $twig->render('dossierPdf/grilledossierPdf.html.twig', array('dossiersPdf' => $dossiersPdf));
	} break;

	default: break;
}
