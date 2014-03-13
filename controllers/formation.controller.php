<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/formation.controller.php
 * @Purpose: Ce contrôleur gère l'entité Formation
 * @Author : Lionel Guissani
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
			echo '(?!'.$formation->getCodFormation().')';
		}
		echo '.)*$';
	}
		break;
	// Cette action retourne la synthèse au format CSV des inscriptions
	case "syntheseCsv":
	{
		// On crée le nom du fichier CSV avec son chemin complet
		// pour qu'il soit dans la formation souhaitée
        $csvFileName = 'dossiers/' . $_GET['code'] . '/Synthese.csv';
		// Si le fichier existe déjà, on le supprime
        if (file_exists ($csvFileName)) {
            unlink ($csvFileName);
        }
		// On prépare la requête
        $q = $conn->prepare ("SELECT DISTINCT d.`ID_ETUDIANT` `INE`, d.`NOM`, `PRENOM`, `MAIL`,
								CONCAT(`FIXE`, '/', `PORTABLE`) as TEL,
								CONCAT(DAY(`DATE_NAISSANCE`), '/', MONTH(`DATE_NAISSANCE`), '/', YEAR(`DATE_NAISSANCE`)) as DATE_NAISSANCE,
								`CURSUS` as DERNIER_CURSUS, dp.`NOM` as DOSSIER_PDF_NOM, `ETAPE` as PREMIER_VOEU, `ANNEE_BAC`
								FROM `dossier` d
									INNER JOIN `cursus` c1 ON d.`ID_ETUDIANT` = c1.`ID_ETUDIANT`
									INNER JOIN `faire` f ON d.`ID_ETUDIANT` = f.`ID_ETUDIANT`
									INNER JOIN `voeu` v ON f.`CODE_ETAPE` = v.`CODE_ETAPE`
									INNER JOIN `dossier_pdf` dp ON v.`DOSSIER_PDF` = dp.`ID`
								WHERE `ANNEE_FIN` = (SELECT MAX(`ANNEE_FIN`) FROM `cursus` c2 WHERE c2.`ID_ETUDIANT` = c1.`ID_ETUDIANT`)
								AND f.`ORDRE` = 1 AND dp.`CODE_FORMATION` = ?
								GROUP BY d.`ID_ETUDIANT`;");
		// On execute la requête
        $q->execute (array ($_GET['code']));
		// On récupère le résultat sous forme de tableau statistique
        $rs = $q->fetchAll ();
		// On crée le nouveau fichier CSV en écriture
        $csv = fopen ($csvFileName, 'w');
		// On insère l'entête du fichier CSV
        fputcsv ($csv, array ('INE', 'Nom', utf8_decode ('Prénom'), 'MAIL', utf8_decode ('Téléphone'), 'Date de naissance', 'Dernier cursus', 'Formation choisie', 'Premier voeu', utf8_decode ('Année du BAC')), ';');
		// Pour chaque ligne du résultat de la requête, on l'insère dans le fichier CSV
        foreach ($rs as $row) {
            fputcsv ($csv, array ($row['INE'], utf8_decode ($row['NOM']), utf8_decode ($row['PRENOM']), $row['MAIL'], $row['TEL'], $row['DATE_NAISSANCE'], utf8_decode ($row['DERNIER_CURSUS']), utf8_decode ($row['DOSSIER_PDF_NOM']), utf8_decode ($row['PREMIER_VOEU']), $row['ANNEE_BAC'],), ';');
        }
		// On ferme le fichier CSV
        fclose ($csv);

        echo $twig->render ('formation/syntheseCsv.html.twig', array ('code' => $_GET['code']));
	}
		break;
	case "previsualiserPdf":
	{
		$idDossierPdf = $_GET['idDossierPdf'];
		$typePdf      = $_GET['typePdf'];
		$dossierPdf   = $dossierPdfManager->find ($idDossierPdf);

		$nomDossierPdf = $dossierPdf->getNom ();
		$codeFormation = $dossierPdf->getCodeFormation ();
		$type          = ($typePdf == "candidature") ? "Candidature" : "Pre-inscription";

		echo $twig->render ('formation/previsualiserPdfFormation.html.twig', array (
			'codeFormation' => $codeFormation,
			'typePdf' => $type,
			'nomDossierPdf' => $nomDossierPdf
		));
	}
		break;
	case "previsualisationPdf":
	{
		$idDossierPdf  = $_GET['idDossierPdf'];
		$typePdf       = $_GET['typePdf'];
		$dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
		$informations = $informationManager->findAllByDossierPdf($dossierPdf);

		$codeFormation = $dossierPdf->getCodeFormation ();
		$formation     = $formationManager->find ($codeFormation);
		$type          = ($typePdf == "candidature") ? "Candidature" : "Pre-inscription";
		$typeBool      = ($typePdf == "candidature") ? true : false;


		// Récupère tous les voeux du dossier PDF
		$voeux  = $voeuManager->findAllByDossierPdf ($dossierPdf);
		$etapes = array ();
		$cpt = 1;
		for ($i = 0; $i < count($voeux); $i++) {
            if($i < 3){
                $etapes[$cpt++] = $voeux[$i]->getEtape ();
            }
		}

		require_once 'classes/Pdf/PagePdf.class.php';
		$pagePdf = new PagePdf("classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

		/*
		 * En-tête du pdf
		 */
		$pagePdf->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");
		$pagePdf->setPagePdfHeaderText ("DOSSIER DE " . strtoupper($type) . "<br />ANNÉE UNIVERSITAIRE " . $anneeBasse . "-" . $anneeHaute . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

		/*
		 * Pied de page du pdf
		 */
		$pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

		/*
		 * Corps du pdf
		 */
		$logoPath = "public/img/logos/" . $formation->getCodeFormation ();
		$empty    = is_dir_empty ($logoPath);
		$logoName = $empty ? "" : getFileName ($logoPath);
		if (!$empty) {
			$pagePdf->setLogoPath ($logoPath . "/" . $logoName);
		} else {
			$pagePdf->setLogoPath ("");
		}

		$pagePdf->setIsCandidature($typeBool);
		$pagePdf->setIsPrev(true);
		$pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $dossierPdf->getNom ());
		$pagePdf->setPlanFormation ($etapes, "");
		$pagePdf->setProExperience (array ());

		$informationsSpecifiques = array ();
		$typeInformations        = array ();
		foreach ($informations as $information) {
			$informationsSpecifiques[] = $information->getLibelle ();
			$typeInformations[]        = $information->getType ();
		}
		$pagePdf->setTypeInformations($typeInformations);
		$pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

		$pagePdf->setCadreAdministrationVoeux ($etapes);

		$pagePdf->setDossierModalites ($dossierPdf->getModalites ());
		$pagePdf->setDossierInformations ($dossierPdf->getInformations ());

		$pagePdf->setVoeuxMultiple (true);
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
			$html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier-type/' . $type . '-' . $dossierPdf->getNom () . '.pdf', 'F');
		} catch (HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
		break;
	case 'logoDossierPdf' :
	{
		$code     = $_GET['code'];
		$mention  = $_GET['mention'];
		$logoPath = "public/img/logos/" . $code;
		$empty    = is_dir_empty ($logoPath);
		$logoName = $empty ? "" : getFileName ($logoPath);

		echo $twig->render ('formation/logoDossierPdf.html.twig', array ('code' => $code, 'empty' => $empty, 'logoName' => $logoName, 'mention' => $mention));
	}
		break;
	case 'suppressionLogo' :
	{
		$code         = $_GET['code'];
		$logoName     = $_GET['logoName'];
		$logoPathName = "public/img/logos/" . $code . "/" . $logoName;
		unlink ($logoPathName);
	}
		break;
	case 'uploadLogo' :
	{
		$code = $_GET['code'];
		upload ('public/img/logos/' . $code . '/');
	}
		break;
	default:
		break;
}
