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

switch ($action) {
	case "main": {
			// Chargement des voeux
			$formation = $formationManager->find('3BAS');
			$voeux = $voeuManager->findAllByFormation($formation);
			foreach ($voeux as $voeu) {
				$voeu->setVilles($voeuManager->getVilles($voeu));
			}
			$nbVoeux = count($voeux);
			
			// Chargement des informations supplémentaires
			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formation));
			$form = $translatorStructureToForm->translate($structure);
			$formHTML = $form->getHTML();
			
			// Chargement des documents généraux et spécifiques
			$documentsGeneraux = $documentGeneralManager->findAll();
			$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation("3BAS");
			
			echo $twig->render('formulaire/mainFormulaire.html.twig', array(
				'voeux' => $voeux,
				'nbVoeux' => $nbVoeux,
				'form' => $formHTML,
				"documentsGeneraux" => $documentsGeneraux,
				"documentsSpecifique" => $documentsSpecifiques
			));
		} break;
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
			var_dump($cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus-1'], $_POST['anneeFinCursus-1'], $_POST['cursus-1'], $_POST['etablissement-1'], $_POST['valide-1'])));
			var_dump($cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus-2'], $_POST['anneeFinCursus-2'], $_POST['cursus-2'], $_POST['etablissement-2'], $_POST['valide-2'])));
			var_dump($cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus-3'], $_POST['anneeFinCursus-3'], $_POST['cursus-3'], $_POST['etablissement-3'], $_POST['valide-3'])));
			var_dump($cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus-4'], $_POST['anneeFinCursus-4'], $_POST['cursus-4'], $_POST['etablissement-4'], $_POST['valide-4'])));
			var_dump($cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $_POST['anneeDebutCursus-5'], $_POST['anneeFinCursus-5'], $_POST['cursus-5'], $_POST['etablissement-5'], $_POST['valide-5'])));

			var_dump($experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut-1'], $_POST['anneeDebut-1'], $_POST['moisFin-1'], $_POST['anneeFin-1'], $_POST['entreprise-1'], $_POST['fonction-1'])));
			var_dump($experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut-2'], $_POST['anneeDebut-2'], $_POST['moisFin-2'], $_POST['anneeFin-2'], $_POST['entreprise-2'], $_POST['fonction-2'])));
			var_dump($experienceManager->insert(new Experience(0, 'g11625159', '3BAS', $_POST['moisDebut-3'], $_POST['anneeDebut-3'], $_POST['moisFin-3'], $_POST['anneeFin-3'], $_POST['entreprise-3'], $_POST['fonction-3'])));
			//header('location:index.php?uc=formulaire&action=choixVoeux');
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
			$dossierManager->update($dossier);
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
	default: break;
}

