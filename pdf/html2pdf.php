<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    require_once '../classes/Pdf/SkeletonPdf.class.php';
    $skeleton = new SkeletonPdf();

    // Header
    $skeleton->setPagePdfHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");
    $skeleton->setPagePdfHeaderImgPath("./img/feg.png");
    // $skeleton->setPageCssPath("path ....");

    // Page
    $skeleton->setPagePdfTitle1("Institut supérieur en sciences de Gestion");
    $skeleton->setPagePdfTitle2("Licence Gestion");
    $skeleton->setPagePdfTitle3("L3 Gestion<br />Parcours MIAGE");
    $skeleton->setPagePdfTitle4("Méthodes Informatiques Appliquées à la Gestion des Entreprises");

    $skeleton->setPagePdfHolder1(" Titulaire d’un diplôme français - Date limite de dépôt du dossier le 7 Juin 2013");
    $skeleton->setPagePdfHolder2(" Titulaire d’un diplôme de l'Union Européenne - Date limite de dépôt du dossier le 7 Juin 2013");
    $skeleton->setPagePdfHolder3(" Titulaire d’un diplôme hors Union Européenne * - Date limite de dépôt du dossier le 7 Juin 2013");
    $skeleton->setPagePdfNote("* Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");

    // Footer
    $skeleton->setPagePdfFooterText("Voici le pied de page");

    ob_start();
    echo $skeleton;
    $content = ob_get_clean();

    // echo $skeleton;

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