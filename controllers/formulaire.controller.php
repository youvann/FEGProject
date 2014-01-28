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
				'formation' => $formation,
				'voeux' => $voeux,
				'nbVoeux' => $nbVoeux,
				'form' => $formHTML,
				'documentsGeneraux' => $documentsGeneraux,
				'documentsSpecifique' => $documentsSpecifiques,
				'typedossier' => 'CA'
			));
		} break;

	case "informationsGenerales": {
			echo $twig->render('formulaire/informationsGenerales.html.twig');
		} break;
	case "traiterMainFormulaire": {
			var_dump($_POST);
			
			// Changer le code formation !!
			$dossier = new Dossier($_POST["ine"], '3BAS', $_POST["nom"], $_POST["prenom"], $_POST["adresse"], $_POST["complement"], $_POST["code_postal"], $_POST["ville"], $_POST["date_naissance"], $_POST["lieu_naissance"], $_POST["fixe"], $_POST["portable"], $_POST["mail"], $_POST["genre"], $_POST["langues"], $_POST["nationalite"], $_POST["serie_bac"], $_POST["annee_bac"], $_POST["etablissement_bac"], $_POST["departement_bac"], $_POST["pays_bac"], $_POST["activite"], $_POST["autre"], $_POST["titulaire"], $_POST["ville_preferee"], $_POST["autres_elements"], NULL, NULL);
			var_dump($dossier);

			if (!$etudiantManager->ifExists(new Etudiant($_POST["ine"], 1))) {
				$etudiantManager->insert(new Etudiant($_POST["ine"], 1));
			} else {
				$etudiant = $etudiantManager->find($_POST["ine"]);
				$nombreDepots = $etudiant->getNombreDepots();
				$nombreDepots = $nombreDepots + 1;
				$etudiantManager->update($etudiant);
			}
			$dossierManager->insert($dossier);

			$cursusManager->insert(new Cursus(0, $_POST["ine"], '3BAS', $_POST['anneeDebutCursus-1'], $_POST['anneeFinCursus-1'], $_POST['cursus-1'], $_POST['etablissement-1'], $_POST['valide-1']));
			$cursusManager->insert(new Cursus(0, $_POST["ine"], '3BAS', $_POST['anneeDebutCursus-2'], $_POST['anneeFinCursus-2'], $_POST['cursus-2'], $_POST['etablissement-2'], $_POST['valide-2']));
			$cursusManager->insert(new Cursus(0, $_POST["ine"], '3BAS', $_POST['anneeDebutCursus-3'], $_POST['anneeFinCursus-3'], $_POST['cursus-3'], $_POST['etablissement-3'], $_POST['valide-3']));
			$cursusManager->insert(new Cursus(0, $_POST["ine"], '3BAS', $_POST['anneeDebutCursus-4'], $_POST['anneeFinCursus-4'], $_POST['cursus-4'], $_POST['etablissement-4'], $_POST['valide-4']));
			$cursusManager->insert(new Cursus(0, $_POST["ine"], '3BAS', $_POST['anneeDebutCursus-5'], $_POST['anneeFinCursus-5'], $_POST['cursus-5'], $_POST['etablissement-5'], $_POST['valide-5']));

			$experienceManager->insert(new Experience(0, $_POST["ine"], '3BAS', $_POST['moisDebut-1'], $_POST['anneeDebut-1'], $_POST['moisFin-1'], $_POST['anneeFin-1'], $_POST['entreprise-1'], $_POST['fonction-1']));
			$experienceManager->insert(new Experience(0, $_POST["ine"], '3BAS', $_POST['moisDebut-2'], $_POST['anneeDebut-2'], $_POST['moisFin-2'], $_POST['anneeFin-2'], $_POST['entreprise-2'], $_POST['fonction-2']));
			$experienceManager->insert(new Experience(0, $_POST["ine"], '3BAS', $_POST['moisDebut-3'], $_POST['anneeDebut-3'], $_POST['moisFin-3'], $_POST['anneeFin-3'], $_POST['entreprise-3'], $_POST['fonction-3']));
			
			$i = 1;
			foreach ($_POST['voeu'] as $codeEtape) {
				$faireManager->insert(new Faire($codeEtape, $_POST["ine"], '3BAS', $i));
				++$i;
			}

			$structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationManager->find('3BAS')));
			$json = $translatorFormToJson->translate($structure, $_POST['elem-']);
			var_dump($json);
			$dossier = $dossierManager->find($_POST['ine'], '3BAS');
			$dossier->setInformations($json);
			$dossierManager->update($dossier);
		}
	default: break;
}

