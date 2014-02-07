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

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "consulter": {
			$voeu = $voeuManager->find($_GET['codeetape']);
			$voeu->setVilles($voeuManager->getVilles($voeu));
			echo $twig->render('voeu/consulterVoeu.html.twig', array('voeu' => $voeu, 'code' => $_GET['code']));
		} break;
	case "grille": {
			$formation = $formationManager->find($_GET['code']);
			$voeux = $voeuManager->findAllByFormation($formation);
			echo $twig->render('voeu/grilleVoeu.html.twig', array('voeux' => $voeux, 'code' => $_GET['code']));
		} break;
	case "ajouter": {
			$villes = $villeManager->findAll();
			echo $twig->render('voeu/ajouterVoeu.html.twig', array('code' => $_GET['code'], 'villes' => $villes));
		} break;
	case "ajout": {
			$voeuManager->insert(new Voeu($_POST['code_etape'], $_POST['code_formation'], $_POST['etape'], $_POST['responsable'], $_POST['mailResponsable']));

			foreach ($_POST['villes'] as $ville) {
				$seDeroulerManager->insert(new SeDerouler($ville, $_POST['code_etape']));
			}
			header('location:index.php?uc=voeu&action=grille&code=' . $_POST['code_formation']);
		} break;
	case "modifier": {
			$voeu = $voeuManager->find($_GET['codeetape']);
			$voeu->setVilles($voeuManager->getVilles($voeu));
			$lesVilles = $villeManager->findAll();
			echo $twig->render('voeu/modifierVoeu.html.twig', array('voeu' => $voeu, 'lesvilles' => $lesVilles, 'code' => $_GET['code']));
		} break;
	case "modification": {
			$voeu = $voeuManager->find($_POST['code_etape']);
			$voeu->setEtape($_POST['etape']);
			$voeu->setResponsable($_POST['responsable']);
			
			//$voeuManager->update($voeu);
			$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
			
			foreach ($lesSeDerouler as $unSeDerouler) {
				$seDeroulerManager->delete($unSeDerouler);
			}
			
			foreach ($_POST['villes'] as $ville) {
				$seDeroulerManager->insert(new SeDerouler($ville, $voeu->getCodeEtape()));
			}
			header('location:index.php?uc=voeu&action=consulter&codeetape='.$_POST['code_etape'].'&code=' . $_POST['code_formation']);
		} break;
	case "suppression": {
			$voeu = $voeuManager->find($_GET['codeEtape']);
			$voeuManager->delete($voeu);
			header('location:index.php?uc=formation&action=grille' . $voeu->getCode());
		} break;
	case "codeEtapePossible": {
		$q = $conn->prepare("SELECT IF(count(*) = 1, FALSE, TRUE) as ok FROM `voeu` WHERE `code_etape` = ?;");
		$q->execute(array($_POST['code']));
		$rs = $q->fetch();
		$response['response'] = $rs['ok'];
		echo json_encode($response);
	} break;
	default: break;
}