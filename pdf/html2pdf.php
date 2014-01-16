<?php
/**
 * @Project: FEG Project
 * @File: /pdf/html2pdf.php
 * @Purpose: HTML => PDF convertor
 * @Author: Kevin Meas
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    require_once '../classes/Pdf/PagePdf.class.php';
    $pagePdf = new PagePdf("./pdf.css", "30mm", "7mm", "0mm", "10mm");

    // En-tête du pdf
    $pagePdf->setPagePdfHeaderImgPath("./img/feg.png");
    $pagePdf->setPagePdfHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

    // Pied du pdf
    $pagePdf->setPagePdfFooterText("Pied de page");

    // Corps du pdf
    $pagePdf->setTitle("Institut supérieur en sciences de Gestion", "Licence Gestion", "L3 Gestion<br />Parcours MIAGE", "Méthodes Informatiques Appliquées à la Gestion des Entreprises");
    $pagePdf->setHolder(" Titulaire d’un diplôme français - Date limite de dépôt du dossier le 7 Juin 2013", " Titulaire d’un diplôme de l'Union Européenne - Date limite de dépôt du dossier le 7 Juin 2013", " Titulaire d’un diplôme hors Union Européenne * - Date limite de dépôt du dossier le 7 Juin 2013");
    $pagePdf->setNote("* Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");
    $pagePdf->setApplicant("Dupont", "Pierre", "01/01/2014", "Aix-en-Provence", "110000000Q", "4 rue Forbin 13100 Aix-en-Provence", "0442321423", "0674231232", "contact@feg.com", "étudiant");
    $pagePdf->setPlanFormation("L3 Gestion parcours MIAGE - Méthodes informatiques Appliquées à la Gestion des Entreprises", "Aix-en-Provence");
    $pagePdf->setBaccalaureat("S", "2010", "Lycée Pierre Paul Jack", "Réunion", "France");

    ob_start();
    echo $pagePdf;
    $content = ob_get_clean();

    // convert in PDF
    require_once '../classes/pdf/html2pdf/html2pdf.class.php';
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(12, 10, 10, 10));
     	// $html2pdf->setModeDebug();
     	$html2pdf->pdf->addFont('verdana', '', '../../classes/html2pdf/_tcpdf_5.0.002/fonts/verdana.php');
     	$html2pdf->pdf->addFont('verdanab', '', '../../classes/html2pdf/_tcpdf_5.0.002/fonts/verdanab.php');
        $html2pdf->setDefaultFont('verdana');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('html2pdf.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
