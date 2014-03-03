<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author :
 */
if (!isset($_GET['action'])) {
    $action = "choixFormation";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "candidaturePossible" :
    {
        $q = $conn->prepare ("SELECT if(count(*) = 0, true, false) as possible FROM `dossier` WHERE `dossier`.`INE` = ? and `dossier`.`CODE_FORMATION` = ?;");
        $q->execute (array ($_POST['ine'], $_POST['code_formation']));
        $rs = $q->fetch ();

        $response['response'] = $rs['possible'];
        echo json_encode ($response);
    }
        break;
    case "typeDossier" :
    {
        FileHeader::headerJson ();
        $q = $conn->prepare ("SELECT IF(count(*), 'PI', 'CA') as type FROM `dependre` WHERE `CODE_ETAPE_MERE` = ? AND `CODE_FORMATION_FILLE` = ?;");
        $q->execute (array ($_POST['code_etape'], $_POST['code_formation']));
        $rs               = $q->fetch ();
        $response['type'] = $rs['type'];
        echo json_encode ($response);
    }
        break;
    case "choixFormation" :
    {
        $voeux       = $voeuManager->findAll ();
        $formations  = $formationManager->findAll ();
        $dossiersPdf = $dossierPdfManager->findAll ();

        echo $twig->render ('formulaire/choixFormation.html.twig', array ('formations' => $formations, 'voeux' => $voeux, 'dossiersPdf' => $dossiersPdf));
    }
        break;
    case "traiterChoixFormation":
    {
        // Récupère le code formation choisi grâce à l'id du dossier pdf
        $idDossierPdf  = $_POST['choisie'];
        $dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        $codeFormation = $dossierPdf->getCodeFormation ();

        $_SESSION['isCandidature'] = ($_POST['derniere'] === "") ? true : false;
        $_SESSION['idDossierPdf']  = $idDossierPdf;
        $_SESSION['codeFormation'] = $codeFormation;
        $_SESSION['idEtudiant']    = time ();

        header ('location:index.php?uc=formulaire&action=main');
    }
        break;
	case "domainesDeCompatibilite":
	{
		FileHeader::headerJson ();
		$response = array();
		$dossierPdf = $dossierPdfManager->find($_POST['idDossierPdf']);
		$dependances = $dependreManager->findEtapes($dossierPdf);
		$diplomes = $diplomeManager->findAllByDossierPdf($dossierPdf);
		$voeuxCompatibles = array();
		foreach($dependances as $dependance) {
			$voeuxCompatibles[] = $voeuManager->find($dependance->getCodeEtape());
		}

		foreach($voeuxCompatibles as $voeuCompatible) {
			$voeu = array();
			$voeu['codeEtape'] = $voeuCompatible->getCodeEtape();
			$voeu['etape'] = $voeuCompatible->getEtape();
			$response[] = $voeu;
		}

		foreach($diplomes as $diplome) {
			$unDiplome = array();
			$unDiplome['codeEtape'] = $diplome->getId();
			$unDiplome['etape'] = $diplome->getNom();
			$response[] = $unDiplome;
		}
		echo json_encode($response);
	}
		break;
    case "displayDocuments":
    {
        FileHeader::headerJson ();
        $dossierPdf           = $dossierPdfManager->find ($_POST['idDossierPdf']);
        $documentsGeneraux    = ($_POST['preinscription'] === '1' ? $documentGeneralManager->findAllVisible() : $documentGeneralManager->findAll());
        $documentsSpecifiques = ($_POST['preinscription'] === '1' ? $documentSpecifiqueManager->findAllByDossierPdfVisible($dossierPdf) : $documentSpecifiqueManager->findAllByDossierPdf($dossierPdf));

        $response   = array ();
        $general    = array ();
        $specifique = array ();

        foreach ($documentsGeneraux as $documentGeneral) {
            $general[] = $documentGeneral->getNom ();
        }
        foreach ($documentsSpecifiques as $documentSpecifique) {
            $specifique[] = array ($documentSpecifique->getNom (), $documentSpecifique->getUrl ());
        }
        $response['general']    = $general;
        $response['specifique'] = $specifique;
        echo (json_encode ($response));
    }
        break;
    case "main":
    {
        // Chargement des voeux
        $formation  = $formationManager->find ($_SESSION['codeFormation']);
        $dossierPdf = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        $voeux      = $voeuManager->findAllByDossierPdf ($dossierPdf);
        $nbVoeux    = count ($voeux);

        // Chargement des informations supplémentaires
        $structure = $translatorResultsetToStructure->translate ($informationManager->getResultset ($dossierPdf));
        $form      = $translatorStructureToForm->translate ($structure);
        $formHTML  = $form->getHTML ();

        // Chargement des documents généraux et spécifiques
        $documentsGeneraux    = ($_SESSION['isCandidature']) ? $documentGeneralManager->findAll () : $documentGeneralManager->findAllVisible ();
        $documentsSpecifiques = ($_SESSION['isCandidature']) ? $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf) : $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf);

        $typeDossier = ($_SESSION["isCandidature"]) ? "CA" : "PI";
        echo $twig->render ('formulaire/mainFormulaire.html.twig', array ('dossierPdf' => $dossierPdf, 'formation' => $formation, 'voeux' => $voeux, 'nbVoeux' => $nbVoeux, 'form' => $formHTML, 'documentsGeneraux' => $documentsGeneraux, 'documentsSpecifiques' => $documentsSpecifiques, 'typeDossier' => $typeDossier));
    }
        break;
    case "uploadDocuments" :
    {
        $_SESSION['nom']    = formatString ($_POST['nom']);
        $_SESSION['prenom'] = formatString ($_POST['prenom']);

        $_SESSION['voeu1'] = $_POST['voeu1'];
        $_SESSION['voeu2'] = $_POST['voeu2'];
        $_SESSION['voeu3'] = $_POST['voeu3'];

        $typeDossier = ($_SESSION['isCandidature']) ? "Candidatures" : "Pre-inscriptions";

        // Chemin du répetoire qui contient le répertoire de l'étudiant
        $dirPath = "dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/" . $typeDossier;
        // Nom du répertoire de l'étudiant
        $dirNameId = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        myMkdirBase ($dirPath . "/" . $dirNameId . "/");
        upload ($dirPath . "/" . $dirNameId . "/");
    }
        break;
	case "traiterMainFormulaire":
	{
		$isCandidature    = $_SESSION['isCandidature'];
		$dossierPdf       = $dossierPdfManager->find ($_SESSION['idDossierPdf']);

		$idEtudiant       = $_SESSION['idEtudiant'];
		$ine              = $_POST['ine'];
		$genre            = $_POST["genre"];
		$codeFormation    = $_SESSION['codeFormation'];
		$autre            = $_POST["autre"];
		$nom              = formatString ($_POST["nom"]);
		$prenom           = formatString ($_POST["prenom"]);
		$adresse          = formatString ($_POST["adresse"]);
		$complement       = $_POST["complement"];
		$codePostal       = formatString ($_POST["code_postal"]);
		$ville            = formatString ($_POST["ville"]);

		$naissanceArray   = $_POST["dateNaissance"];
		$naissanceArray   = explode ("/", $naissanceArray);
		$dateDeNaissance  = $naissanceArray[2] . "-" . $naissanceArray[1] . "-" . $naissanceArray[0];

		$lieuNaissance    = formatString ($_POST["lieu_naissance"]);
		$fixe             = $_POST["fixe"];
		$portable         = $_POST["portable"];
		$mail             = $_POST["mail"];
		$langues          = ($isCandidature) ? formatString ($_POST["langues"]) : "";
		$nationalite      = formatString ($_POST["nationalite"]);
		$serieBac         = $_POST["serie_bac"];
		$anneeBac         = $_POST["annee_bac"];
		$etablissementBac = formatString ($_POST["etablissement_bac"]);
		$departementBac   = $_POST["departement_bac"];
		$paysBac          = $_POST["pays_bac"];
		$activite         = ($isCandidature) ? $_POST["activite"] : "";
		$titulaire        = $_POST["titulaire"];
		$villePreferee    = $_POST["ville_preferee"];
		$autresElements   = ($isCandidature) ? formatString ($_POST["autres_elements"]) : "";

		$structure        = $translatorResultsetToStructure->translate ($informationManager->getResultset ($dossierPdf));
		$json             = ($isCandidature) ? $translatorFormToJson->translate ($structure, array_slice ($_POST, array_search ('ville_preferee', array_keys ($_POST)) + 1)) : "";

		$dossier          = new Dossier($idEtudiant, $ine, $genre, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateDeNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $villePreferee, $autresElements, $json);
		$dossierManager->insert ($dossier);

        //var_dump($_POST);

		// Récupère tous les cursus
		$arrayCursus = array (); // Tableau à deux dimensions
		$i           = 0;
		foreach ($_POST['anneeCursus'] as $anneeCursus) {
			$arrayCursus['cursus-' . $i]['anneeCursus'] = $anneeCursus;
			$i++;
		}
		$i = 0;
		foreach ($_POST['etablissement'] as $etablissement) {
			$arrayCursus['cursus-' . $i]['etablissement'] = $etablissement;
			$i++;
		}
		$i = 0;
		foreach ($_POST['valide'] as $valide) {
			$arrayCursus['cursus-' . $i]['valide'] = $valide;
			$i++;
		}
        $i = 0;
        foreach ($_POST['note'] as $note) {
            $arrayCursus['cursus-' . $i]['note'] = $note;
            $i++;
        }
		$i = 0;
		foreach ($_POST['cursus'] as $cursus) {
			$arrayCursus['cursus-' . $i]['cursus'] = $cursus;
			$i++;
		}

        var_dump($arrayCursus);
		foreach ($arrayCursus as $cursus) {
			$anneeCursus = explode("-", $cursus['anneeCursus']);
			$anneeDebutCursus = $anneeCursus[0];
			$anneeFinCursus = $anneeCursus[1];
			// Ajout des cursus dans la table Cursus
			$cursusManager->insert (new Cursus(0, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $anneeDebutCursus, $anneeFinCursus, $cursus['cursus'], $cursus['etablissement'], $cursus['note'], $cursus['valide']));
		}

		// Récupère toutes les expériences
		$arrayExperiences = array (); // Tableau à deux dimensions
		$i                = 0;
		foreach ($_POST['moisDebut'] as $anneeFin) {
			$arrayExperiences['experience-' . $i]['moisDebut'] = $anneeFin;
			$i++;
		}
		$i = 0;
		foreach ($_POST['anneeDebut'] as $anneeDebut) {
			$arrayExperiences['experience-' . $i]['anneeDebut'] = $anneeDebut;
			$i++;
		}
		$i = 0;
		foreach ($_POST['moisFin'] as $moisFin) {
			$arrayExperiences['experience-' . $i]['moisFin'] = $moisFin;
			$i++;
		}
		$i = 0;
		foreach ($_POST['anneeFin'] as $anneeFin) {
			$arrayExperiences['experience-' . $i]['anneeFin'] = $anneeFin;
			$i++;
		}
		$i = 0;
		foreach ($_POST['entreprise'] as $entreprise) {
			$arrayExperiences['experience-' . $i]['entreprise'] = $entreprise;
			$i++;
		}
		$i = 0;
		foreach ($_POST['fonction'] as $fonction) {
			$arrayExperiences['experience-' . $i]['fonction'] = $fonction;
			$i++;
		}
		foreach ($arrayExperiences as $experience) {
			$experienceManager->insert (new Experience(0, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $experience['moisDebut'], $experience['anneeDebut'], $experience['moisFin'], $experience['anneeFin'], $experience['entreprise'], $experience['fonction']));
		}

		$i = 1;
		foreach ($_POST['voeu'] as $codeEtape) {
			$faireManager->insert (new Faire($codeEtape, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $i));
			++$i;
		}

		/*
		 * Génération dossier PDF
		 */
		$dossier       = $dossierManager->find ($_SESSION['idEtudiant'], $_SESSION['codeFormation']);
		$formation     = $formationManager->find ($_SESSION['codeFormation']);
		$titulaire     = $titulaireManager->findAll ();
		$cursus        = $cursusManager->findAllByDossierOrderedByAnneeFin($dossier);
		$experiences   = $experienceManager->findAllByDossierOrderedByAnneeFin ($dossier);
		$villePreferee = $dossier->getVillePreferee ();

		$codeFormation = $formation->getCodeFormation ();

		// Récupère les voeux par ordre croissant
		$faires = $faireManager->findAllByDossier ($dossier);
		$codesEtapes = array();
		$voeux  = array ();
		foreach ($faires as $faire) {
			$voeu                       = $voeuManager->find ($faire->getCodeEtape ());
			$voeu                       = $voeu->getEtape ();
			$voeux[$faire->getOrdre ()] = $voeu;
			$codesEtapes[] = $faire->getCodeEtape();
		}
		$informationsSpecifiques =  ($_SESSION["isCandidature"]) ? $translatorJsonToHTML->translate ($json, $structure) : "";

		require_once 'classes/Pdf/PagePdf.class.php';
		$pagePdf = new PagePdf("classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

		/*
		 * En-tête du pdf
		 */
		$typeDossier = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
		$pagePdf->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");
		$pagePdf->setPagePdfHeaderText ("DOSSIER DE " . strtoupper($typeDossier) . "<br />ANNÉE UNIVERSITAIRE " . $anneeBasse . "-" . $anneeHaute . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

		/*
		 * Pied de page du pdf
		 */
		$pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

		/*
		 * Corps du pdf
		 */
		$logoPath = "public/img/logos/" . $codeFormation;
		$empty    = is_dir_empty ($logoPath);
		$logoName = $empty ? "" : getFileName ($logoPath);
		if (!$empty) {
			$pagePdf->setLogoPath ($logoPath . "/" . $logoName);
		} else {
			$pagePdf->setLogoPath ("");
		}

		$pagePdf->setIsCandidature ($_SESSION['isCandidature']);
		$pagePdf->setIsPrev (false);

		$naissanceArray  = $dossier->getDateNaissance ();
		$naissanceArray  = explode ("-", $naissanceArray);
		$dateDeNaissance = $naissanceArray[2] . "/" . $naissanceArray[1] . "/" . $naissanceArray[0];

		$nom          = $dossier->getNom ();
		$prenom       = $dossier->getPrenom ();
		$idEtudiant   = $dossier->getIdEtudiant ();
		$typeDossier  = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
		$idDossierPdf = $dossierPdf->getId ();

		$urlPiecesManquantes = "http://www.miage-aix-marseille.fr/candid_feg/index.php?uc=formulaire&action=uploadPiecesManquantes&idEtudiant=".$idEtudiant."&codeFormation=".$codeFormation."&typeDossier=".$typeDossier."&idDossierPdf=".$idDossierPdf;

		// Mention de la formation
		$pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $dossierPdf->getNom ());
		$pagePdf->setHolder (' ' . $titulaire[0]->getLibelle (), ' ' . $titulaire[1]->getLibelle (), ' ' . $titulaire[2]->getLibelle (), $dossier->getTitulaire ());
		$pagePdf->setUrlPiecesManquantes($urlPiecesManquantes);
		$pagePdf->setNumInscription($idEtudiant);
		$pagePdf->setApplicant ($dossier->getGenre (), $dossier->getNom (), $dossier->getPrenom (), $dossier->getLieuNaissance (), $dateDeNaissance, $dossier->getIne (), $dossier->getAdresse () . ' ' . $dossier->getComplement () . ' ' . $dossier->getVille () . ' ' . $dossier->getCodePostal (), $dossier->getFixe (), $dossier->getPortable (), $dossier->getMail (), $dossier->getActivite ());
		$pagePdf->setPlanFormation ($voeux, $villePreferee);
		$pagePdf->setPrevFormation ($dossier->getSerieBac (), $dossier->getAnneeBac (), $dossier->getEtablissementBac (), $dossier->getDepartementBac (), $dossier->getPaysBac (), $cursus);
		$pagePdf->setProExperience ($experiences);
		$pagePdf->setOther ($dossier->getLangues (), $dossier->getAutresElements ());
		$pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

		$pagePdf->setDossierModalites ($dossierPdf->getModalites ());
		$pagePdf->setDossierInformations ($dossierPdf->getInformations ());

		$pagePdf->setCadreAdministrationVoeux ($voeux);
        $pagePdf->setDernierDiplome("Dernier diplome essai");
		$pagePdf->setVoeuxMultiple (true);
		$pagePdf->setRowAdmin (true);

		ob_start ();
		echo $pagePdf;
		$content = ob_get_clean ();

		// convert in PDF
		require_once 'classes/Pdf/html2pdf/html2pdf.class.php';
		try {
			$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array (12, 10, 10, 10));
			//$html2pdf->setModeDebug();
			$html2pdf->setDefaultFont ('arial');
			$html2pdf->pdf->SetDisplayMode ('fullpage');
			$html2pdf->writeHTML ($content, isset($_GET['vuehtml']));

			$dirPath = "dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/" . $typeDossier . "s";
			$dirName = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
			$html2pdf->Output ($dirPath . "/" . $dirName . '/' . $typeDossier . '-' . $dirName . '.pdf', 'F');

			// Copie du répertoire correspondant au voeu n°1 dans les deux autres répertoires
			foreach ($faires as $faire) {
				if ($faire->getOrdre () != 1) {
					myMkdirBase ("dossiers/" . $_SESSION['codeFormation'] . "/" . $faire->getCodeEtape () . "/" . $typeDossier . "s/" . $dirName);
					$source      = $dirPath . "/" . $dirName;
					$destination = "dossiers/" . $_SESSION['codeFormation'] . "/" . $faire->getCodeEtape () . "/" . $typeDossier . "s/" . $dirName;
					copyDir ($source, $destination);
				}
			}
			//echo "<script type='text/javascript'>document.location.replace('index.php?uc=formulaire&action=recapitulatif');</script>";
            header ('location:index.php?uc=formulaire&action=recapitulatif');

		} catch (HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
		break;
    case "recapitulatif" :
    {
        $typeDossier = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
        $dirName = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        $dirPath = "dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/" . $typeDossier . "s";
        $pathPdf = $dirPath . "/" . $dirName . "/" . $typeDossier . "-" . $dirName;
        $dossierPdf = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        echo $twig->render ('formulaire/recapitulatif.html.twig', array ('dossierPdf' => $dossierPdf->getNom(), 'pathPdf' => $pathPdf, 'typeDossier' => $typeDossier, 'idEtudiant' => $_SESSION['idEtudiant'], 'codeFormation' => $_SESSION['codeFormation'], "idDossierPdf" => $_SESSION['idDossierPdf']));
    }
        break;
    case "getTemplateCursus" :
    {
        echo $twig->render ('formulaire/template.cursus.html.twig', array ('indice' => $_GET['indice']));
    }
        break;
    case "getTemplateExperience" :
    {
        echo $twig->render ('formulaire/template.experience.html.twig', array ('indice' => $_GET['indice']));
    }
        break;
    case "uploadPiecesManquantes" :
    {
        $idEtudiant    = $_GET['idEtudiant'];
        $codeFormation = $_GET['codeFormation'];
        $typeDossier   = $_GET['typeDossier'];
        $idDossierPdf  = $_GET['idDossierPdf'];

        $dossier       = $dossierManager->find ($idEtudiant, $codeFormation);
        $nom           = $dossier->getNom ();
        $prenom        = $dossier->getPrenom ();

        $faires        = $faireManager->findAllByDossier ($dossier);
        $codesEtapes   = array ();
        foreach ($faires as $faire) {
            $codesEtapes[] = $faire->getCodeEtape ();
        }

        $dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        $nomDossierPdf = $dossierPdf->getNom ();

        // Chargement des documents généraux et spécifiques
        $documentsGeneraux    = ($typeDossier == "candidature") ? $documentGeneralManager->findAll () : $documentGeneralManager->findAllVisible ();
        $documentsSpecifiques = ($typeDossier == "candidature") ? $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf) : $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf);

        echo $twig->render ('formulaire/uploadPiecesManquantes.html.twig', array (
            "nom" => $nom,
            "prenom" => $prenom,
            "idEtudiant" => $idEtudiant,
            "typeDossier" => $typeDossier,
            "codeFormation" => $codeFormation,
            "codesEtapes" => $codesEtapes,
            "nomDossierPdf" => $nomDossierPdf,
            "documentsGeneraux" => $documentsGeneraux,
            "documentsSpecifiques" => $documentsSpecifiques
        ));
    }
        break;
    case "uploaderPiecesManquantes" :
    {
        $codeFormation = $_GET['codeFormation'];
        $nom           = $_GET['nom'];
        $prenom        = $_GET['prenom'];
        $idEtudiant    = $_GET['idEtudiant'];
        $typeDossier   = ucfirst ($_GET['typeDossier']);

        $voeux = array();
        foreach($_GET['voeu'] as $voeu){
            $voeux[] = $voeu;
        }
        // Chemin du répetoire qui contient le répertoire de l'étudiant
        //$dirPath = "dossiers/" . $codeFormation . "/" . $voeux[0] . "/" . $typeDossier . "s";
        // Nom du répertoire de l'étudiant
        $dirNameId = $nom . "-" . $prenom . "-" . $idEtudiant;
        $path1 = "dossiers/" . $codeFormation;
        $path2 = $typeDossier . "s" . "/" . $dirNameId;
        uploadMultiLocations ($path1, $path2, $voeux);
    }
        break;
    default:
        break;
}

