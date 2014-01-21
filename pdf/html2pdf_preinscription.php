<?php
/**
 * @Project: FEG Project
 * @File: /pdf/html2pdf.php
 * @Purpose: HTML => PDF convertor
 * @Author: Kevin Meas & Hasan Karagoz
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    require_once '../classes/Pdf/PagePreinsriptionPdf.class.php';
    $pagePdf = new PagePdf("./pdf.css", "30mm", "7mm", "0mm", "10mm");

    // En-tête du pdf
    $pagePdf->setPagePdfHeaderImgPath("./img/feg.png", "./img/logo_eco_appliquee.png");
    

    // Pied du pdf
    $pagePdf->setPagePdfFooterText("Pied de page");

    $pagePdf->setPagePdfFooterText("Pied de page");
    // Corps du pdf
    $pagePdf->setTitle("01/01/2014","DOSSIER DE PRE-INSCRIPTION", "Réservé aux étudiants titulaires d’une licence du domaine de formation <br/> Sciences économiques, sciences de gestion et AES", "ANNEE UNIVERSITAIRE 2013/2014 <br/> Institut Supérieur de Management des Organisations (ISMO)", "MASTER Économie Appliquée", "Dossier à adresser avant le 3 Juillet 2013 <br/> Aimée FERRÉ - Secrétariat Master 1 Économie Appliquée <br/> Faculté d’Économie et de Gestion <br/> 14, avenue Jules Ferry – 13621 Aix-en-Provence Cedex");
    $pagePdf->setNote("Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");
    $pagePdf->setApplicant("Dupont", "Pierre", "Française", "05/01/1993", "110110000P", "6 rue Forbin 13100 Aix-en-Provence", "0442321423", "0674231232", "contact@feg.com", "S", 2010, "Bien");
    $pagePdf->setFormationDepuisBac("2012/2013", "2011/2012", "2010/2011", "2009/2010", "2008/2007", "Marseille", "Aix-en-Provence", "Aix-en-Provence", "Marseille", "Marseille", "DUT", "BTS" , "L1" , "L2", "L3", "Informatique", "Algo", "Maths", "Informatique", "Informatique", "15 Mention bien", "18 Mention Trés bien", "9 2° groupe", "11 2° groupe", "10 2° groupe");
    $pagePdf->setStageExpPro("mai 2011 <br/> - <br/> juillet 2011", "mars 2009 <br/> - <br/> août 2009", "janvier 2005 <br/> - <br/> mars 2005", "janvier 2004 <br/> - <br/>  décembre 2004", "juin 2003 <br/>-<br/> septembre 2003", "CMA CGM", "Airbus Helicopters", "Capgemini", "LogicielNet", "Sistema", "Marseille", "Marignane", "Marseille", "Aix en Provence", "Aix en Provence", "Info", "Info", "Info", "Info", "Info", "stage", "stage", "emploi", "emploi", "stage");
    $pagePdf->setPartieAdministration('checked', 'checked');
    
    
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

    
    
   