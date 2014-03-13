<?php

/*
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdfHeader.class.php
 * @Purpose: En-tête du PDF
 * @Author: Kevin meas
 */

class PagePdfHeader {
    /**
     * @var string Chemin de l'image du PDF (Logo : Faculté d'économie et de Gestion)
     */
    private $imgPath;
    /**
     * @var string  Texte de l'en-tête du PDF (DOSSIER DE ... ANNEE UNIVERSITAIRE ...)
     */
    private $headerText;

    /**
     * Permet de définir le chemin de l'image du PDF
     *
     * @param string $imgPath Chemin de l'image
     */
    public function setImgPath ($imgPath) {
        $this->imgPath = $imgPath;
    }

    /**
     * Permet de définir le texte de l'en-tête du PDF
     *
     * @param string $headerText Texte de l'en-tête du PDF
     */
    public function setHeadertext ($headerText) {
        $this->headerText = $headerText;
    }

    /**
     * Affiche l'en-tête du PDF
     *
     * @return string En-tête du PDF
     */
    public function __toString () {
        return '<page_header>
			        <table class="t_header">
			        <col style="width: 49%">
			            <tr>
			                <td><img src="' . $this->imgPath . '" alt="image"></td>
			                <td class="bold titre4">' . $this->headerText . '</td>
			            </tr>
			        </table>
			    </page_header> ';
    }
}
?>
