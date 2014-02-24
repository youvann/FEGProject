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
        $idDossierPdf    = $_POST['choisie'];
        $dossierPdf      = $dossierPdfManager->find ($idDossierPdf);
        $codesFormations = $voeuManager->findAllByDossierPdf ($dossierPdf);
        $codeFormation   = $codesFormations[0]->getCodeFormation ();

        //$derniere                 = $_POST['derniere'];
        $_SESSION['idDossierPdf']  = $idDossierPdf;
        $_SESSION['codeFormation'] = $codeFormation;
        $_SESSION['idEtudiant']    = time ();

        header ('location:index.php?uc=formulaire&action=main');
    }
        break;
    case "displayDocuments":
    {
        FileHeader::headerJson ();
        $dossierPdf           = $dossierPdfManager->find ($_POST['idDossierPdf']);
        $documentsGeneraux    = $documentGeneralManager->findAll ();
        $documentsSpecifiques = $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf);

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
        $formation = $formationManager->find ($_SESSION['codeFormation']);

        $dossierPdf = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        $voeux      = $voeuManager->findAllByDossierPdf ($dossierPdf);

        foreach ($voeux as $voeu) {
            //$voeu->setVilles ($voeuManager->getVilles ($voeu));
        }
        $nbVoeux = count ($voeux);

        // Chargement des informations supplémentaires
        $structure = $translatorResultsetToStructure->translate ($informationManager->getResultset ($dossierPdf));
        $form      = $translatorStructureToForm->translate ($structure);
        $formHTML  = $form->getHTML ();

        // Chargement des documents généraux et spécifiques
        $documentsGeneraux    = $documentGeneralManager->findAll ();
        $documentsSpecifiques = $documentSpecifiqueManager->findAllByDossierPdf ($dossierPdf);

        echo $twig->render ('formulaire/mainFormulaire.html.twig', array ('dossierPdf' => $dossierPdf, 'formation' => $formation, 'voeux' => $voeux, 'nbVoeux' => $nbVoeux, 'form' => $formHTML, 'documentsGeneraux' => $documentsGeneraux, 'documentsSpecifique' => $documentsSpecifiques, 'typedossier' => 'CA'));
    }
        break;
    case "uploadDocuments" :
    {
        $_SESSION['nom']    = formatString ($_POST['nom']);
        $_SESSION['prenom'] = formatString ($_POST['prenom']);

        $_SESSION['voeu1'] = $_POST['voeu1'];
        $_SESSION['voeu2'] = $_POST['voeu2'];
        $_SESSION['voeu3'] = $_POST['voeu3'];

        // Chemin du répetoire qui contient le répertoire de l'étudiant
        $dirPath = "./dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/Candidatures";
        // Nom du répertoire de l'étudiant
        $dirNameId = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        myMkdirBase ($dirPath . "/" . $dirNameId . "/");
        upload ($dirPath . "/" . $dirNameId . "/");
    }
        break;
    case "traiterMainFormulaire":
    {
        //var_dump ($_POST, array_search ('ville_preferee', array_keys ($_POST)));
        //exit();
        // Récupère l'indice du champ qui se trouve juste avant les informations spécifiques, ici il s'agit de ville préférée
        $positionVillePreferee = 1;
        foreach ($_POST as $key => $value) {
            if ($key == "ville_preferee") {
                break;
            }
            $positionVillePreferee++;
        }

        $postInformations = array_slice ($_POST, $positionVillePreferee);
        $dossierPdf       = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        $structure        = $translatorResultsetToStructure->translate ($informationManager->getResultset ($dossierPdf));
        $json             = $translatorFormToJson->translate ($structure, $postInformations);

        $dateDeNaissance = $_POST['annee_date_naissance'] . "-" . $_POST["mois_date_naissance"] . "-" . $_POST["jour_date_naissance"];
        $dossier         = new Dossier($_SESSION['idEtudiant'], $_POST['ine'], $_POST["genre"], $_SESSION['codeFormation'], $_POST["autre"], formatString ($_POST["nom"]), formatString ($_POST["prenom"]), formatString ($_POST["adresse"]), $_POST["complement"], formatString ($_POST["code_postal"]), formatString ($_POST["ville"]), $dateDeNaissance, formatString ($_POST["lieu_naissance"]), $_POST["fixe"], $_POST["portable"], $_POST["mail"], formatString ($_POST["langues"]), formatString ($_POST["nationalite"]), $_POST["serie_bac"], $_POST["annee_bac"], formatString ($_POST["etablissement_bac"]), $_POST["departement_bac"], $_POST["pays_bac"], $_POST["activite"], $_POST["titulaire"], $_POST["ville_preferee"], formatString ($_POST["autres_elements"]), $json);
        $dossierManager->insert ($dossier);

        // Récupère tous les cursus
        $arrayCursus = array (); // Tableau à deux dimensions
        $i           = 0;
        foreach ($_POST['anneeDebutCursus'] as $anneeDebutCursus) {
            $arrayCursus['cursus-' . $i]['anneeDebutCursus'] = $anneeDebutCursus;
            $i++;
        }
        $i = 0;
        foreach ($_POST['anneeFinCursus'] as $anneeFinCursus) {
            $arrayCursus['cursus-' . $i]['anneeFinCursus'] = $anneeFinCursus;
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
        foreach ($_POST['cursus'] as $cursus) {
            $arrayCursus['cursus-' . $i]['cursus'] = $cursus;
            $i++;
        }
        foreach ($arrayCursus as $cursus) {
            // Ajout des cursus dans la table Cursus
            $cursusManager->insert (new Cursus(0, $_SESSION['idEtudiant'], $_SESSION['codeFormation'], $cursus['anneeDebutCursus'], $cursus['anneeFinCursus'], $cursus['cursus'], $cursus['etablissement'], $cursus['valide']));
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
        $dossier = $dossierManager->find ($_SESSION['idEtudiant'], $_SESSION['codeFormation']);

        $formation   = $formationManager->find ($_SESSION['codeFormation']);
        $titulaire   = $titulaireManager->findAll ();
        $cursus      = $cursusManager->findAllByDossier ($dossier);
        $experiences = $experienceManager->findAllByDossier ($dossier);
        //$faires          = $faireManager->findAllByDossier ($dossier);
        $etapes        = array ();
        $villePreferee = $dossier->getVillePreferee ();

        // Récupère les voeux par ordre croissant
        $faires = $faireManager->findAllByDossier ($dossier);
        $voeux  = array ();
        foreach ($faires as $faire) {
            $voeu                       = $voeuManager->find ($faire->getCodeEtape ());
            $voeu                       = $voeu->getEtape ();
            $voeux[$faire->getOrdre ()] = $voeu;
        }

        // Récupère les informations spécifiques
        /*
        $q = $conn->prepare ('SELECT `information`.`ID` as idInfo, `information`.`LIBELLE` as libelleInfo, `type`.`ID` as typeInfo, `choix`.`TEXTE` as libellesInfo
                            FROM `information`
                            INNER JOIN `type` ON (`information`.`TYPE` = `type`.`ID`)
                            LEFT JOIN `choix` ON (`information`.`ID` = `choix`.`INFORMATION`)
                            WHERE `information`.`CODE_FORMATION` = ?
                            ORDER BY `information`.`ORDRE`;');
        $q->execute (array ($formation->getCodeFormation ()));
        $rs = $q->fetchAll ();

        $structure               = $translatorResultsetToStructure->translate ($rs);
        $informationsSpecifiques = $translatorJsonToHTML->translate ($dossier->getInformations (), $structure);*/

        $informationsSpecifiques = "";

        require_once './classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("./classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");
        /*
         * En-tête du pdf
         */
        $pagePdf->setPagePdfHeaderImgPath ("./classes/Pdf/img/feg.png");
        $currentYear = date ('Y');
        $nextYear    = date ('Y');
        $nextYear++;
        $pagePdf->setPagePdfHeaderText ("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE " . $currentYear . "-" . $nextYear . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

        /*
         * Pied de page du pdf
         */
        $pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

        /*
         * Corps du pdf
         */
        $logoPath = "./public/img/logos/" . $formation->getCodeFormation ();
        $empty    = is_dir_empty ($logoPath);
        $logoName = $empty ? "" : getFileName ($logoPath);
        if (!$empty) {
            $pagePdf->setLogoPath ($logoPath . "/" . $logoName);
        } else {
            $pagePdf->setLogoPath ("");
        }

        // Mention de la formation
        $pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $formation->getMention ());
        $pagePdf->setHolder (' ' . $titulaire[0]->getLibelle (), ' ' . $titulaire[1]->getLibelle (), ' ' . $titulaire[2]->getLibelle (), $dossier->getTitulaire ());
        $pagePdf->setApplicant ($dossier->getGenre (), $dossier->getNom (), $dossier->getPrenom (), $dossier->getLieuNaissance (), $dossier->getDateNaissance (), $dossier->getIne (), $dossier->getAdresse () . ' ' . $dossier->getComplement () . ' ' . $dossier->getVille () . ' ' . $dossier->getCodePostal (), $dossier->getFixe (), $dossier->getPortable (), $dossier->getMail (), $dossier->getActivite ());
        $pagePdf->setPlanFormation ($voeux, $villePreferee);
        $pagePdf->setPrevFormation ($dossier->getSerieBac (), $dossier->getAnneeBac (), $dossier->getEtablissementBac (), $dossier->getDepartementBac (), $dossier->getPaysBac (), $cursus);
        $pagePdf->setProExperience ($experiences);
        $pagePdf->setOther ($dossier->getLangues (), $dossier->getAutresElements ());
        $pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

        $pagePdf->setDossierModalites ($formation->getModalites ());
        $pagePdf->setDossierInformations ($formation->getInformations ());

        $pagePdf->setCadreAdministrationVoeux (array ("voeux1", "voeux2"));
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

            $dirPath = "./dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/Candidatures";
            $dirName = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
            $html2pdf->Output ($dirPath . "/" . $dirName . '/Candidature-' . $dirName . '.pdf', 'F');
            echo "<script type='text/javascript'>document.location.replace('index.php?uc=formulaire&action=recapitulatif');</script>";

        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
        break;
    case "recapitulatif" :
    {
        $dirName = $_SESSION['nom'] . "-" . $_SESSION['prenom'] . "-" . $_SESSION['idEtudiant'];
        $dirPath = "./dossiers/" . $_SESSION['codeFormation'] . "/" . $_SESSION['voeu1'] . "/Candidatures";
        $pathPdf = $dirPath . "/" . $dirName . "/Candidature-" . $dirName;
        $dossierPdf = $dossierPdfManager->find ($_SESSION['idDossierPdf']);
        echo $twig->render ('formulaire/recapitulatif.html.twig', array ('dossierPdf' => $dossierPdf->getNom(), 'pathPdf' => $pathPdf));
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
    default:
        break;
}

