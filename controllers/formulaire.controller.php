<?php

/**
 * @Project: FEG Project
 * @File: /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author: 
 */
if (!isset($_GET['action'])) {
	$action = "choixFormation";
} else {
	$action = $_GET['action'];
}

$limitDate = "7 juin 2014";

switch ($action) {
	case "choixFormation": {
			echo $twig->render('formulaire/choixFormation.html.twig', array(
			));
		} break;
	case "traiterChoixFormation": {
			$derniere = $_POST['derniere'];
			$souhaitee = $_POST['souhaitee'];

			echo $twig->render('formulaire/informationsGenerales.html.twig', array(
				"limitDate" => $limitDate
			));
		} break;
	case "informationsGenerales": {
			echo $twig->render('formulaire/informationsGenerales.html.twig');
		} break;
	case "traiterInfoPerso": {
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$codeFormation = '3BAS';
			$autre = $_POST['autre'];
			$dateNaissance = $_POST["date_naissance"];
			$lieuNaissance = $_POST["lieu_naissance"];
			$nationalite = $_POST["nationalite"];
			$ine = $_POST["ine"];
			$adresse = $_POST["adresse"];
			$complement = $_POST["complement"];
			$codePostal = $_POST["code_postal"];
			$ville = $_POST["ville"];
			$fixe = $_POST["fixe"];
			$portable = $_POST["portable"];
			$mail = $_POST["mail"];
			$serieBac = $_POST["serie_bac"];
			$anneeBac = $_POST["annee_bac"];
			$etablissementBac = $_POST["etablissement_bac"];
			$departementBac = $_POST["departement_bac"];
			$paysBac = $_POST["pays_bac"];
			$activite = $_POST["activite"];
			$titulaire = $_POST["titulaire"];
			$langues = $_POST["langues"];
			$autresElements = $_POST["autres_elements"];

			$dossier = new Dossier($ine, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $autresElements, NULL, NULL);
			if (!$etudiantManager->ifExists(new Etudiant($ine, 1))) {
				$etudiantManager->insert(new Etudiant($ine, 1));
			} else {
				$etudiant = $etudiantManager->find($ine);
				$nombreDepots = $etudiant->getNombreDepots();
				$nombreDepots = $nombreDepots + 1;
				$etudiantManager->update($etudiant);
			}
			$dossierManager->insert($dossier);
			header('location:index.php?uc=formulaire&action=postBacExperiences');
		} break;
	case "postBacExperiences": {
			echo $twig->render('formulaire/postBacExperiences.html.twig', array(
			));
		} break;
	case "traiterPostBacExperiences": {
			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus_1'], $_POST['anneeFinCursus_1'], $_POST['cursus_1'], $_POST['etablissement_1'], $_POST['valide_1']));
			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus_2'], $_POST['anneeFinCursus_2'], $_POST['cursus_2'], $_POST['etablissement_2'], $_POST['valide_2']));
			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus_3'], $_POST['anneeFinCursus_3'], $_POST['cursus_3'], $_POST['etablissement_3'], $_POST['valide_3']));
			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus_4'], $_POST['anneeFinCursus_4'], $_POST['cursus_4'], $_POST['etablissement_4'], $_POST['valide_4']));
			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus_5'], $_POST['anneeFinCursus_5'], $_POST['cursus_5'], $_POST['etablissement_5'], $_POST['valide_5']));

			$experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut_1'], $_POST['anneeDebut_1'], $_POST['moisFin_1'], $_POST['anneeFin_1'], $_POST['entreprise_1'], $_POST['fonction_1']));
			$experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut_2'], $_POST['anneeDebut_2'], $_POST['moisFin_2'], $_POST['anneeFin_2'], $_POST['entreprise_2'], $_POST['fonction_2']));
			$experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut_3'], $_POST['anneeDebut_3'], $_POST['moisFin_3'], $_POST['anneeFin_3'], $_POST['entreprise_3'], $_POST['fonction_3']));
			header('location:index.php?uc=formulaire&action=choixVoeux');
		} break;
	case "choixVoeux": {
			$formation = $formationManager->find('3BAS');
			$voeux = $voeuManager->findAllByFormation($formation);
			foreach ($voeux as $voeu) {
				$voeu->setVilles($voeuManager->getVilles($voeu));
			}
			$nbVoeux = count($voeux);
			echo $twig->render('formulaire/choixVoeux.html.twig', array(
				'voeux' => $voeux,
				'nbVoeux' => $nbVoeux
			));
		} break;
	case "traiteChoixVoeux": {
			$i = 1;
			foreach ($_POST['voeu'] as $codeEtape) {
				$faireManager->insert(new Faire($codeEtape, 'g11625159', '3BAS', $i));
				++$i;
			}
			header('location:index.php?uc=formulaire&action=informationsSpecifiques');
		} break;
	case "informationsSpecifiques": {
			$formationTest = $formationManager->find('3BAS');
			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationTest));
			$form = $translatorStructureToForm->translate($structure);
			$formHTML = $form->getHTML();
			echo $twig->render('formulaire/informationsSpecifiques.html.twig', array('form' => $formHTML));
		} break;
	case "traiterInformationsSpecifiques": {
			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationManager->find('3BAS')));
			$json = $translatorFormToJson->translate($structure, $_POST);
			$dossier = $dossierManager->find('g11625159', '3BAS');
			$dossier->setInformations($json);
			header('location:index.php?uc=formulaire&action=documentsGeneraux');
		} break;

	case "documentsGeneraux": {
			$documentsGeneraux = $documentGeneralManager->findAll();
			echo $twig->render('formulaire/documentsGeneraux.html.twig', array(
				"documentsGeneraux" => $documentsGeneraux
			));
		} break;
	case "traiteDocumentsGeneraux": {
			var_dump($_FILES['file']);
			//header('location:index.php?uc=formulaire&action=documentsGeneraux');
		} break;
	case "documentsSpecifiques": {
			$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation("3BAS");
			echo $twig->render('formulaire/documentsSpecifiques.html.twig', array(
				"documentsSpecifique" => $documentsSpecifiques
			));
		} break;


	case "traiteDocumentsSpecifiques": {
			var_dump($_FILES['file']);
			//header('location:index.php?uc=formulaire&action=documentsGeneraux');
		} break;
	case "testRessources": {
			$xml = simplexml_load_file('./ressources/ressources.xml');
			var_dump($xml);
		} break;
	default: break;
}

