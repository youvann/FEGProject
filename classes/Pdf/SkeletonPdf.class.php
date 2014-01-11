<?php
/**
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
        $this->pagePdf       = new PagePdf ("./../public/css/feg.css", "30mm", "7mm", "0mm", "10mm");
        $this->pagePdfHeader = new PagePdfHeader();
        $this->pagePdfFooter = new PagePdfFooter();
    }

    // Page
    // Setters
    public function setPagePdfCssPath ($cssPath){
        $this->pagePdf->setCssPath($cssPath);
    }

    public function setPagePdfTitle ($title1, $title2, $title3, $title4){
        $this->pagePdf->setTitle($title1, $title2, $title3,$title4);
    }

    public function setPagePdfHolder ($holder1, $holder2, $holder3){
        $this->pagePdf->setHolder($holder1, $holder2, $holder3);
    }

    public function setPagePdfNote($note){
        $this->pagePdf->setNote($note);
    }

    public function setPagePdfApplicant ($applicantName, $applicantFirstName, $applicantBirthDate, $applicantBirthPlace, $applicantIne, $applicantAdress, $applicantFixNumber, $applicantPortNumber, $applicantMail, $applicantActivity){
        $this->pagePdf->setApplicant($applicantName, $applicantFirstName, $applicantBirthDate, $applicantBirthPlace, $applicantIne, $applicantAdress, $applicantFixNumber, $applicantPortNumber, $applicantMail, $applicantActivity);
    }

    public function setPagePdfPlanFormation ($formationName){
        $this->pagePdf->setPlanFormation($formationName);
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
        return $this->pagePdf . $this->pagePdfHeader . $this->pagePdfFooter
               . '</page><page pageset="old">' . $this->pagePdf->getPlanFormation() . '</page>';
    }
}

$pdf = new SkeletonPdf ();
// echo $pdf;
