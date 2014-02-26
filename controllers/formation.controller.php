<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/formation.controller.php
 * @Purpose:
 * @Author :
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "consulter":
    {
        $formation = $formationManager->find ($_GET['code']);
        $facultes  = $faculteManager->findAll ();
        echo $twig->render ('formation/consulterFormation.html.twig', array ('formation' => $formation, 'facultes' => $facultes));
    }
        break;
    case "grille":
    {
        $formations = $formationManager->findAll ();
        echo $twig->render ('formation/grilleFormation.html.twig', array ('formations' => $formations));
    }
        break;
    case "ajouter":
    {
        $facultes = $faculteManager->findAll ();
        echo $twig->render ('formation/ajouterFormation.html.twig', array ('facultes' => $facultes));
    }
        break;
    case "ajout":
    {
        // Création du répertoire "code_formation"
        myMkdirBase ("dossiers/" . $_POST['code_formation']);
        // Création du répertoire code_formation/Dossier-type
        myMkdirBase ("dossiers/" . $_POST['code_formation'] . "/Dossier-type");
        $formationManager->insert (new Formation($_POST['code_formation'], $_POST['mention'], $_POST['informations'], $_POST['modalites'], $_POST['faculte']));
        header ('location:index.php?uc=formation&action=grille');
    }
        break;
    case "modifier":
    {
        $facultes  = $faculteManager->findAll ();
        $formation = $formationManager->find ($_GET['code']);
        echo $twig->render ('formation/modifierFormation.html.twig', array ('facultes' => $facultes, 'formation' => $formation));
    }
        break;
    case "modification":
    {
        $formation = new Formation($_POST['code_formation'], $_POST['mention'], $_POST['informations'], $_POST['modalites'], $_POST['faculte']);
        $formationManager->update ($formation);
        header ('location:index.php?uc=formation&action=grille');
    }
        break;
    case "suppression":
    {
        $formation = $formationManager->find ($_GET['code']);
        $formationManager->delete ($formation);
        header ('location:index.php?uc=formation&action=grille');
    }
        break;
    case "codeFormationPossible":
    {
        $q = $conn->prepare ("SELECT IF(count(*) = 1, FALSE, TRUE) as ok FROM `formation` WHERE `code_formation` = ?;");
        $q->execute (array ($_POST['code']));
        $rs                   = $q->fetch ();
        $response['response'] = $rs['ok'];
        echo json_encode ($response);
    }
        break;
    case "dependances":
    {
        $dossierPdf  = $dossierPdfManager->find ($_GET['dossierPdf']);
        $dependances = $dependreManager->findEtapes ($dossierPdf);

        $formations       = $formationManager->findAll ();
        $voeux            = $voeuManager->findAll ();
        $voeuxCompatibles = array ();
        foreach ($dependances as $dependance) {
            $voeuxCompatibles[] = $voeuManager->find ($dependance->getCodeEtape ());
        }

        echo $twig->render ('formation/dependances.html.twig', array ('dossierPdf' => $dossierPdf, 'formations' => $formations, 'voeuxCompatibles' => $voeuxCompatibles, 'voeux' => $voeux));
    }
        break;
    case "modificationDependances":
    {
        $dossierPdf = $dossierPdfManager->find ($_POST['idDossier']);

        $dependances = $dependreManager->findEtapes ($dossierPdf);

        foreach ($dependances as $dependance) {
            $dependreManager->delete ($dependance);
        }

        if (isset($_POST['voeux'])) {
            foreach ($_POST['voeux'] as $voeu) {
                $unVoeu = $voeuManager->find ($voeu);
                $dependreManager->insert (new Dependre(intval ($_POST['idDossier']), $unVoeu->getCodeEtape ()));
            }
        }
        header ('location:index.php?uc=formation&action=dependances&dossierPdf=' . $_POST['idDossier']);
    }
        break;
    case "syntheseCsv":
    {
        $csvFileName = 'dossiers/' . $_GET['code'] . '/Synthese.csv';

        if (file_exists ($csvFileName)) {
            unlink ($csvFileName);
        }

        $q = $conn->prepare ("SELECT `INE`,
		d.`NOM`,
		`PRENOM`,
		`MAIL`, 
		CONCAT(`FIXE`, '/', `PORTABLE`) as TEL,
		CONCAT(DAY(`DATE_NAISSANCE`), '/', MONTH(`DATE_NAISSANCE`), '/', YEAR(`DATE_NAISSANCE`)) as DATE_NAISSANCE,
		d.`CODE_FORMATION`,
		`CURSUS`,
		dp.`NOM`,
		`ETAPE`,
		`ANNEE_BAC`
FROM `dossier` d
	INNER JOIN `cursus` c1 ON d.`ID_ETUDIANT` = c1.`ID_ETUDIANT`
	INNER JOIN `faire` f ON d.`ID_ETUDIANT` = f.`ID_ETUDIANT`
	INNER JOIN `voeu` v ON f.`CODE_ETAPE` = v.`CODE_ETAPE`
	INNER JOIN `dossier_pdf` dp ON v.`DOSSIER_PDF` = dp.`ID`
WHERE `ANNEE_FIN` = (SELECT MAX(`ANNEE_FIN`) FROM `cursus`c2 WHERE `ID_ETUDIANT` = c1.`ID_ETUDIANT`)
AND f.`ORDRE` = 1;");
        $q->execute (array ($_GET['code']));
        $rs = $q->fetchAll ();

        $csv = fopen ($csvFileName, 'w');

        fwrite ($csv, 'Ine;Nom;Prenom;Mail;Telephone;Date de naissance;Code formation precedente;Code formation choisie;Annee du Bac\\r\\n');

        foreach ($rs as $row) {
            fwrite ($csv, $row['INE'] . ';');
            fwrite ($csv, $row['NOM'] . ';');
            fwrite ($csv, $row['PRENOM'] . ';');
            fwrite ($csv, $row['MAIL'] . ';');
            fwrite ($csv, $row['TEL'] . ';');
            fwrite ($csv, $row['DATE_NAISSANCE'] . ';');
            fwrite ($csv, $row['CODE_FORMATION_PRECEDENTE'] . ';');
            fwrite ($csv, $row['CODE_FORMATION'] . ';');
            fwrite ($csv, $row['ANNEE_BAC']);
            fwrite ($csv, '\\r\\n');
        }
		fclose($cev);

        echo $twig->render ('formation/syntheseCsv.html.twig', array ('code' => $_GET['code']));
    }
        break;
    case "previsualiserPdf":
    {
        $codeFormation = $_GET['code'];
        $typePdf       = $_GET['typePdf'];
        echo $twig->render ('formation/previsualiserPdfFormation.html.twig', array ('codeFormation' => $codeFormation, 'typePdf' => $typePdf));
    }
        break;
    case "previsualisationPdfCandidature":
    {
        $idDossierPdf  = $_GET['idDossierPdf'];
        $typePdf       = $_GET['typePdf'];
        $dossierPdf    = $dossierPdfManager->find ($idDossierPdf);
        $codeFormation = $dossierPdf->getCodeFormation ();
        $formation     = $formationManager->find ($codeFormation);

        // Récupère tous les voeux du dossier PDF
        $voeux  = $voeuManager->findAllByDossierPdf ($dossierPdf);
        $etapes = array ();
        $cpt = 1;
        foreach ($voeux as $voeu) {
            $etapes[$cpt++] = $voeu->getEtape ();
        }

        require_once 'classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

        /*
         * En-tête du pdf
         */
        $pagePdf->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");
        $currentYear = date ('Y');
        $nextYear    = date ('Y');
        $nextYear++;
        $pagePdf->setPagePdfHeaderText ("DOSSIER DE " . strtoupper($typePdf) . "<br />ANNÉE UNIVERSITAIRE " . $currentYear . "-" . $nextYear . "<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

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

        $pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $dossierPdf->getNom ());

        //$pagePdf->setHolder (' ' . $titulaire[0]->getLibelle (), ' ' . $titulaire[1]->getLibelle (), ' ' . $titulaire[2]->getLibelle (), "titulaire");
        //$pagePdf->setPhotoPath ('classes/Pdf/img/photo/github.png');
        $pagePdf->setPlanFormation ($etapes, "");
        $pagePdf->setProExperience (array ());
        //$pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

        $pagePdf->setCadreAdministrationVoeux ($etapes);

        $pagePdf->setDossierModalites ($formation->getModalites ());
        $pagePdf->setDossierInformations ($formation->getInformations ());

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
            $html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier-type/Candidature.pdf', 'F');
            //echo "PDF BIEN GENERE";
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
        break;
    case 'previsualisationPdfPreinscription' :
    {
        require_once 'classes/Pdf/PagePreinsriptionPdf.class.php';
        $codeFormation = $_GET['code'];
        $typePdf       = $_GET['typePdf'];

        $pagePdfPreinscription = new PagePreinscriptionPdf("", "30mm", "7mm", "0mm", "10mm");

        // En-tête du pdf
        $pagePdfPreinscription->setPagePdfHeaderImgPath ("classes/Pdf/img/feg.png");

        // Pied du pdf
        $pagePdfPreinscription->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

        // Corps du pdf
        $pagePdfPreinscription->setTitle ("01/01/2014", "DOSSIER DE PRE-INSCRIPTION", "Réservé aux étudiants titulaires d’une licence du domaine de formation <br/> Sciences économiques, sciences de gestion et AES", "ANNEE UNIVERSITAIRE 2013/2014 <br/> Institut Supérieur de Management des Organisations (ISMO)", "MASTER Économie Appliquée", "Dossier à adresser avant le 3 Juillet 2013 <br/> Aimée FERRÉ - Secrétariat Master 1 Économie Appliquée <br/> Faculté d’Économie et de Gestion <br/> 14, avenue Jules Ferry – 13621 Aix-en-Provence Cedex");
        $pagePdfPreinscription->setNote ("Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");
        //$pagePdfPreinscription->setApplicant("", "", "", "", "", "", "", "", "", "", "", "");
        $pagePdfPreinscription->setFormationDepuisBac ("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $pagePdfPreinscription->setStageExpPro ("mai 2011 <br/> - <br/> juillet 2011", "mars 2009 <br/> - <br/> août 2009", "janvier 2005 <br/> - <br/> mars 2005", "janvier 2004 <br/> - <br/> décembre 2004", "juin 2003 <br/>-<br/> septembre 2003", "CMA CGM", "Airbus Helicopters", "Capgemini", "LogicielNet", "Sistema", "Marseille", "Marignane", "Marseille", "Aix en Provence", "Aix en Provence", "Info", "Info", "Info", "Info", "Info", "stage", "stage", "emploi", "emploi", "stage");
        $pagePdfPreinscription->setPartieAdministration ('checked', 'checked');

        ob_start ();
        echo $pagePdfPreinscription;
        $content = ob_get_clean ();

        // convert in PDF
        require_once 'classes/Pdf/html2pdf/html2pdf.class.php';
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array (12, 10, 10, 10));
            $html2pdf->setDefaultFont ('arial');
            $html2pdf->pdf->SetDisplayMode ('fullpage');
            $html2pdf->writeHTML ($content, isset($_GET['vuehtml']));
            $html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier-type/preinscription_Type.pdf', 'F');

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
