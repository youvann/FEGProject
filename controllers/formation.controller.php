<?php
/**
 * @Project: FEG Project
 * @File   : /controllers/formation.controller.php
 * @Purpose: Ce contrôleur gère l'entité Formation
 *           Il également permet de prévisualiser les dossiers PDF
 *           Ajouter et supprimer le logo de la formation
 *           Générer la synthèse CSV
 * @Author : Lionel Guissani & Kévin Meas
 */
if (!isset($_GET['action'])) {
	$action = "grille";
} else {
	$action = $_GET['action'];
}

switch ($action) {
	// Cette action permet de consulter les informations d'une formation
	case "consulter":
	{
		// On récupère la formation dont le code est passé par variable GET
		$formation = $formationManager->find ($_GET['code']);
		// On récupère toutes les facultés
		$facultes  = $faculteManager->findAll ();
		echo $twig->render ('formation/consulterFormation.html.twig', array ('formation' => $formation, 'facultes' => $facultes));
	}
		break;
	// Cette action permet de consulter la liste des formations sous forme de grille
	case "grille":
	{
		// On récupère toutes les formations
		$formations = $formationManager->findAll ();
		echo $twig->render ('formation/grilleFormation.html.twig', array ('formations' => $formations));
	}
		break;
	// Cette action permet d'accéder au formulaire d'ajout d'une formation
	case "ajouter":
	{
		// On récupère toutes les formations
		$formations = $formationManager->findAll ();
		echo $twig->render ('formation/ajouterFormation.html.twig', array ('formations' => $formations));
	}
		break;
	// Cette action ajoute une formation en base de données
	case "ajout":
	{
		// Création du répertoire "code_formation"
		myMkdirBase ("dossiers/" . $_POST['code_formation']);
		// Création du répertoire code_formation/Dossier-type
		myMkdirBase ("dossiers/" . $_POST['code_formation'] . "/Dossier-type");
        // Création du répertoire pour le logo
        myMkdirBase ("public/img/logos/" . $_POST['code_formation']);
		// On insère la formation en base de données à travers le manager
		$formationManager->insert (new Formation($_POST['code_formation'], $_POST['mention'], $_POST['faculte']));
		header ('location:index.php?uc=formation&action=grille');
	}
		break;
	// Cette action permet d'accéder au formulaire de modification d'une formation
	case "modifier":
	{
		// On récupère toutes les facultés
		$facultes  = $faculteManager->findAll ();
		// On récupère la formation dont le code est passé par variable GET
		$formation = $formationManager->find ($_GET['code']);
		echo $twig->render ('formation/modifierFormation.html.twig', array ('facultes' => $facultes, 'formation' => $formation));
	}
		break;
	// Cette action modifie une formation en base de données
	case "modification":
	{
		// On récupère la formation dont le code est passé par variable GET
		$formation = new Formation($_POST['code_formation'], $_POST['mention'], $_POST['faculte']);
		// On la met à jour à travers le manager
		$formationManager->update ($formation);
		header ('location:index.php?uc=formation&action=grille');
	}
		break;
	// Cette action supprime une formation en base de données
	case "suppression":
	{
		// On récupère la formation dont le code est passé par variable GET
		$formation = $formationManager->find ($_GET['code']);
		// On la supprime à travers le manager
		$formationManager->delete ($formation);
		header ('location:index.php?uc=formation&action=grille');
	}
		break;
	// Cette action renvoie une expression régulière pour que l'utilisateur
	// ne puisse pas rentrer 2 fois le même code formation
	case "codeFormationPossible":
	{
		// On met comme entête de fichier du texte dur
		FileHeader::headerTextPlain();
		// On récupère toutes les formations existantes
		$formations = $formationManager->findAll();
		// On construit l'expression régulière avec
		// les codes formation
		echo '^(';
		foreach ($formations as $formation) {
			echo '(?!'.$formation->getCodeFormation().')';
		}
		echo '.)*$';
	}
		break;
	// Cette action retourne la synthèse au format CSV des inscriptions
	case "syntheseCsv":
	{
		ini_set('memory_limit', '1024M');
		// On crée le nom du fichier CSV avec son chemin complet
		// pour qu'il soit dans la formation souhaitée
        $csvFileName = 'dossiers/' . $_GET['code'] . '/Synthese.csv';
		// Si le fichier existe déjà, on le supprime
        if (file_exists ($csvFileName)) {
            unlink ($csvFileName);
        }

		$codeFormation = $_GET['code'];
		$formation = $formationManager->find($codeFormation);

		$dossiers = $dossierManager->findAllByFormation($formation);

        $csv = fopen ($csvFileName, 'w');
		// On insère l'entête du fichier CSV
        fputcsv ($csv, array (
	        utf8_decode ('Num INE'),
	        utf8_decode ('Nom'),
	        utf8_decode ('Prénom'),
	        utf8_decode ('Mail'),
	        utf8_decode ('Fixe'),
	        utf8_decode ('Portable'),
	        utf8_decode ('Date de naissance'),
	        utf8_decode ('Dernier cursus'),
	        utf8_decode ('Formation choisie'),
	        utf8_decode ('Premier voeu'),
	        utf8_decode ('Année du BAC')), ';');

		foreach($dossiers as $dossier) {

			$faires = $faireManager->findAllByDossier($dossier);


			$ine = $dossier->getIne();
			$nom = $dossier->getNom();
			$prenom = $dossier->getPrenom();
			$mail = $dossier->getMail();
			$fixe = $dossier->getFixe();
			$portable = $dossier->getPortable();
			$dateDeNaissance = date("d/m/Y", strtotime($dossier->getDateNaissance()));
			$dernierCursus = "";
			$formationChoisie = "";
			if (count($faires) > 0) {
				$codeVoeu = $faires[0]->getCodeEtape();
				$voeu = $voeuManager->find($codeVoeu);

				$premierVoeu = $voeu->getEtape();
			} else {
				$premierVoeu = "Non renseigné";
			}
			$anneeDuBac = $dossier->getAnneeBac();

			// Pour chaque ligne du résultat de la requête, on l'insère dans le fichier CSV
			fputcsv ($csv, array (
				utf8_decode($ine),
				utf8_decode ($nom),
				utf8_decode ($prenom),
				$mail,
				$fixe,
				$portable,
				utf8_decode ($dernierCursus),
				utf8_decode ($dateDeNaissance),
				utf8_decode ($dernierCursus), $formationChoisie, $premierVoeu), ';');

		}

		// On ferme le fichier CSV
        fclose ($csv);

        echo $twig->render ('formation/syntheseCsv.html.twig', array ('code' => $_GET['code']));
	}
		break;
    // Cette action permet d'accèder à la vue HTML qui permet de prévisualiser le dossier PDF
	case "previsualiserPdf":
	{
        // Récupère l'ID du dossier PDF
		$idDossierPdf  = $_GET['idDossierPdf'];
        // Récupère le type de PDF que l'on souhaite générer : Candidature ou Pré-inscritpion
		$typePdf       = $_GET['typePdf'];
        // Récupère le bon objet dossier PDF
		$dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        // Récupère le nom du dossier PDF
		$nomDossierPdf = $dossierPdf->getNom ();
        // Récupère le code la formation
		$codeFormation = $dossierPdf->getCodeFormation ();
        // Si c'est une candidature la $type = "Candidature" sinon $type = "Pre-inscription"
		$type          = ($typePdf == "candidature") ? "Candidature" : "Pre-inscription";

		echo $twig->render ('formation/previsualiserPdfFormation.html.twig', array (
			'codeFormation' => $codeFormation,
			'typePdf'       => $type,
			'nomDossierPdf' => $nomDossierPdf
		));
	}
		break;
    // Génère le dossier PDF de prévisualisation
	case "previsualisationPdf":
	{
        // Récupère l'ID du dossier PDF
		$idDossierPdf  = $_GET['idDossierPdf'];
        // Récupère le type de PDF que l'on souhaite générer : Candidature ou Pré-inscritpion
        $typePdf       = $_GET['typePdf'];
        // Récupère le bon objet dossier PDF
		$dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        // Récupère les informations
		$informations  = $informationManager->findAllByDossierPdf($dossierPdf);
        // Récupère code de la formation
		$codeFormation = $dossierPdf->getCodeFormation ();
        // Récupère le bon objet formation
		$formation     = $formationManager->find ($codeFormation);
		$type          = ($typePdf == "candidature") ? "Candidature" : "Pre-inscription";
		$typeBool      = ($typePdf == "candidature") ? true : false;
        
        $titulaire     = $titulaireManager->findAll();

        $dateLimite = $dateLimiteManager->findAllByDossierPdf($dossierPdf);

        $arrayDateLimite = array ();
        foreach ($dateLimite as $date) {
            $dateTemp          = $typeBool ? explode ("-", $date->getDateCandidature ()) : explode ("-", $date->getDatePreinscription ());
            $arrayDateLimite[] = $dateTemp[2] . "/" . $dateTemp[1] . "/" . $dateTemp[0];
        }

		// Récupère tous les voeux du dossier PDF
		$voeux  = $voeuManager->findAllByDossierPdf ($dossierPdf);
		$etapes = array ();
		$cpt = 1;
		for ($i = 0; $i < count($voeux); $i++) {
            // On n'affiche que 3 voeux maximum
            //if($i < 3){
                $etapes[$cpt++] = $voeux[$i]->getEtape ();
            //}
		}

		require_once 'classes/Pdf/PagePdf.class.php';
        // Créé un nouveau PDF
		$pagePdf = new PagePdf("classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

		/*
		 * En-tête du pdf
		 */
        // Insertion du logo de la FEG
		$pagePdf->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");
        // Insertion du titre de l'en-tête du PDF
		$pagePdf->setPagePdfHeaderText ("DOSSIER DE " . strtoupper($type) . "<br />ANNÉE UNIVERSITAIRE " . $anneeBasse . "-" . $anneeHaute . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

		/*
		 * Pied de page du pdf
		 */
        // Affichage des numéros de page du PDF
		$pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

		/*
		 * Corps du pdf
		 */
        // Chemin du logo du PDF
		$logoPath = "public/img/logos/" . $formation->getCodeFormation ();
        // Le répertoire contenant le logo du PDF est-il vide ?
		$empty    = is_dir_empty ($logoPath);
        // S'il est vide le nom du logo est vide sinon le nom du logo prend le nom du fichier contenu dans le répertoire
		$logoName = $empty ? "" : getFileName ($logoPath);
		if (!$empty) {// Répertoire pas vide
            // On définit le chemin où se trouve le logo
			$pagePdf->setLogoPath ($logoPath . "/" . $logoName);
		} else { // Répertoire vide
            // Le chemin du logo est vide
			$pagePdf->setLogoPath ("");
		}

        // On indique s'il s'agit d'une candidature ou d'une pré-inscription
		$pagePdf->setIsCandidature($typeBool);
        // Il s'agit d'une prévisualisation du PDF
		$pagePdf->setIsPrev(true);
        // Défintion du nom de la formation
		$pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $dossierPdf->getNom ());
        // 4 = on affiche tous les diplômes pour la prévisualisation
        $pagePdf->setHolder($titulaire[0]->getLibelle(), $titulaire[1]->getLibelle (), $titulaire[2]->getLibelle (), 4);
        $pagePdf->setDateLimite($arrayDateLimite);
        // Aucune formation prévue n'est ajouté
		$pagePdf->setPlanFormation ($etapes, "");
        // Aucune expérience n'est ajouté
		$pagePdf->setProExperience (array ());

        // Création d'un tableau qui récupère les informations spécifiques
		$informationsSpecifiques = array ();

        // Création d'un tableau contenant les types des informations spécifiques (ex : checkbox, radiobox ...)
		$typeInformations        = array ();
		foreach ($informations as $information) {
			$informationsSpecifiques[] = $information->getLibelle ();
			$typeInformations[]        = $information->getType ();
		}
        // Définit les types d'informations spécifiques
		$pagePdf->setTypeInformations($typeInformations);
        // Définit les informations spécifiques
		$pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

        // Définit les voeux figurant dans le cadre d'administration
		$pagePdf->setCadreAdministrationVoeux ($etapes);

        // Définit les informations préalables
        if($typeBool){
            $pagePdf->setInformationsPrealablesDossier($dossierPdf->getInformationsPrealablesCandidature());
        }else{
            $pagePdf->setInformationsPrealablesDossier($dossierPdf->getInformationsPrealablesPreinscription());
        }

        // Définit les modalités
		$pagePdf->setDossierModalites ($dossierPdf->getModalites ());
        // Définit les informations liées à la formation
		$pagePdf->setDossierInformations ($dossierPdf->getInformationsGenerales());

        // Indique que l'on veut voir apparaître plusieurs voeux
		$pagePdf->setVoeuxMultiple (true);
        // Indique qu'il faut fait apparaître la ligne administration
		$pagePdf->setRowAdmin (true);

		ob_start ();
		echo $pagePdf;
		$content = ob_get_clean ();

		// convert in PDF
		require_once 'classes/Pdf/html2pdf/html2pdf.class.php';
		try {
			$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array (12, 10, 10, 10));
			$html2pdf->setDefaultFont ('arial');
			$html2pdf->pdf->SetDisplayMode ('fullpage');
			$html2pdf->writeHTML ($content, isset($_GET['vuehtml']));
            // Création du PDF dans le répertoire Dossier-type
			$html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier-type/' . $type . '-' . $dossierPdf->getNom () . '.pdf', 'F');
		} catch (HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
		break;
    // Affiche la vue qui sert à gérer le logo du dossier PDF
	case 'logoDossierPdf' :
	{
        // Récupère le code de la formation
		$code     = $_GET['code'];
        // Récupère la mention de la formation
		$mention  = $_GET['mention'];
        // Récupère le chemin du logo
		$logoPath = "public/img/logos/" . $code;
        // Indique si le répertoire est vide ou non
		$empty    = is_dir_empty ($logoPath);
		$logoName = $empty ? "" : getFileName ($logoPath);

		echo $twig->render ('formation/logoDossierPdf.html.twig', array ('code' => $code, 'empty' => $empty, 'logoName' => $logoName, 'mention' => $mention));
	}
		break;
    // Sert à supprimer le logo du dossier PDF
	case 'suppressionLogo' :
	{
        // Récupère le code de la formation
		$code         = $_GET['code'];
        // Récupère le nom du logo
		$logoName     = $_GET['logoName'];
        // Récupère le chemin du logo
		$logoPathName = "public/img/logos/" . $code . "/" . $logoName;
        // Supprime le logo
		unlink ($logoPathName);
	}
		break;
    // Permet d'ajouter un nouveau logo
	case 'uploadLogo' :
	{
        // Récupère le code la formation
		$code = $_GET['code'];
        // Ajout du nouveau logo
		upload ('public/img/logos/' . $code . '/');
	}
		break;
	default:
		break;
}
