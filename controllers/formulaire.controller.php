<?php

/**
 * @Project: FEG Project
 * @File: /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author: 
 */
if (!isset($_GET['action'])) {
	$action = "formCandidat";
} else {
	$action = $_GET['action'];
}

$limitDate = "7 juin 2014";

switch ($action) {
	case "choixFormation": {
			echo $twig->render('formulaire/choixFormation.html.twig', array(
			));
		} break;
	case "informationsPersonnelles": {
			echo $twig->render('formulaire/informationsPersonnelles.html.twig', array(
				"limitDate" => $limitDate
			));
		} break;
	case "postBacExperiences": {
			echo $twig->render('formulaire/postBacExperiences.html.twig', array(
			));
		} break;
	case "choixVoeux": {
			echo $twig->render('formulaire/choixVoeux.html.twig', array(
			));
		} break;
	case "documentsGeneraux": {
			$documentsGeneraux = $documentGeneralManager->findAll();
			echo $twig->render('formulaire/documentsGeneraux.html.twig', array(
				"documentsGeneraux" => $documentsGeneraux
			));
		} break;
	case "informationsSpecifiques": {
			$formationTest = $formationManager->find('3BAS');
			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationTest));
			$form = $translatorStructureToForm->translate($structure);
			$formHTML = $form->getHTML();
			echo $twig->render('formulaire/informationsSpecifiques.html.twig', array('form' => $formHTML));
		} break;
	case "documentsSpecifiques": {
			$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation("BTM");
			echo $twig->render('formulaire/documentsSpecifiques.html.twig', array(
				"documentsSpecifique" => $documentsSpecifiques
			));
		} break;
	case "traiteInfoPerso": {
			var_dump($_POST);

			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$dateNaissance = $_POST["date_naissance"];
			$lieuNaissance = $_POST["lieu_naissance"];
			$nationalite = $_POST["nationalite"];
			$ine = $_POST["numero_ine"];
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

			$dossier = new Dossier($ine, "3BAS", $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $emploi, NULL, NULL);
			$dossierManager->insert($dossier);
		} break;
	case "traiteChoixSpe": {
			var_dump($_POST);
		} break;
	default: break;
}

