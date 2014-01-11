<?php
/*
 * @Project: FEG Project
 * @File: /classes/Pdf/SkeletonPdf.class.php
 * @Purpose: Template du PDF
 * @Author:
 */

require_once 'PagePdf.class.php';
require_once 'PagePdfHeader.class.php';
require_once 'PagePdfFooter.class.php';

class SkeletonPdf {
    private $pagePdf;
    private $pagePdfHeader;
    private $pagePdfFooter;

    public function __construct() {
        $this->pagePdf       = new PagePdf ("30mm", "7mm", "0mm", "10mm", "./../public/css/feg.css");
        $this->pagePdfHeader = new PagePdfHeader();
        $this->pagePdfFooter = new PagePdfFooter();
    }

    // Page
    // Setters
    public function setPagePdfCssPath ($cssPath){
        $this->pagePdf->setCssPath($cssPath);
    }

    public function setpagePdfTitle1 ($title1){
        $this->pagePdf->setTitle1($title1);
    }

    public function setpagePdfTitle2 ($title2){
        $this->pagePdf->setTitle2($title2);
    }

    public function setpagePdfTitle3 ($title3){
        $this->pagePdf->setTitle3($title3);
    }

    public function setpagePdfTitle4 ($title4){
        $this->pagePdf->setTitle4($title4);
    }

    public function setpagePdfHolder1 ($holder1){
        $this->pagePdf->setHolder1($holder1);
    }

    public function setpagePdfHolder2 ($holder2){
        $this->pagePdf->setHolder2($holder2);
    }

    public function setpagePdfHolder3 ($holder3){
        $this->pagePdf->setHolder3($holder3);
    }

    public function setPagePdfNote($note){
        $this->pagePdf->setNote($note);
    }

    // Setters de pagePdfHeader
    public function setPagePdfHeaderImgPath($imgPath){
        $this->pagePdfHeader->setImgPath($imgPath);
    }
    public function setPagePdfHeaderText($headerText){
        $this->pagePdfHeader->setHeaderText($headerText);
    }

    // Setters de pagePdfFooter
    public function setPagePdfFooterText($footerText){
        $this->pagePdfFooter->setFooterText($footerText);
    }

    // toString
    public function __toString() {
        return $this->pagePdf . $this->pagePdfHeader . $this->pagePdfFooter . "</page>";
    }
}

$pdf = new SkeletonPdf ();
// echo $pdf;
?>