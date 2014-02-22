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
        echo $twig->render ('formation/consulterFormation.html.twig', array ('formation' => $formation));
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
        myMkdir ($_POST['code_formation']);


        $formationManager->insert (new Formation($_POST['code_formation'], $_POST['mention'], $_POST['informations'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']));
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
        $formation = new Formation($_POST['code_formation'], $_POST['mention'], $_POST['informations'], $_POST['modalites'], $_POST['ouverte'], $_POST['faculte']);
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
        $meres      = $dependreManager->findMeres ($formationManager->find ($_GET['code']));
        $formations = $formationManager->findAll ();
        $voeux      = $voeuManager->findAll ();

        echo $twig->render ('formation/dependances.html.twig', array ('meres' => $meres, 'formations' => $formations, 'voeux' => $voeux, 'code' => $_GET['code']));
    }
        break;
    case "modificationDependances":
    {
        $dependreManager->deleteAllMeres ($formationManager->find ($_POST['formation']));

        foreach ($_POST['voeux'] as $voeu) {
            $unVoeu = $voeuManager->find ($voeu);
            $dependreManager->insert (new Dependre($unVoeu->getCodeFormation (), $unVoeu->getCodeEtape (), $_POST['formation']));
        }
        header ('location:index.php?uc=formation&action=dependances&code=' . $_POST['formation']);
    }
        break;
    case "syntheseCsv":
    {
        $csvFileName = 'dossiers/' . $_GET['code'] . '/Synthese.csv';

        if (file_exists ($csvFileName)) {
            unlink ($csvFileName);
        }

        $q = $conn->prepare ("select `INE`, `NOM`, `PRENOM`, `MAIL`, concat(`FIXE`, ' / ', `PORTABLE`) as TEL, `DATE_NAISSANCE`, `CODE_FORMATION_PRECEDENTE`, `CODE_FORMATION`, `ANNEE_BAC` FROM `dossier` WHERE `CODE_FORMATION` = ?;");
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
        $codeFormation = $_GET['code'];
        $typePdf       = $_GET['typePdf'];
        $formation     = $formationManager->find ($codeFormation);
        $titulaire     = $titulaireManager->findAll ();

        $qInfoSupp = $conn->prepare ("SELECT * FROM `INFORMATION` WHERE `CODE_FORMATION` = ? ORDER BY `ORDRE`;");
        $qInfoSupp->execute (array ($codeFormation));
        $rsInfoSupp = $qInfoSupp->fetchAll ();

        // Récupère les informations spécifiques
        $informationsSpecifiques = '';
        foreach ($rsInfoSupp as $infoSupp) {
            $informationsSpecifiques .= '<div class="bold">' . $infoSupp['LIBELLE'] . ' ' . $infoSupp['EXPLICATIONS'] . ' : </div><br/>';
        }

        // Récupère les voeux possibles
        $qVoeux = $conn->prepare ("SELECT * FROM `VOEU` WHERE `CODE_FORMATION` = ?;");
        $qVoeux->execute (array ($codeFormation));
        $rsVoeux = $qVoeux->fetchAll ();

        // Insère les voeux possibles dans le tableau étapes
        $etapes = array ();
        foreach ($rsVoeux as $voeu) {
            $etapes[] = $voeu['ETAPE'];
        }

        /*$qVille = $conn->prepare("SELECT `VILLE`.`NOM` as `VILLE`
FROM `VOEU` LEFT JOIN `SE_DEROULER` ON (`VOEU`.`CODE_ETAPE` = `SE_DEROULER`.`CODE_ETAPE`)
LEFT JOIN `VILLE` ON (`SE_DEROULER`.`CODE_VET` = `VILLE`.`CODE_VET`)
WHERE `VOEU`.`CODE_FORMATION` = ?;");
$qVille->execute(array($codeFormation));
$rsVille = $qVille->fetchAll();
var_dump($qVille);*/
        /*
$faires = $faireManager->findAllByDossier($dossier);
$etapes = array();
$villesPossibles = array();

// Récupère l'ordre des voeux et les villes où la formation a lieu
foreach ($faires as $faire){
$voeu = $voeuManager->find($faire->getCodeEtape());
$lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
$etapes[$faire->getOrdre()] = $voeu->getEtape();

//echo $voeu->getEtape() . ' ' . $faire->getOrdre();
foreach ($lesSeDerouler as $unSeDerouler){
$ville = $villeManager->find($unSeDerouler->getCodeVet());
// echo ' - ' . $ville->getNom();
}
// echo '<br>';
$villesPossibles[] = $ville->getNom();
}
// Supprime les doublons des villes
$villesPossibles = array_unique($villesPossibles);
*/

        require_once './classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("./classes/Pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

        // En-tête du pdf
        $pagePdf->setPagePdfHeaderImgPath ("./classes/Pdf/img/feg.png");
        $pagePdf->setPagePdfHeaderText ("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

        // Pied du pdf
        $pagePdf->setPagePdfFooterText ("Page [[page_cu]]/[[page_nb]]");

        // Corps du pdf
        $logoPath = "./public/img/logos/" . $formation->getCodeFormation();
        $empty    = is_dir_empty ($logoPath);
        $logoName = $empty ? "" : getFileName ($logoPath);
        if(!$empty){
            $pagePdf->setLogoPath ($logoPath . "/" . $logoName);
        }else{
            $pagePdf->setLogoPath ("");
        }
        $pagePdf->setTitle ("Institut supérieur en sciences de Gestion", $formation->getMention ());

        $pagePdf->setHolder (' ' . $titulaire[0]->getLibelle (), ' ' . $titulaire[1]->getLibelle (), ' ' . $titulaire[2]->getLibelle (), "titulaire");
        $pagePdf->setPhotoPath ('./classes/Pdf/img/photo/github.png');
        $pagePdf->setPlanFormation ($etapes, array ());
        $pagePdf->setProExperience (array ());
        $pagePdf->setInformationsSpecifiques ($informationsSpecifiques);

        $pagePdf->setCadreAdministrationVoeux (array ("voeux1", "voeux2"));
        $pagePdf->setVoeuxMultiple (true);
        $pagePdf->setRowAdmin (true);

        ob_start ();
        echo $pagePdf;
        $content = ob_get_clean ();

        // convert in PDF
        require_once './classes/Pdf/html2pdf/html2pdf.class.php';
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array (12, 10, 10, 10));
            $html2pdf->setDefaultFont ('arial');
            $html2pdf->pdf->SetDisplayMode ('fullpage');
            $html2pdf->writeHTML ($content, isset($_GET['vuehtml']));
            $html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier_Type/candidature_Type.pdf', 'F');
            //echo "PDF BIEN GENERE";
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
        //header('location:index.php?uc=formation&action=previsualiserPdf&code=' . $codeFormation . '&typePdf=' . $typePdf);
    }
        break;
    case 'previsualisationPdfPreinscription' :
    {
        require_once './classes/Pdf/PagePreinsriptionPdf.class.php';
        $codeFormation = $_GET['code'];
        $typePdf       = $_GET['typePdf'];

        $pagePdfPreinscription = new PagePreinscriptionPdf("", "30mm", "7mm", "0mm", "10mm");

        // En-tête du pdf
        $pagePdfPreinscription->setPagePdfHeaderImgPath ("./classes/Pdf/img/feg.png");

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
        require_once './classes/Pdf/html2pdf/html2pdf.class.php';
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array (12, 10, 10, 10));
            $html2pdf->setDefaultFont ('arial');
            $html2pdf->pdf->SetDisplayMode ('fullpage');
            $html2pdf->writeHTML ($content, isset($_GET['vuehtml']));
            $html2pdf->Output ('dossiers/' . $codeFormation . '/Dossier_Type/preinscription_Type.pdf', 'F');

        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
        break;
    case 'logoDossierPdf' :
    {
        $code     = $_GET['code'];
        $logoPath = "./public/img/logos/" . $code;
        $empty    = is_dir_empty($logoPath);
        $logoName = $empty ? "" : getFileName($logoPath);
        //var_dump($logoName);

        echo $twig->render ('formation/logoDossierPdf.html.twig', array (
            'code' => $code,
            'empty' => $empty,
            'logoName' => $logoName
        ));
    }
        break;
    case 'suppressionLogo' :
    {
        $code     = $_GET['code'];
        $logoName = $_GET['logoName'];
        $logoPathName = "./public/img/logos/" . $code . "/" . $logoName;
        //chmod ('./public/img/logos/' . $code . '/' . $logoName . "/", 0777);
        unlink ($logoPathName);
    }
        break;
    case 'uploadLogo' :
    {
        $code = $_GET['code'];
        //$logoName = $empty ? "" : getFileName ($logoPath);
        upload('./public/img/logos/' . $code . '/');
    }
        break;
	case 'dossier' :
	{
        $code = $_GET['code'];
		$formation = $formationManager->find($code);
		$voeux = $voeuManager->findAllByFormation($formation);
		$dossiersPdf = $dossierPdfManager->findAllByFormation($formation);

		echo $twig->render ('formation/dossier.html.twig', array (
			'code' => $code,
			'voeux' => $voeux,
			'dossiersPdf' => $dossiersPdf
		));
	}
		break;
	case 'ajouterDossier' :
	{
		$dossierPdfManager->insert(new DossierPdf(0, $_POST['nom'], $_POST['code_formation']));
		header('location:index.php?uc=formation&action=dossier&code='.$_POST['code_formation']);
	}
		break;
    default:
        break;
}
