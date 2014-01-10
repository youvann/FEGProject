<?php 
/* 
 * @Project: FEG Project
 * @File: /classes/Pdf/SkullPdf.class.php
 * @Purpose: Template du PDF
 * @Author: 
 */

require_once 'Page.class.php';
require_once 'PageHeader.class.php';
require_once 'PageFooter.class.php';

class SkullPdf {
    private $page;
    private $pageHeader;
    private $pageFooter;

    public function __construct() {
        $this->page       = new Page ("30mm", "7mm", "0mm", "10mm", "./../public/css/feg.css");
        $this->pageHeader = new PageHeader();
        $this->pageFooter = new PageFooter();
    }	

    // Page
    // Setters
    public function setPageCssPath ($cssPath){
        $this->page->setCssPath($cssPath);
    }

    public function setPageTitle1 ($title1){
        $this->page->setTitle1($title1);
    }

    public function setPageTitle2 ($title2){
        $this->page->setTitle2($title2);
    }

    public function setPageTitle3 ($title3){
        $this->page->setTitle3($title3);
    }

    public function setPageTitle4 ($title4){
        $this->page->setTitle4($title4);
    }

    public function setPageHolder1 ($holder1){
        $this->page->setHolder1($holder1);
    }

    public function setPageHolder2 ($holder2){
        $this->page->setHolder2($holder2);
    }

    public function setPageHolder3 ($holder3){
        $this->page->setHolder3($holder3);
    }

    public function setPageNote($note){
        $this->page->setNote($note);
    }

    // Setters de PageHeader
    public function setPageHeaderImgPath($imgPath){
        $this->pageHeader->setImgPath($imgPath);
    }
    public function setPageHeaderText($headerText){
        $this->pageHeader->setHeaderText($headerText);
    }

    // Setters de PageFooter
    public function setPageFooterText($footerText){
        $this->pageFooter->setFooterText($footerText);
    }

    // toString
    public function __toString() {
        return $this->page . $this->pageHeader . $this->pageFooter . "</page>";
    }    
}

$pdf = new SkullPdf ();
// echo $pdf;
?>