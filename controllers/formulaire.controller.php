<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author : Lionel Guissani & Kévin Meas
 */
if (!isset($_GET['action'])) {
    $action = "choixFormation";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    // Cette action affiche le formulaire où l'étudiant choisi quelle formation
    // il veut postuler.
    case "choixFormation" :
    {
        // On récupère tous les voeux
        $voeux = $voeuManager->findAll ();
        // On récupère toutes les formations
        $formations = $formationManager->findAll ();
        // On récupère tous les dossiers pdf
        $dossiersPdf = $dossierPdfManager->findAll ();

        echo $twig->render ('formulaire/choixFormation.html.twig', array ('formations' => $formations, 'voeux' => $voeux, 'dossiersPdf' => $dossiersPdf));
    }
        break;
    // Cette action traite le formulaire de la page choixFormation.html.twig
    case "traiterChoixFormation":
    {
        // On récupère l'identifiant du dossier pdf
        $idDossierPdf = $_POST['choisie'];
        // On récupère le dossier pdf sous forme d'instance de DossierPdf grâce au manager
        $dossierPdf = $dossierPdfManager->find ($idDossierPdf);
        // Récupère le code la formation
        $codeFormation = $dossierPdf->getCodeFormation ();
        // La variable POST indique s'il s'agit d'une candidature ou d'une pré-inscription
        $_SESSION['isCandidature'] = ($_POST['derniere'] == '0') ? true : false;
        // Place l'identifiant du dossier PDF dans une variable SESSION
        $_SESSION['idDossierPdf'] = $idDossierPdf;
        // Place le code la formation dans une variable SESSION
        $_SESSION['codeFormation'] = $codeFormation;
        // Création de l'identifiant étudiant grâce à la fonction microtime()

        $microtime = microtime ();
	    $microtime = explode (' ', $microtime);
        // Place l'identifiant de l'étudiant dans une variable SESSION
        $_SESSION['idEtudiant'] = (int)substr ($microtime[1], 4) . substr ($microtime[0], 2, 4);
		header ('location:index.php?uc=formulaire&action=main');
    }
        break;
    case "domainesDeCompatibilite":
    {
        FileHeader::headerJson ();
        $response         = array ();
        $dossierPdf       = $dossierPdfManager->find ($_POST['idDossierPdf']);
        $dependances      = $dependreManager->findEtapes ($dossierPdf);
        $diplomes         = $diplomeManager->findAllByDossierPdf ($dossierPdf);
        $voeuxCompatibles = array ();
        foreach ($dependances as $dependance) {
            $voeuxCompatibles[] = $voeuManager->find ($dependance->getCodeEtape ());
        }

        foreach ($voeuxCompatibles as $voeuCompatible) {
            $voeu              = array ();
            $voeu['codeEtape'] = $voeuCompatible->getCodeEtape ();
            $voeu['etape']     = $voeuCompatible->getEtape ();
            $response[]        = $voeu;
        }

        foreach ($diplomes as $diplome) {
            $unDiplome              = array ();
            $unDiplome['codeEtape'] = $diplome->getId ();
            $unDiplome['etape']     = $diplome->getNom ();
            $response[]             = $unDiplome;
        }
        echo json_encode ($response);
    }
        break;
    // Cette action retourne les dossiers généraux et spécifiques en fonction
    // d'un dossier pdf au format JSON
    case "displayDocuments":
    {
        // On met comme entête de page le format JSON
        FileHeader::headerJson ();
        // On récupère le dossier pdf dont l'identifiant est passé en variable GET
        $dossierPdf = $dossierPdfManager->find ($_POST['idDossierPdf']);
        // On récupere les documents généraux et spécifiques adequats en fonction
        // du statut de postulation de l'étudiant (candidature ou préinscription)
        $documentsGeneraux    = ($_POST['preinscription'] === '1' ? $documentGeneralManager->findAllVisible () : $documentGeneralManager->findAll ());
        $documentsSpecifiques = ($_POST['preinscription'] === '1' ? $documentSpecifiqueManager->findAllByDossierPdfVisible ($dossierPdf) : $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf));

        // Ce tableau contiendra le JSON
        $response = array ();
        // Ce tableau contiendra les documents généraux adequats
        $general = array ();
        // Ce tableau contiendra les documents spécifiques adequats
        $specifique = array ();

        // Pour chaque document général, on ajoute son nom au JSON
        foreach ($documentsGeneraux as $documentGeneral) {
            $general[] = $documentGeneral->getNom ();
        }
        // Pour chaque document spécifique, on ajoute son nom au JSON
        foreach ($documentsSpecifiques as $documentSpecifique) {
            $specifique[] = array ($documentSpecifique->getNom (), $documentSpecifique->getUrl ());
        }
        // On ajoute la liste des documents généraux et spécifiques au conteneur
        $response['general']    = $general;
        $response['specifique'] = $specifique;
        // On affiche le JSON
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

        // Chargement des villes préférables
        $villesPreferables = $villeManager->findAllByDossierPdf ($dossierPdf);

        $typeDossier = ($_SESSION["isCandidature"]) ? "CA" : "PI";
        echo $twig->render ('formulaire/mainFormulaire.html.twig', array ('dossierPdf' => $dossierPdf, 'formation' => $formation, 'voeux' => $voeux, 'nbVoeux' => $nbVoeux, 'form' => $formHTML, 'villesPreferables' => $villesPreferables, 'documentsGeneraux' => $documentsGeneraux, 'documentsSpecifiques' => $documentsSpecifiques, 'typeDossier' => $typeDossier));
    }
        break;
    case "uploadDocuments" :
    {
        // Récupère le nom de l'étudiant depuis le formulaire
        $_SESSION['nom'] = formatString (stripAccents ($_POST['nom']));
        // Récupère le prénom de l'étudiant depuis le formulaire
        $_SESSION['prenom'] = formatString (stripAccents ($_POST['prenom']));

        // Récupère le voeu1
        $_SESSION['voeu1'] = $_POST['voeu1'];
        // Récupère le voeu2
        $_SESSION['voeu2'] = $_POST['voeu2'];
        // Récupère le voeu3
        $_SESSION['voeu3'] = $_POST['voeu3'];

        // S'agit-il d'un dossier de candidature ou de pré-inscription ?
        $typeDossier = ($_SESSION['isCandidature']) ? "Candidatures" : "Pre-inscriptions";

        // Chemin du répetoire qui contient le répertoire de l'étudiant
        $dirPath = "dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/" . $typeDossier;
        // Nom du répertoire de l'étudiant
        $dirNameId = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        // Création du répertoire de l'étudiant
        myMkdirBase ($dirPath . "/" . $dirNameId . "/");
        // Ajout des pièces à jointes dans le répertoire de l'étudiant
        upload ($dirPath . "/" . $dirNameId . "/");
    }
        break;
    case "traiterMainFormulaire":
    {
        // Détermine si le dossier est une candidature ou une pré-inscription
        $isCandidature = $_SESSION['isCandidature'];
        // Génère l'objet dossierPDf
        $dossierPdf    = $dossierPdfManager->find ($_SESSION['idDossierPdf']);

        // Récupère les données depuis le formulaire ($_POST)
        $idEtudiant    = $_SESSION['idEtudiant'];
        $ine           = $_POST['ine'];
        $genre         = $_POST["genre"];
        $codeFormation = $_SESSION['codeFormation'];
        $autre         = $_POST["autre"];
        $nom           = formatString ($_POST["nom"]);
        $prenom        = formatString ($_POST["prenom"]);
        $adresse       = formatString ($_POST["adresse"]);
        $complement    = $_POST["complement"];
        $codePostal    = formatString ($_POST["code_postal"]);
        $ville         = formatString ($_POST["ville"]);

        $naissanceArray  = $_POST["dateNaissance"];
        $naissanceArray  = explode ("/", $naissanceArray);
        $dateDeNaissance = $naissanceArray[2] . "-" . $naissanceArray[1] . "-" . $naissanceArray[0];

        $lieuNaissance    = formatString ($_POST["lieu_naissance"]);
        $fixe             = $_POST["fixe"];
        $portable         = $_POST["portable"];
        $mail             = $_POST["mail"];
        $langues          = isset($_POST['langues']) ? (($isCandidature) ? formatString (implode (', ', $_POST["langues"])) : "") : "";
        $nationalite      = formatString ($_POST["nationalite"]);
        $serieBac         = $_POST["serie_bac"];
        $anneeBac         = $_POST["annee_bac"];
        $etablissementBac = formatString ($_POST["etablissement_bac"]);
        $departementBac   = $_POST["departement_bac"];
        $paysBac          = $_POST["pays_bac"];
        $activite         = ($isCandidature) ? $_POST["activite"] : "";
        $titulaire        = $_POST["titulaire"];

        // Si la ville préférée existe ...
        if (isset($_POST["ville_preferee"])) {
            $laVillePreferee = ($villeManager->find ($_POST["ville_preferee"]));
            $villePreferee   = $laVillePreferee->getNom ();
        } else {
            $villePreferee = 'Non renseigné';
        }

        // Si c'est une candidature, on affiche les autres éléments
        // Si c'est une pré-inscriptions aucune opération n'est effectuée
        $autresElements = ($isCandidature) ? formatString ($_POST["autres_elements"]) : "";

        // Récupération des informations spécifiques
        $structure = $translatorResultsetToStructure->translate ($informationManager->getResultset ($dossierPdf));
        // Flag indique l'endroit où commence le cadre des informations spécifiques
        $json      = ($isCandidature) ? $translatorFormToJson->translate ($structure, array_slice ($_POST, array_search ('flag', array_keys ($_POST)) + 1)) : "";

        // Création d'un objet Dossier contenant toutes les informations que l'étudiant vient de rentrer dans le formulaire
        $dossier = new Dossier($idEtudiant, $ine, $genre, $codeFormation, $autre, $nom, $prenom, $adresse, $complement, $codePostal, $ville, $dateDeNaissance, $lieuNaissance, $fixe, $portable, $mail, $langues, $nationalite, $serieBac, $anneeBac, $etablissementBac, $departementBac, $paysBac, $activite, $titulaire, $villePreferee, $autresElements, $json);
        // Insertion du dossier dans la base de données
        $dossierManager->insert ($dossier);

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

        foreach ($arrayCursus as $cursus) {
            $anneeCursus      = explode ("-", $cursus['anneeCursus']);
            $anneeDebutCursus = $anneeCursus[0];
            $anneeFinCursus   = $anneeCursus[1];
            // Ajout des cursus dans la table Cursus
            $cursusManager->insert (new Cursus(0, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $anneeDebutCursus, $anneeFinCursus, $cursus['cursus'], $cursus['etablissement'], $cursus['note'], $cursus['valide']));
        }

        // Si les variables existent ...
        if (isset($_POST['moisDebut']) && isset($_POST['anneeDebut']) && isset($_POST['moisFin']) && isset($_POST['anneeFin']) && isset($_POST['entreprise']) && isset($_POST['fonction'])) {
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
        }

        $i = 1;
        foreach ($_POST['voeu'] as $codeEtape) {
            if ($codeEtape !== '2' && $codeEtape !== '3') {
                $faireManager->insert (new Faire($codeEtape, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $i));
                ++$i;
            }
        }

        /*
         * Génération dossier PDF
         */
        // Récupération des informations depuis la base de données en utilisant les managers
        $dossier       = $dossierManager->find ($_SESSION['idEtudiant'], $_SESSION['codeFormation']);
        $formation     = $formationManager->find ($_SESSION['codeFormation']);
        $titulaire     = $titulaireManager->findAll ();
        $cursus        = $cursusManager->findAllByDossierOrderedByAnneeFin ($dossier);
        $lastCursus    = $cursusManager->findLastDiplomaObtainedByDossier ($dossier);
        $experiences   = $experienceManager->findAllByDossierOrderedByAnneeFin ($dossier);
        $villePreferee = $dossier->getVillePreferee ();

        $codeFormation = $formation->getCodeFormation ();

        // Récupère les voeux/étapes par ordre croissant
        $faires      = $faireManager->findAllByDossier ($dossier);
        $codesEtapes = array ();
        $voeux       = array ();
        foreach ($faires as $faire) {
            $voeu                       = $voeuManager->find ($faire->getCodeEtape ());
            $voeu                       = $voeu->getEtape ();
            $voeux[$faire->getOrdre ()] = $voeu;
            $codesEtapes[]              = $faire->getCodeEtape ();
        }
        // Insertion des informations spécifiques s'il s'agit d'une candidature
        $informationsSpecifiques = ($_SESSION["isCandidature"]) ? $translatorJsonToHTML->translate ($json, $structure) : "";

        require_once 'classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

        /*
         * En-tête du pdf
         */
        // Détermine s'il s'agit d'une candidature ou d'une pré-inscription
        $typeDossier = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
        // Insertion du logo de la FEG
        $pagePdf->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");
        // Insertion du titre de l'en-tête du PDF
        $pagePdf->setPagePdfHeaderText ("DOSSIER DE " . strtoupper ($typeDossier) . "<br />ANNÉE UNIVERSITAIRE " . $anneeBasse . "-" . $anneeHaute . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

        /*
         * Pied de page du pdf
         */
        // Affichage des numéros de page du PDF
        $pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

        /*
         * Corps du pdf
         */
        // Chemin du logo du PDF
        $logoPath = "public/img/logos/" . $codeFormation;
        // Le répertoire contenant le logo du PDF est-il vide ?
        $empty    = is_dir_empty ($logoPath);
        // S'il est vide le nom du logo est vide sinon le nom du logo prend le nom du fichier contenu dans le répertoire
        $logoName = $empty ? "" : getFileName ($logoPath);
        if (!$empty) { // Répertoire non vide
            // On définit le chemin où se trouve le logo
            $pagePdf->setLogoPath ($logoPath . "/" . $logoName);
        } else { // Répertoire vide
            // Le chemin du logo est vide
            $pagePdf->setLogoPath ("");
        }

        // On indique s'il s'agit d'une candidature ou d'une pré-inscription
        $pagePdf->setIsCandidature ($_SESSION['isCandidature']);
        // Il ne s'agit pas d'une prévisualisation du PDF
        $pagePdf->setIsPrev (false);

        // Récupère la date de naissance du candidat
        $naissanceArray  = $dossier->getDateNaissance ();
        $naissanceArray  = explode ("-", $naissanceArray);
        $dateDeNaissance = $naissanceArray[2] . "/" . $naissanceArray[1] . "/" . $naissanceArray[0];

        // Récupère le nom du candidat
        $nom          = $dossier->getNom ();
        // Récupère le prénom du candidat
        $prenom       = $dossier->getPrenom ();
        // Récuppère le numéro d'inscription de l'étudiant
        $idEtudiant   = $dossier->getIdEtudiant ();
        $typeDossier  = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
        // Récupère l'identifiant du dossier PDF
        $idDossierPdf = $dossierPdf->getId ();

        // Indique l'URL des pièces manquantes
        $urlPiecesManquantes = "http://www.miage-aix-marseille.fr/candid_feg/index.php?uc=formulaire&action=uploadPiecesManquantes&idEtudiant=" . $idEtudiant . "&codeFormation=" . $codeFormation . "&typeDossier=" . $typeDossier . "&idDossierPdf=" . $idDossierPdf;

        // Mention de la formation
        $pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $dossierPdf->getNom ());
        // Détermine le titulaire
        $pagePdf->setHolder (' ' . $titulaire[0]->getLibelle (), ' ' . $titulaire[1]->getLibelle (), ' ' . $titulaire[2]->getLibelle (), $dossier->getTitulaire ());
        // Définit l'url des pièces manquantes
        $pagePdf->setUrlPiecesManquantes ($urlPiecesManquantes);
        // Définit le numéro d'inscription de l'étudiant
        $pagePdf->setNumInscription ($idEtudiant);
        // Définit les informations principales de l'étudiant
        $pagePdf->setApplicant ($dossier->getGenre (), $dossier->getNom (), $dossier->getPrenom (), $dossier->getLieuNaissance (), $dateDeNaissance, $dossier->getIne (), $dossier->getAdresse () . ' ' . $dossier->getComplement () . ' ' . $dossier->getVille () . ' ' . $dossier->getCodePostal (), $dossier->getFixe (), $dossier->getPortable (), $dossier->getMail (), $dossier->getActivite ());
        // Définit les voeux et la ville préférée de l'étudiant
        $pagePdf->setPlanFormation ($voeux, $villePreferee);
        // Définit les informations concernant le BAC et son cursus Post-bac
        $pagePdf->setPrevFormation ($dossier->getSerieBac (), $dossier->getAnneeBac (), $dossier->getEtablissementBac (), $dossier->getDepartementBac (), $dossier->getPaysBac (), $cursus);
        // Définit les expériences du candidat
        $pagePdf->setProExperience ($experiences);
        // Définit les langues étrangères et les autres éléments de l'étudiant
        $pagePdf->setOther ($dossier->getLangues (), $dossier->getAutresElements ());
        // Définit les informations spécifiques
        $pagePdf->setInformationsSpecifiques ($informationsSpecifiques);
        // Définit les modalités de la formation
        $pagePdf->setDossierModalites ($dossierPdf->getModalites ());
        // Définit les informations de la formation
        $pagePdf->setDossierInformations ($dossierPdf->getInformations ());

        // Définit les voeux présent dans le cadre de la commission pédagogique
        $pagePdf->setCadreAdministrationVoeux ($voeux);
        // Indique le dernier diplôme obtenu ou le BAC
        $pagePdf->setDernierDiplome ($lastCursus);
        // Indique que plusieurs voeux doivent apparaître sur la fiche de commission pédagogique
        $pagePdf->setVoeuxMultiple (true);
        // Indique que la ligne admin doit apparaître dans la fiche de commission pédagogique
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
            // Création du dossier PDF dans le premier voeu que l'étudiant a choisi
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
            header ('location:index.php?uc=formulaire&action=recapitulatif');

        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
        break;
    // Action qui dirige vers une page récapitulative
    case "recapitulatif" :
    {
        // Indique le type de dossier
        $typeDossier = ($_SESSION['isCandidature']) ? "Candidature" : "Pre-inscription";
        // Détermine le nom du répertoire
        $dirName     = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        // Détermine le chemin
        $dirPath     = "dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/" . $typeDossier . "s";
        // Détermine le chemin complet du PDF
        $pathPdf     = $dirPath . "/" . $dirName . "/" . $typeDossier . "-" . $dirName;
        $dossierPdf  = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        echo $twig->render ('formulaire/recapitulatif.html.twig', array ('dossierPdf' => $dossierPdf->getNom (), 'pathPdf' => $pathPdf, 'typeDossier' => $typeDossier, 'idEtudiant' => $_SESSION['idEtudiant'], 'codeFormation' => $_SESSION['codeFormation'], "idDossierPdf" => $_SESSION['idDossierPdf']));
    }
        break;
    // Cette action retourne un cadre Cursus pour le formulaire principal
    case "getTemplateCursus" :
    {
        echo $twig->render ('formulaire/template.cursus.html.twig', array ('indice' => $_GET['indice']));
    }
        break;
    // Cette action retourne un cadre Experience pour le formulaire principal
    case "getTemplateExperience" :
    {
        echo $twig->render ('formulaire/template.experience.html.twig', array ('indice' => $_GET['indice']));
    }
        break;
    // Cette action permet d'accèder à la vue qui sert à rajouter des pièces à joindre manquantes
    case "uploadPiecesManquantes" :
    {
        $idEtudiant    = $_GET['idEtudiant'];
        $codeFormation = $_GET['codeFormation'];
        $typeDossier   = $_GET['typeDossier'];
        $idDossierPdf  = $_GET['idDossierPdf'];

        $dossier = $dossierManager->find ($idEtudiant, $codeFormation);
        // Suppression des accents pour le nom
        $nom     = stripAccents ($dossier->getNom ());
        // Suppression des accents pour le prénom
        $prenom  = stripAccents ($dossier->getPrenom ());

        // Récupère le nom des voeux où l'étudiant a postulé
        $faires      = $faireManager->findAllByDossier ($dossier);
        $codesEtapes = array ();
        foreach ($faires as $faire) {
            $codesEtapes[] = $faire->getCodeEtape ();
        }

        $dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        $nomDossierPdf = $dossierPdf->getNom ();

        // Chargement des documents généraux et spécifiques
        $documentsGeneraux    = ($typeDossier == "candidature") ? $documentGeneralManager->findAll () : $documentGeneralManager->findAllVisible ();
        $documentsSpecifiques = ($typeDossier == "candidature") ? $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf) : $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf);

        echo $twig->render ('formulaire/uploadPiecesManquantes.html.twig', array ("nom" => $nom, "prenom" => $prenom, "idEtudiant" => $idEtudiant, "typeDossier" => $typeDossier, "codeFormation" => $codeFormation, "codesEtapes" => $codesEtapes, "nomDossierPdf" => $nomDossierPdf, "documentsGeneraux" => $documentsGeneraux, "documentsSpecifiques" => $documentsSpecifiques));
    }
        break;
    case "uploaderPiecesManquantes" :
    {
        $codeFormation = $_GET['codeFormation'];
        $nom           = $_GET['nom'];
        $prenom        = $_GET['prenom'];
        $idEtudiant    = $_GET['idEtudiant'];
        // La première lettre est transformée en majuscule
        $typeDossier   = ucfirst ($_GET['typeDossier']);

        // Obtention des voeux
        $voeux = array ();
        foreach ($_GET['voeu'] as $voeu) {
            $voeux[] = $voeu;
        }
        // Chemin du répetoire qui contient le répertoire de l'étudiant
        // Nom du répertoire de l'étudiant
        $dirNameId = $nom . "-" . $prenom . "-" . $idEtudiant;
        // Code formation
        $path1     = "dossiers/" . $codeFormation;
        // type du dossier + nom du répertoire de l'étudiant
        $path2     = $typeDossier . "s" . "/" . $dirNameId;
        // Upload des pièces jointes dans tous les répertoires voeux correspondants (upload multi destinations).
        uploadMultiLocations ($path1, $path2, $voeux);
    }
        break;
    default:
        break;
}

