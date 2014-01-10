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
	var_dump('toto');
    require_once '../classes/Pdf/SkullPdf.class.php';
    $skull = new SkullPdf();
    var_dump($skull);
    // Header
    $skull->setPageHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");
    $skull->setPageHeaderImgPath("./img/feg.png");
    // $skull->setPageCssPath("path ....");

    // Page
    $skull->setPageTitle1("Institut supérieur en sciences de Gestion");
    $skull->setPageTitle2("Licence Gestion");
    $skull->setPageTitle3("L3 Gestion<br />Parcours MIAGE");
    $skull->setPageTitle4("Méthodes Informatiques Appliquées à la Gestion des Entreprises");

    $skull->setPageHolder1(" Titulaire d’un diplôme français - Date limite de dépôt du dossier le 7 Juin 2013");
    $skull->setPageHolder2(" Titulaire d’un diplôme de l'Union Européenne - Date limite de dépôt du dossier le 7 Juin 2013");
    $skull->setPageHolder3(" Titulaire d’un diplôme hors Union Européenne * - Date limite de dépôt du dossier le 7 Juin 2013");
    $skull->setPageNote("* Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");

    // Footer
    $skull->setPageFooterText("Voici le pied de page");

    ob_start();
    echo $skull;
    $content = ob_get_clean(); 

    echo $skull;

    // convert in PDF
    /*require_once('../classes/pdf/html2pdf/html2pdf.class.php');
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
    }*/