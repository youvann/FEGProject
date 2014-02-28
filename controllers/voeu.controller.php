<?php

/**
 * @Project: FEG Project
 * @File: /controllers/formation.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	case "consulter":
	{
		$voeu = $voeuManager->find($_GET['codeEtape']);
		$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/consulterVoeu.html.twig', array('voeu' => $voeu, 'villes' => $villes, 'lesSeDerouler' => $lesSeDerouler, 'code' => $_GET['code']));
	}
		break;
	case "grille":
	{
		$formation = $formationManager->find($_GET['code']);
		$voeux = $voeuManager->findAllByFormation($formation);
		echo $twig->render('voeu/grilleVoeu.html.twig', array('voeux' => $voeux, 'code' => $_GET['code']));
	}
		break;
	case "ajouter":
	{
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/ajouterVoeu.html.twig', array('code' => $_GET['code'], 'villes' => $villes));
	}
		break;
	case "ajout":
	{
		myMkdirDossier($_POST['code_formation'] . "/" . $_POST['code_etape']);
		$voeuManager->insert(new Voeu($_POST['code_etape'], $_POST['code_formation'], $_POST['etape'], $_POST['responsable'], $_POST['mail_responsable']));

		$postSeDerouler = array(
			'ville' => $_POST['ville'],
			'responsable' => $_POST['responsable'],
			'mail_responsable' => $_POST['mail_responsable']
		);
		for ($i = 0; $i < count($postSeDerouler['ville']); ++$i) {
			$seDeroulerManager->insert(new SeDerouler($postSeDerouler['ville'][$i],
				$_POST['code_etape'],
				$postSeDerouler['responsable'][$i],
				$postSeDerouler['mail_responsable'][$i]));
		}
		header('location:index.php?uc=voeu&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	case "modifier":
	{
		$voeu = $voeuManager->find($_GET['codeEtape']);
		$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/modifierVoeu.html.twig', array('voeu' => $voeu, 'villes' => $villes, 'lesSeDerouler' => $lesSeDerouler, 'code' => $_GET['code']));
	}
		break;
	case "modification":
	{
		$voeu = $voeuManager->find($_POST['code_etape']);

		if (isset($_POST['ville']) && isset($_POST['responsable']) && isset($_POST['mail_responsable'])) {
			$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
			foreach ($lesSeDerouler as $unSeDerouler) {
				$seDeroulerManager->delete($unSeDerouler);
			}

			$postSeDerouler = array(
				'ville' => $_POST['ville'],
				'responsable' => $_POST['responsable'],
				'mail_responsable' => $_POST['mail_responsable']
			);
			for ($i = 0; $i < count($postSeDerouler['ville']); ++$i) {
				$seDeroulerManager->insert(new SeDerouler($postSeDerouler['ville'][$i],
					$_POST['code_etape'],
					$postSeDerouler['responsable'][$i],
					$postSeDerouler['mail_responsable'][$i]));
			}
		}

		$voeu->setEtape($_POST['etape']);
		$voeuManager->update($voeu);
		header('location:index.php?uc=voeu&action=consulter&codeEtape=' . $_POST['code_etape'] . '&code=' . $_POST['code']);
	}
		break;
	case "suppression":
	{
		$voeu = $voeuManager->find($_GET['codeEtape']);
		$voeuManager->delete($voeu);
		header('location:index.php?uc=voeu&action=grille&code=' . $voeu->getCodeFormation());
	}
		break;
	case "codeEtapePossible":
	{
		$q = $conn->prepare("SELECT IF(count(*) = 1, FALSE, TRUE) as ok FROM `voeu` WHERE `code_etape` = ?;");
		$q->execute(array($_POST['code']));
		$rs = $q->fetch();
		$response['response'] = $rs['ok'];
		echo json_encode($response);
	}
		break;
	case "deplacerVoeuDansDossier":
	{
		$voeu = $voeuManager->find($_POST['etape']);
		if (intval($_POST['dossierPdf']) === 0) {
			$voeu->setDossierPdf(NULL);
			$response['dossier'] = NULL;
		} else {
			$voeu->setDossierPdf(intval($_POST['dossierPdf']));
			$response['dossier'] = intval($_POST['dossierPdf']);
		}

		$response['response'] = $voeuManager->update($voeu);
		echo json_encode($response);
	}
		break;
	default:
		break;
}
