<?php

/**
 * @Project: FEG Project
 * @File: /controllers/voeu.controller.php
 * @Purpose: Contrôleur de l'entité voeu
 * @Author: Lionel Guissani
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action amène à la vue qui permet de consulter un voeu
	case "consulter":
	{
		// On récupère le voeu grâce à son code passé par variable GET
		$voeu = $voeuManager->find($_GET['codeEtape']);
		// On récupère les villes où se déroule le voeu
		$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
		// On récupère toutes les villes
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/consulterVoeu.html.twig', array(
			'voeu' => $voeu,
			'villes' => $villes,
			'lesSeDerouler' => $lesSeDerouler,
			'code' => $_GET['code']));
	}
		break;
	// Cette action amène à la vue qui contient la liste des voeux sous forme de grille
	case "grille":
	{
		// On récupère la formation grâce à son code passé par variable GET
		$formation = $formationManager->find($_GET['code']);
		// On récupère les voeux proposés par la formation
		$voeux = $voeuManager->findAllByFormation($formation);
		echo $twig->render('voeu/grilleVoeu.html.twig', array('voeux' => $voeux, 'code' => $_GET['code']));
	}
		break;
	// Cette action amène à la vue qui permet d'ajoutter un voeu
	case "ajouter":
	{
		// On récupère tous les voeux existants
		$voeux = $voeuManager->findAll();
		// On récupère toutes les villes existantes
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/ajouterVoeu.html.twig', array('code' => $_GET['code'], 'voeux' => $voeux, 'villes' => $villes));
	}
		break;
	// Cette action ajoute un voeu en base données
	case "ajout":
	{
		// On crée le dossier physique du voeu
		myMkdirDossier($_POST['code_formation'] . "/" . $_POST['code_etape']);
		// On insère en base de données le voeu à travers le manager
		$voeuManager->insert(new Voeu(
			$_POST['code_etape'],
			$_POST['code_formation'],
			$_POST['etape'],
			$_POST['responsable'],
			$_POST['mail_responsable']));

		// On récupère les villes où se déroule le nouveau voeu avec
		// les noms/prénoms/adresses mail des responsables en fonction de la ville
		$postSeDerouler = array(
			'ville' => $_POST['ville'],
			'responsable' => $_POST['responsable'],
			'mail_responsable' => $_POST['mail_responsable']
		);
		// Pour chaque ville sélectionnée, on insère en base de données
		// une association entre le voeu et les villes où le voeu se
		// déroule en renseignant les noms/prénoms/adresses mail des responsables
		for ($i = 0; $i < count($postSeDerouler['ville']); ++$i) {
			$seDeroulerManager->insert(new SeDerouler($postSeDerouler['ville'][$i],
				$_POST['code_etape'],
				$postSeDerouler['responsable'][$i],
				$postSeDerouler['mail_responsable'][$i]));
		}
		// On se redirige vers la grille des voeux
		header('location:index.php?uc=voeu&action=grille&code=' . $_POST['code_formation']);
	}
		break;
	// Cette action amène à la vue qui permet de modifier un voeu
	case "modifier":
	{
		// On récupère le voeu grâce à son code passé par variable GET
		$voeu = $voeuManager->find($_GET['codeEtape']);
		// On récupère toutes les associations voeu/villes
		$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
		// On récupère toutes les villes
		$villes = $villeManager->findAll();
		echo $twig->render('voeu/modifierVoeu.html.twig', array(
			'voeu' => $voeu,
			'villes' => $villes,
			'lesSeDerouler' => $lesSeDerouler,
			'code' => $_GET['code']));
	}
		break;
	// Cette action modifie un voeu en base de données
	case "modification":
	{
		// On récupère le voeu grâce à son code passé par variable GET
		$voeu = $voeuManager->find($_POST['code_etape']);

		// On supprime les associations voeu/villes du voeu
		$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
		foreach ($lesSeDerouler as $unSeDerouler) {
			$seDeroulerManager->delete($unSeDerouler);
		}

		// Si des villes ont étés renseignées, on crée de nouvelles associations voeu/villes
		if (isset($_POST['ville']) && isset($_POST['responsable']) && isset($_POST['mail_responsable'])) {
			// On récupère les villes où se déroule le nouveau voeu avec
			// les noms/prénoms/adresses mail des responsables en fonction de la ville
			$postSeDerouler = array(
				'ville' => $_POST['ville'],
				'responsable' => $_POST['responsable'],
				'mail_responsable' => $_POST['mail_responsable']
			);
			// Pour chaque ville sélectionnée, on insère en base de données
			// une association entre le voeu et les villes où le voeu se
			// déroule en renseignant les noms/prénoms/adresses mail des responsables
			for ($i = 0; $i < count($postSeDerouler['ville']); ++$i) {
				$seDeroulerManager->insert(new SeDerouler($postSeDerouler['ville'][$i],
					$_POST['code_etape'],
					$postSeDerouler['responsable'][$i],
					$postSeDerouler['mail_responsable'][$i]));
			}
		}
		// On modifie la mention du voeu
		$voeu->setEtape($_POST['etape']);
		// On met à jour le voeu à travers le manager
		$voeuManager->update($voeu);
		header('location:index.php?uc=voeu&action=consulter&codeEtape=' . $_POST['code_etape'] . '&code=' . $_POST['code']);
	}
		break;
	// Cette action supprime un voeu en base de données
	case "suppression":
	{
		// On récupère le voeu grâce à son code passé par variable GET
		$voeu = $voeuManager->find($_GET['codeEtape']);
		// On supprime le voeu à travers le manager
		$voeuManager->delete($voeu);
		// On se redirige vers la grille des voeux
		header('location:index.php?uc=voeu&action=grille&code=' . $voeu->getCodeFormation());
	}
		break;
	// Cette action est destinée à être appelée par une requête AJAX,
	// elle retourne une expression régulière de la forme ^((?!BAS301)(?!BAS302).)*$
	// Un nouveau voeu ne pourra par avoir un code interdit par la regex
	case "codeEtapePossible":
	{
		// On met comme entête de page du texte brut
		FileHeader::headerTextPlain();
		// On récupère tous les voeux existants
		$voeux = $voeuManager->findAll();
		// On crée l'expression réguliere
		echo '^(';
		foreach ($voeux as $voeu) {
			echo '(?!'.$voeu->getCodeEtape().')';
		}
		echo '.)*$';
	}
		break;
	// Cette action amène à la vue qui permet de consulter un voeu
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
