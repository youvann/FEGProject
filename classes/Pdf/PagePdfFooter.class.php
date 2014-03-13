<?php

/*
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdfFooter.class.php
 * @Purpose: Footer du PDF de candidature
 * @Author: Kevin Meas
 */

class PagePdfFooter {
    /**
     * @var string Texte du pied de page
     */
    private $footerText;

    /**
     * Permet de modifier le texte du pied de page
     *
     * @param $footerText string Texte du pied de page
     */
    public function setFooterText ($footerText) {
        $this->footerText = $footerText;
    }

    /**
     * Affiche le pied de page du PDF
     *
     * @return string Pied de page du PDF
     */
    public function __toString () {
        return ' <page_footer>' . $this->footerText . '</page_footer>';
    }
}
?>
