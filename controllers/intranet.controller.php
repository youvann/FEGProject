<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
	$action = "accueil";
} else {
	$action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "accueil": {
			echo $twig->render('intranet/accueil.html.twig');
		} break;
	case "carte": {
			echo $twig->render('intranet/carte.html.twig');
		} break;
	case "explorateur": {
			echo $twig->render('intranet/explorateur.html.twig', array('directory' => str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))).'/'));
		} break;
    case "generationPdfCandidature": {
        $formation            = $formationManager->find("3BAS");
        $voeu                 = $voeuManager->findAllByFormation($formation);
        $dossier              = $dossierManager->find('1104015475', '3BAS');
        $titulaire            = $titulaireManager->findAll();
        $cursus               = $cursusManager->findAllByDossier($dossier);

        $documentsGeneraux    = $documentGeneralManager->findAll();
        $documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation("3BAS");

        //$cursus = array();
        //$cursus [] = new Cursus("1", "1104015475", "3BAS", "2010", "2011", "informatique", "IUT INFO", "0");
        //$cursus [] = new Cursus("2", "1104015475", "3BAS", "2012", "2013", "informatique", "IUT INFO", "0");
        //$cursus [] = new Cursus("3", "1104015475", "3BAS", "2013", "2014", "informatique", "IUP MIAGE", "0");

        //$experiences = $experienceManager->findAllByDossier($dossier);
        $experiences = array();
        $experiences [] = new Experience("1","1104015475", "3BAS", "Avril", "2013", "Juin", "2014", "Sportstec", "Développeur PHP");
        $experiences [] = new Experience("2","1104015475", "3BAS", "Avril", "2010", "Juin", "2010", "Carrefour", "Vendeur");

        //var_dump($cursus);

        require_once './classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("./pdf/pdf.css", "30mm", "7mm", "0mm", "10mm");

        // En-tête du pdf
        $pagePdf->setPagePdfHeaderImgPath("./pdf/img/feg.png");
        $pagePdf->setPagePdfHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

        // Pied du pdf
        $pagePdf->setPagePdfFooterText("Pied de page");

        // Corps du pdf
        $pagePdf->setTitle("Institut supérieur en sciences de Gestion", $formation->getMention());
        $pagePdf->setHolder(' ' . $titulaire[0]->getLibelle(), ' ' . $titulaire[1]->getLibelle(), ' ' . $titulaire[2]->getLibelle(), $dossier->getTitulaire());
        $pagePdf->setNote("* Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");
        $pagePdf->setApplicant($dossier->getNom(), $dossier->getPrenom(), $dossier->getLieuNaissance(), $dossier->getDateNaissance(), $dossier->getIne(), $dossier->getAdresse() . ' ' . $dossier->getComplement() . ' ' . $dossier->getCodePostal(), $dossier->getFixe(), $dossier->getPortable(), $dossier->getMail(), $dossier->getActivite());
        $pagePdf->setPlanFormation("L3 Gestion parcours MIAGE - Méthodes informatiques Appliquées à la Gestion des Entreprises", "Aix-en-Provence");
        $pagePdf->setPrevFormation($dossier->getSerieBac(), $dossier->getAnneeBac() , $dossier->getEtablissementBac(), $dossier->getDepartementBac(), $dossier->getPaysBac(), $cursus);
        $pagePdf->setProExperience($experiences);
        $pagePdf->setOther("Anglais bon niveau (lu, écrit et parlé)", "Pas d'autres éléments appuyant ma candidature");

        // $documentsGeneraux    = array("CV", "Lettre de motivation", "Passeport/Carte d'identité","Diplômes", "Photo");
        // $documentsSpecifiques = array("Livret de famille", "Lettre essai", "llo/Carte d'identité","sss", "aaa");
        $pagePdf->setDocumentsGeneraux($documentsGeneraux);
        $pagePdf->setDocumentsSpecifiques($documentsSpecifiques);

        ob_start();
        echo $pagePdf;
        $content = ob_get_clean();

        // convert in PDF

        require_once './classes/Pdf/html2pdf/html2pdf.class.php';
        try{
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(12, 10, 10, 10));
            //$html2pdf->setModeDebug();
            $html2pdf->pdf->addFont('verdana', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdana.php');
            $html2pdf->pdf->addFont('verdanab', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdanab.php');
            $html2pdf->setDefaultFont('verdana');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('html2pdf.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

    } break;
	default: break;
}