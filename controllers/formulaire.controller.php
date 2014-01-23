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
	case "informationsGenerales": {
			echo $twig->render('formulaire/informationsGenerales.html.twig');
		} break;
	case "postBacExperiences": {
			echo $twig->render('formulaire/postBacExperiences.html.twig', array(
			));
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
	case "traiterPostBacExperiences": {
			var_dump($_POST);

			$anneeDebut_1 = $_POST['anneeDebut-1'];
			$anneeFin_1 = $_POST['anneeFin-1'];
			$etablissement_1 = $_POST['etablissement-1'];
			$cursus_1 = $_POST['cursus-1'];
			$note_1 = $_POST['note-1'];
			$anneeDebut_2 = $_POST['anneeDebut-2'];
			$anneeFin_2 = $_POST['anneeFin-2'];
			$etablissement_2 = $_POST['etablissement-2'];
			$cursus_2 = $_POST['cursus-2'];
			$note_2 = $_POST['note-2'];
			$anneeDebut_3 = $_POST['anneeDebut-3'];
			$anneeFin_3 = $_POST['anneeFin-3'];
			$etablissement_3 = $_POST['etablissement-3'];
			$cursus_3 = $_POST['cursus-3'];
			$note_3 = $_POST['note-3'];
			$anneeDebut_4 = $_POST['anneeDebut-4'];
			$anneeFin_4 = $_POST['anneeFin-4'];
			$etablissement_4 = $_POST['etablissement-4'];
			$cursus_4 = $_POST['cursus-4'];
			$note_4 = $_POST['note-4'];
			$anneeDebut_5 = $_POST['anneeDebut-5'];
			$anneeFin_5 = $_POST['anneeFin-5'];
			$etablissement_5 = $_POST['etablissement-5'];
			$cursus_5 = $_POST['cursus-5'];
			$note_5 = $_POST['note-5'];
			$periode_1 = $_POST['periode-1'];
			$entreprise_1 = $_POST['entreprise-1'];
			$emploi_1 = $_POST['emploi-1'];
			$duree_1 = $_POST['duree-1'];
			$periode_2 = $_POST['periode-2'];
			$entreprise_2 = $_POST['entreprise-2'];
			$emploi_2 = $_POST['emploi-2'];
			$duree_2 = $_POST['duree-2'];
			$periode_3 = $_POST['periode-3'];
			$entreprise_3 = $_POST['entreprise-3'];
			$emploi_3 = $_POST['emploi-3'];
			$duree_3 = $_POST['duree-3'];

			$cursusManager->insert(new Cursus(0, 'g11625159', '3BAS', $anneeDebut, $anneeFin, $etablissement, $valide));
			//header('location:index.php?uc=formulaire&action=choixVoeux');
		} break;
	case "traiterChoixFormation": {
			$derniere = $_POST['derniere'];
			$souhaitee = $_POST['souhaitee'];

			echo $twig->render('formulaire/informationsGenerales.html.twig', array(
				"limitDate" => $limitDate
			));
		} break;
	case "traiterInformationsSpecifiques": {
			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationManager->find('3BAS')));
			$json = $translatorFormToJson->translate($structure, $_POST);
			$dossier = $dossierManager->findOneByFormation('g11625159', '3BAS');
			$dossier->setInformations($json);
			$dossierManager->update($dossier);
			header('location:index.php?uc=formulaire&action=documentsGeneraux');
		} break;
	case "traiteChoixVoeux": {
			var_dump($_POST['voeu']);
			$i = 1;
			foreach ($_POST['voeu'] as $codeEtape) {
				$faireManager->insert(new Faire($codeEtape, 'g11625159', '3BAS', $i));
				++$i;
			}
		} break;
	default: break;
}

