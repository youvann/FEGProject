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

    // get the HTML
    ob_start();
    include('./views/template.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once('../classes/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(15, 10, 10, 15));
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