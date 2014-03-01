<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/dependre.controller.php
 * @Purpose:
 * @Author :
 */

if (!isset($_GET['action'])) {
	$action = "modifier";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	case "modifier":
	{
		$dossierPdf  = $dossierPdfManager->find ($_GET['dossierPdf']);
		$dependances = $dependreManager->findEtapes ($dossierPdf);

		$formations       = $formationManager->findAll ();
		$voeux            = $voeuManager->findAll ();
		$voeuxCompatibles = array ();
		foreach ($dependances as $dependance) {
			$voeuxCompatibles[] = $voeuManager->find ($dependance->getCodeEtape ());
		}

		echo $twig->render ('dependre/dependances.html.twig', array ('dossierPdf' => $dossierPdf, 'formations' => $formations, 'voeuxCompatibles' => $voeuxCompatibles, 'voeux' => $voeux));
	}
		break;
	case "modification":
	{
		$dossierPdf = $dossierPdfManager->find ($_POST['idDossier']);

		$dependances = $dependreManager->findEtapes ($dossierPdf);

		foreach ($dependances as $dependance) {
			$dependreManager->delete ($dependance);
		}

		if (isset($_POST['voeux'])) {
			foreach ($_POST['voeux'] as $voeu) {
				$unVoeu = $voeuManager->find ($voeu);
				$dependreManager->insert (new Dependre(intval ($_POST['idDossier']), $unVoeu->getCodeEtape ()));
			}
		}
		header ('location:index.php?uc=dependre&modifier=&dossierPdf=' . $_POST['idDossier']);
	}
		break;
	default:
		break;
}
