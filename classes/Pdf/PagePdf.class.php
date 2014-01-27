<?php
/**
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdf.class.php
 * @Purpose: Construit la page d'un document HTML qui va être transformé en PDF
 * @Author: Kevin Meas & Hasan Karakoz
 */

require_once 'PagePdfHeader.class.php';
require_once 'PagePdfFooter.class.php';

class PagePdf{
    private $pagePdfHeader;
    private $pagePdfFooter;

    private $backTop;
    private $backBottom;
    private $backLeft;
    private $backRight;
    private $cssPath;
    private $css;

    // Titre
    private $title1;
    private $title2;

    // Titulaire
    private $holder1;
    private $holder2;
    private $holder3;
    private $checkboxHolder;
    private $note;

    //Candidat
    private $applicantSex;
    private $applicantName;
    private $applicantFirstName;
    private $applicantBirthDate;
    private $applicantBirthPlace;
    private $applicantIne;
    private $applicantAdress;
    private $applicantFixNumber;
    private $applicantPortNumber;
    private $applicantMail;
    private $applicantActivity;
    private $noteActivity;
    private $photoPath;

    // Formation envisagé
    private $etapes = array();
    private $villesPossibles = array ();

    // Cursus antérieur
    private $serie;
    private $yearAcquisition;
    private $establishment;
    private $departement;
    private $country;
    private $cursusPostBac = array ();

    //Expérience professionnelle
    private $proExperience;

    // Langues et autres éléments
    private $foreignLanguage;
    private $otherElements;

    // Informations spécifiques
    private $informationsSpecifiques;

    // Documents généraux
    //private $documentsGeneraux = array();

    // Documents spécifiques
    //private $documentsSpecifiques = array ();

    public function __construct($cssPath, $backTop = "30mm", $backBottom = "7mm", $backLeft = "0mm", $backRight = "10mm") {
        $this->pagePdfHeader = new PagePdfHeader();
        $this->pagePdfFooter = new PagePdfFooter();

        $this->backTop    = $backTop;
        $this->backBottom = $backBottom;
        $this->backLeft   = $backLeft;
        $this->backRight  = $backRight;
        $this->cssPath    = $cssPath;
        $this->css        = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
    }

    public function setPagePdfHeaderImgPath ($imgPath){
        $this->pagePdfHeader->setImgPath($imgPath);
    }

    public function setPagePdfHeaderText ($headerText){
        $this->pagePdfHeader->setHeadertext($headerText);
    }

    public function setPagePdfFooterText ($footerText){
        $this->pagePdfFooter->setFooterText($footerText);
    }

    public function getPageBegin(){
        return '<page backtop="' . $this->backTop . '" backbottom="' . $this->backBottom . '" backleft="' . $this->backLeft . '" backright="' . $this->backRight . '"> ';
    }

    public function getNewPage (){
        return '<page pageset="old">';
    }

    public function getPageEnd (){
        return "</page> ";
    }

    public function getCssPath (){
        return $this->css;
    }

    public function setCssPath ($cssPath){
        $this->cssPath = $cssPath;
        $this->css     = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
    }

    public function setTitle ($title1, $title2){
        $this->title1 = $title1;
        $this->title2 = $title2;
    }

    public function setHolder ($holder1, $holder2, $holder3, $checkboxHolder){
        $this->holder1 = $holder1;
        $this->holder2 = $holder2;
        $this->holder3 = $holder3;
        $this->checkboxHolder = $checkboxHolder;
    }

    public function setNote ($note){
        $this->note = $note;
    }

    public function getFormationTitle(){
        // <td class="fifty_width_table border-left-none border-top-none titre2 bold"><img src="./pdf/img/miage.png" alt=""></td>
        return '<table class="t_title">
                    <tr>
                        <td colspan="2" class="full_width_table titre3 bold">' . $this->title1 . '</td>
                    </tr>
                    <tr>
                        <td class="fifty_width_table titre1 bold">' . $this->title2 . '</td>
                    </tr>

                </table>';
    }

    public function numHolder($num){
        switch($num){
            case 1 : {
                return $this->holder1;
            }break;
            case 2 : {
                return $this->holder2;
            }break;
            case 3 : {
                return $this->holder3;
            }break;
            default: break;
        }
    }

    public function getDegreeHolder(){
        $checkbox = '<br/><span class="bold note">' . $this->numHolder($this->checkboxHolder) . '</span><br/><br/>';
        if($this->checkboxHolder == 3){
            $checkbox .= '<p class="note">' . $this->note . '</p>';
        }
        return $checkbox;
    }

    public function setApplicant($applicantSex, $applicantName, $applicantFirstName, $applicantBirthDate,
                                 $applicantBirthPlace, $applicantIne, $applicantAdress,
                                 $applicantFixNumber, $applicantPortNumber, $applicantMail,
                                 $applicantActivity) {
        $this->applicantSex        = $applicantSex;
        $this->applicantName       = $applicantName;
        $this->applicantFirstName  = $applicantFirstName;
        $this->applicantBirthDate  = $applicantBirthDate;
        $this->applicantBirthPlace = $applicantBirthPlace;
        $this->applicantIne        = $applicantIne;
        $this->applicantAdress     = $applicantAdress;
        $this->applicantFixNumber  = $applicantFixNumber;
        $this->applicantPortNumber = $applicantPortNumber;
        $this->applicantMail       = $applicantMail;
        $this->applicantActivity   = $applicantActivity;
    }

    public function setPhotoPath($photoPath){
        $this->photoPath = $photoPath;
    }

    public function getPhotoPath(){
        return '<img src="' . $this->photoPath . '" alt="cadre_administration" style="width: 150px"/>';
    }

    public function getApplicant(){
        return '<div class="titre_encadre">CANDIDAT</div>
                <br>
                <span class="bold">' . $this->applicantSex . '</span>
                <br><br>
                <table>
                    <tr>
                        <td width="535">
                            <span class="bold">Nom :</span> ' . $this->applicantName . '<br><br>
                            <span class="bold">Prénom :</span> ' . $this->applicantFirstName . '<br><br>
                            <span class="bold">Date de naissance :</span> ' . $this->applicantBirthPlace . '<br><br>
                            <span class="bold">Lieu de naissance :</span> ' . $this->applicantBirthDate . '<br><br>
                            <span class="bold">N° INE (pour étudiants en France) :</span> ' . $this->applicantIne . '
                        </td>
                        <td>
                            ' . $this->getPhotoPath() . '
                        </td>
                    </tr>
                </table>
                <br>
                <div>
                    <span class="bold">Adresse :</span> ' . $this->applicantAdress . '<br><br>
                    <span class="bold">Tel Fixe :</span> ' . $this->applicantFixNumber . '<br><br>
                    <span class="bold">Tel Portable :</span> ' . $this->applicantPortNumber . '<br><br>
                    <span class="bold">Adresse électronique :</span> ' . $this->applicantMail . '<br><br>
                    <span class="bold">Activité actuelle (étudiant, salarié, demandeur d\'emploi, autre) :</span> ' . $this->applicantActivity . '<br><br>
                </div>';
    }

    public function setPlanFormation ($etapes, $villesPossibles){
        $this->etapes          = $etapes;
        $this->villesPossibles = $villesPossibles;
    }

    public function printVillesPossibles (){
        $villes = '';
        foreach($this->villesPossibles as $villePossible){
            $villes .= $villePossible . ' ';
        }
        return $villes;
    }

    public function printPlanFormation (){
        $nomEtapeOrdre = '';
        foreach ($this->etapes as $ordre => $etape) {
            $nomEtapeOrdre .= '<tr><td text-align="center">' . $ordre . '</td>' .
                                   '<td>' . $etape . '</td>
                                    <td text-align="center"></td>
                              </tr>' ;
        }
        return $nomEtapeOrdre;
    }

    public function getPlanFormation(){
        return '<br/><div class="titre_encadre">FORMATION ENVISAGE</div><br>
                <table>
                    <col style="width: 8%">
                    <col style="width: 70%">
                    <col style="width: 28%">

                    <thead>
                        <tr>
                            <th text-align="center">Ordre</th>
                            <th text-align="center">Parcours</th>
                            <th text-align="center"> Localisation : ' . $this->printVillesPossibles() . '</th>
                        </tr>
                    </thead>
                    ' . $this->printPlanFormation() . '
                </table>';
    }

    // <td class="planFormation" text-align="center">' . $this->formationName . '</td>
    // <td text-align="center"> ' . $this->formationPlace . '</td>

    public function setPrevFormation ($serie, $yearAcquisition, $establishment, $departement, $country, $cursusPostBac){
        $this->serie           = $serie;
        $this->yearAcquisition = $yearAcquisition;
        $this->establishment   = $establishment;
        $this->departement     = $departement;
        $this->country         = $country;
        $this->cursusPostBac   = $cursusPostBac;
    }

    public function printPostBac (){
        $postBac = '';
        foreach($this->cursusPostBac as $cpb){
            $postBac .= '<tr>
                <td text-align="center">' . $cpb->getAnneeDebut() . '-' . $cpb->getAnneeFin() . '</td>
                <td text-align="center">' . $cpb->getEtablissement() . '</td>
                <td text-align="center">' . $cpb->getCursus() . '</td>
                <td text-align="center">' . $cpb->getValide() . '</td>
            </tr>';
        }
        return $postBac;
    }

    public function getPrevFormation (){
        return '
                <div class="titre_encadre">CURSUS ANTÉRIEUR</div><br>
                <div class="cadre" width="685">
                    <div class="titre3 bold" text-align="center">BACCALAURÉAT</div><br>
                    <span class="bold">Série : </span>' . $this->serie . '<br><br>
                    <span class="bold">Année d\'obtention </span>: ' . $this->yearAcquisition . '<br><br>
                    <span class="bold">Etablissement : </span>' . $this->establishment . ' <br><br>
                    <span class="bold">Département : </span>' . $this->departement . ' <br><br>
                    <span class="bold">Pays : </span>' . $this->country . '<br><br>
                    <div class="titre3 bold" text-align="center">ENSEIGNEMENT SUPÉRIEUR</div><br>
                    <div class="bold">Dernière inscription dans l\'enseignement supérieur : </div>
                    <span>Année universitaire : .../...</span><br>
                    <span>Formation suivie : </span><br><br>

                    <table class="t_postBac">
                        <col style="width: 13%">
                        <col style="width: 40%">
                        <col style="width: 37%">
                        <col style="width: 10%">
                        <tr>
                            <th class="bold" colspan="4" text-align="center">Cursus Post-Bac</th>
                        </tr>
                        <tr>
                            <th class="center">Année</th>
                            <th class="center">Établissement</th>
                            <th class="center">Cursus suivi</th>
                            <th class="center">Validé</th>
                        </tr>'
        . $this->printPostBac() .
        '</table>
    </div>';
    }

    public function setProExperience ($proExperience){
        $this->proExperience = $proExperience;
    }

    public function printProExperience (){
        $proExperience = '';
        foreach ($this->proExperience as $proExp){
            $proExperience .= '<tr>
                <td text-align="center">' . $proExp->getMoisDebut() . '-' . $proExp->getAnneeDebut() . '</td>
                <td text-align="center">' . $proExp->getMoisFin() . '-' . $proExp->getAnneeFin() . '</td>
                <td text-align="center">' . $proExp->getEntreprise() . '</td>
                <td text-align="center">' . $proExp->getFonction() . '</td>
            </tr>';
        }
        return $proExperience;
    }

    public function getProExperience (){
        return '<br/><div class="bold_underline">Expérience professionnelle (emplois, stages, jobs étdudiants):</div><br/>
                <table class="t_postBac">
                    <col style="width: 15%">
                    <col style="width: 13%">
                    <col style="width: 37%">
                    <col style="width: 40%">
                    <tr>
                        <th class="col3 center">Date début</th>
                        <th class="col3 center">Date fin</th>
                        <th class="col4 center">Entreprise</th>
                        <th class="col6 center">Fonction</th>
                    </tr> '.
        $this->printProExperience()
        . '</table>';
    }

    public function setOther ($foreignLanguage, $otherElements){
        $this->foreignLanguage      = $foreignLanguage;
        $this->otherElements        = $otherElements;
    }

    public function getOther (){
        return '<br/>
        <div class="bold_underline">Langues étrangères (lu, écrit, parlé) :</div><br/>' . $this->foreignLanguage . '<br/><br/>
        <div class="bold_underline">Autres éléments appuyant votre candidature :</div><br/>' . $this->otherElements . '<br/>';
    }

    public function setInformationsSpecifiques($informationsSpecifiques ){
        $this->informationsSpecifiques = $informationsSpecifiques;
    }

    public function getInformationsSpecifiques (){
        return '<div class="titre_encadre">INFORMATIONS SPECIFIQUES</div><br/>' . $this->informationsSpecifiques;
    }

    public function setDocumentsGeneraux ($documentsGeneraux){
        $this->documentsGeneraux = $documentsGeneraux;
    }

    public function printDocumentsGeneraux (){
        $doc = '<ul>';
        foreach($this->documentsGeneraux as $documentGeneral){
            $doc .= '<li>' . $documentGeneral->getNom() . '<br><br></li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    public function getDocumentsGeneraux (){
        return '<div class="titre_encadre">PIECES A JOINDRE GENERALES</div><br/>'
        . $this->printDocumentsGeneraux();
    }

    public function setDocumentsSpecifiques($documentsSpecifiques){
        $this->documentsSpecifiques = $documentsSpecifiques;
    }

    public function printDocumentsSpecifiques (){
        $doc = '<ul>';
        foreach($this->documentsSpecifiques as $documentSpecifique){
            $doc .= '<li>' . $documentSpecifique->getNom() . '<br><br></li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    public function getDocumentsSpecifiques (){
        return '<div class="titre_encadre">PIECES A JOINDRE SPECIFIQUES</div><br/>'
        . $this->printDocumentsSpecifiques();
    }

    public function getFicheCommissionPeda(){
        return '<div class="titre_encadre">FICHE COMMISSION PEDAGOGIQUE</div><br/>
                <div class="text_align">Commission pédagogique du :………………………………………</div><br/>
                <div>Nom et Prénom du candidat : ' . $this->applicantName . ' ' . $this->applicantFirstName . '</div>
                <br/><div>Demande l’autorisation de s’inscrire en : ' . $this->title2 . '<br/></div><br/>
                <div>Dernier diplôme obtenu : </div><br/>
                <div>Date et lieu : le ' . date("d/m/Y") . ' à </div><br/><br/>
                <img src="./classes/Pdf/img/cadre.png" alt="cadre_administration"/>';
    }

    public function __toString (){
        return $this->getCssPath() .
        $this->getPageBegin() . $this->pagePdfHeader . $this->pagePdfFooter . $this->getFormationTitle() . $this->getDegreeHolder() . $this->getApplicant() . $this->getPlanFormation() . $this->getPageEnd() .
        $this->getNewPage() . $this->getPrevFormation() . $this->getProExperience() . $this->getOther() . $this->getPageEnd() .
        //$this->getNewPage() . $this->getOther() . $this->getPageEnd() .
        $this->getNewPage() . $this->getInformationsSpecifiques() . $this->getPageEnd() .
        // $this->getNewPage() . $this->getDocumentsGeneraux() . $this->getPageEnd() .
        //$this->getNewPage() . $this->getDocumentsSpecifiques() . $this->getPageEnd() .
        //$this->getNewPage() . $this->getDossierModalite() . $this->getPageEnd() .
        $this->getNewPage() . $this->getFicheCommissionPeda() . $this->getPageEnd();
    }
}

