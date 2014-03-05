<?php
/**
 * @Project: FEG Project
 * @File   : /classes/Pdf/PagePdf.class.php
 * @Purpose: Construit la page d'un document HTML qui va être transformé en PDF
 * @Author : Kevin Meas & Hasan Karakoz
 */

require_once 'PagePdfHeader.class.php';
require_once 'PagePdfFooter.class.php';

class PagePdf {
    private $pagePdfHeader;
    private $pagePdfFooter;

    private $backTop;
    private $backBottom;
    private $backLeft;
    private $backRight;
    private $cssPath;
    private $css;

    private $isCandidature;
    private $isPrev;

    private $numInscription;
    // Url pièces manquantes
    private $urlPiecesmanquantes;

    // Titre
    private $title1;
    private $title2;
    private $logoPath = "";

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
    private $dernierDiplome;
    //private $anneeDernierDiplome;

    // Formation envisagé
    private $etapes = array ();
    private $villePreferee;

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
    private $informationsSpecifiques = array ();
    private $typeInformations = array ();

    private $rowAdmin;
    private $tableauVoeux = array ();
    private $voeuxMultiple;

    // Modalités
    private $modalites;

    // Informations
    private $informations;

    public function __construct ($cssPath, $backTop = "30mm", $backBottom = "7mm", $backLeft = "0mm", $backRight = "10mm") {
        $this->pagePdfHeader = new PagePdfHeader();
        $this->pagePdfFooter = new PagePdfFooter();

        $this->backTop    = $backTop;
        $this->backBottom = $backBottom;
        $this->backLeft   = $backLeft;
        $this->backRight  = $backRight;
        $this->cssPath    = $cssPath;
        $this->css        = '<link type="text/css" href="' . DIRNAME (__FILE__) . '/' . $cssPath . '" rel="stylesheet" >';
        //$this->css = '<link type="text/css" href="' . $cssPath . '" rel="stylesheet" >';
    }

    public function setPagePdfHeaderImgPath ($imgPath) {
        $this->pagePdfHeader->setImgPath ($imgPath);
    }

    public function setPagePdfHeaderText ($headerText) {
        $this->pagePdfHeader->setHeadertext ($headerText);
    }

    public function setPagePdfFooterText ($footerText) {
        $this->pagePdfFooter->setFooterText ($footerText);
    }

    public function getPageBegin () {
        return '<page backtop="' . $this->backTop . '" backbottom="' . $this->backBottom . '" backleft="' . $this->backLeft . '" backright="' . $this->backRight . '"> ';
    }

    public function getNewPage () {
        return '<page pageset="old">';
    }

    public function getPageEnd () {
        return "</page> ";
    }

    public function getCssPath () {
        return '<style type="text/css">
            table { border-collapse: collapse; }

            .full_width_table{ width: 700px; font-size : 18px; }

            .t_title .full_width_table{ width: 690px; font-size : 18px; }

            .fifty_width_table{ width: 339px; }

            td, th { border: 1px solid black; padding-left: 3px; padding-right: 3px; }

            .t_header img{ height: 80px; width: 300px; }

            .t_title img{ height: 85px; width: 200px; }

            .border-top-none{ border-top: none; }

            .border-right-none{ border-right: none; }

            .border-left-none{ border-left: none; }

            .border-bottom-none{ border-bottom: none; }

            .no-border{ border: none; }

            .bold{ font-weight: bold; }

            .titre1{ font-size: 40px; }

            .titre2{ font-size: 30px; }

            .titre3{ font-size: 20px; }

            .titre4{ font-size: 18px; }

            .titre5{ font-size: 15px; }

            .small { font-size: 12px; }

            page{ font-size: 13px; }

            .note{ font-size: 12px; text-align: justify; }

            .titre_encadre { padding: 3px; border: 1px solid black;  width: 699px; font-family: verdanab; background-color: #F1F1F1; }

            .cadre{ padding: 5px; border: 1px solid black; width: 700px; }

            .localisation_parcours{ padding: 5px; border: 1px solid black; width: 190px; font-family: verdanab; }

            .center{ text-align: center; }

            .planFormation{ width:490px; }

            .t_postBac .col2{ width: 75px; }
            .t_postBac .col3{ width: 100px; }
            .t_postBac .col4{ width: 180px; }
            .t_postBac .col5{ width: 240px; }
            .t_postBac .col6{ width: 270px; }
            .t_postBac2 .col3{ width: 100px; }
            .t_postBac2 .col4{ width: 130px; }
            .t_postBac2 .col6{ width: 130px; }
            .t_postBac2 .col7{ width: 140px; }

            .bold_underline{ text-decoration: underline; font-weight: bold; }

            .underline{ text-decoration: underline; }

            .italic_underline{ font-style: italic; text-decoration: underline; }

            .italic{ font-style: italic; }

            .addressFac{ padding: 5px; border: 1px solid black; font-size: 20px; text-align: center; font-weight: bold; }

            .text_align{ text-align: right; }

            .alinea{ margin-left: 20px; padding-left: 20px; }

            .cadreDate{ padding: 5px; border: 1px solid black; width: 120px; }

            .cadreRouge { border-top: 20px solid red; border-bottom: 20px solid red; border-right: 10px solid red; border-left: 10px solid red; padding: 5px; }

            .largeur{width:700px;}

            </style>';

    }

    public function setCssPath ($cssPath) {
        $this->cssPath = $cssPath;
        $this->css     = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
    }

    public function setIsCandidature ($isCandidature) {
        $this->isCandidature = $isCandidature;
    }

    public function getIsCandidature () {
        return $this->isCandidature;
    }

    public function setIsPrev($isPrev){
        $this->isPrev = $isPrev;
    }

    public function getIsPrev(){
        return $this->isPrev;
    }

    public function isCandidature () {
        if ($this->isCandidature) {
            return $this->getOther () . $this->getPageEnd() . $this->getNewPage () . $this->getInformationsSpecifiques ();
        }
    }

    public function getNumInscription (){
        return $this->numInscription;
    }

    public function setNumInscription($numInscription){
        $this->numInscription = $numInscription;
    }

    public function printNumInscription (){
        return "<span><b>Votre numéro d'inscription : </b>".$this->numInscription."</span>";
    }

    public function geturlPiecesmanquantes (){
        return $this->urlPiecesmanquantes;
    }

    public function printUrlPiecesmanquantes (){
        return "<div><b>Si vous avez oublié de nous transmettre des documents, veuillez cliquer sur ce <a href='".$this->urlPiecesmanquantes."'>lien</a>.</b></div>";
    }

    public function setUrlPiecesManquantes($urlPiecesmanquantes){
        $this->urlPiecesmanquantes = $urlPiecesmanquantes;
    }

    public function setTitle ($title1, $title2) {
        $this->title1 = $title1;
        $this->title2 = $title2;
    }

    public function setHolder ($holder1, $holder2, $holder3, $checkboxHolder) {
        $this->holder1        = $holder1;
        $this->holder2        = $holder2;
        $this->holder3        = $holder3;
        $this->checkboxHolder = $checkboxHolder;
    }

    public function setNote ($note) {
        $this->note = $note;
    }

    public function setLogoPath ($logoPath) {
        $this->logoPath = $logoPath;
    }

    public function getDernierDiplome(){
        return $this->dernierDiplome;
    }

    public function setDernierDiplome($dernierDiplome){
        $this->dernierDiplome = $dernierDiplome;
    }

    public function getLogo () {
        if ($this->logoPath == "") {
            return '<td></td>';
        } else {
            return '<td class="border-left-none"><img style:"width=200; height=auto;" src=" ' . $this->logoPath . '" /></td>';
        }
    }

    public function getFormationTitle () {
        // <td class="fifty_width_table border-left-none border-top-none titre2"><img src="./pdf/img/miage.png" alt=""></td>
        return '<table class="t_title">
                    <tr>
                        <td colspan="2" class="full_width_table titre3 bold">' . $this->title1 . '</td>
                    </tr>
                    <tr>
                        <td class="fifty_width_table titre1 border-right-none">' . $this->title2 . '</td>
                        ' . $this->getLogo () . '
                    </tr>
                </table>';
    }

    public function numHolder ($num) {
        switch ($num) {
            case 1 :
            {
                return $this->holder1;
            }
                break;
            case 2 :
            {
                return $this->holder2;
            }
                break;
            case 3 :
            {
                return $this->holder3;
            }
                break;
            default:
                break;
        }
    }

    public function getDegreeHolder () {
        $checkbox = '<br/><span class="note bold">' . $this->numHolder ($this->checkboxHolder) . '</span><br/><br/>';
        if ($this->checkboxHolder == 3) {
            $checkbox .= '<p class="note">' . $this->note . '</p>';
        }
        return $checkbox;
    }

    public function setApplicant ($applicantSex, $applicantName, $applicantFirstName, $applicantBirthDate, $applicantBirthPlace, $applicantIne, $applicantAdress, $applicantFixNumber, $applicantPortNumber, $applicantMail, $applicantActivity) {
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

    public function setPhotoPath ($photoPath) {
        $this->photoPath = $photoPath;
    }

    public function getPhotoPath () {
        return '<img src="' . $this->photoPath . '" alt="cadre_administration" style="width: 150px"/>';
    }


    public function getApplicant () {
        return '<div class="titre_encadre">CANDIDAT</div>
                <br>
                ' . $this->printUrlPiecesmanquantes() .
                '<br/>' . $this->printNumInscription() .'<br/><br/>
                <span class="bold">' . $this->applicantSex . '</span>
                <br><br>
                <table>
                    <col style="width: 105%">
                    <tr>
                        <td>
                            <span class="bold">Nom :</span> ' . $this->applicantName . '<br><br>
                            <span class="bold">Prénom :</span> ' . $this->applicantFirstName . '<br><br>
                            <span class="bold">Date de naissance :</span> ' . $this->applicantBirthPlace . '<br><br>
                            <span class="bold">Lieu de naissance :</span> ' . $this->applicantBirthDate . '<br><br>
                            <span class="bold">N° INE (pour étudiants en France) :</span> ' . $this->applicantIne . '
                        </td>
                    </tr>
                </table>
                <br>
                <div>
                    <span class="bold">Adresse :</span> ' . $this->applicantAdress . '<br><br>
                    <span class="bold">Tel Fixe :</span> ' . $this->applicantFixNumber . '<br><br>
                    <span class="bold">Tel Portable :</span> ' . $this->applicantPortNumber . '<br><br>
                    <span class="bold">Adresse électronique :</span> ' . $this->applicantMail
                    . $this->getActivity() . '
                    <br><br>
                </div>';
    }

    public function getActivity (){
        return ($this->isCandidature) ? '<br><br><span class="bold" > Activité actuelle (étudiant, salarié, demandeur d\'emploi, autre) :</span> ' . $this->applicantActivity : "";
    }

    public function setPlanFormation ($etapes, $villePreferee) {
        $this->etapes        = $etapes;
        $this->villePreferee = $villePreferee;
    }

    /*public function printVillesPossibles () {
        $villes = '';
        foreach ($this->villesPossibles as $villePossible) {
            $villes .= $villePossible . ' ';
        }
        return $villes;
    }*/

    public function printPlanFormation () {
        $nomEtapeOrdre = '';
        foreach ($this->etapes as $ordre => $etape) {
            $nomEtapeOrdre .= '<tr><td text-align="center">' . $ordre . '</td>' . '<td>' . $etape . '</td></tr>';
        }
        return $nomEtapeOrdre;
    }

    public function getPlanFormation () {
        return '<br/><div class="titre_encadre">FORMATION ENVISAGE</div><br>
                <table>
                    <col style="width: 8%">
                    <col style="width: 97%">

                    <thead>
                        <tr>
                            <th text-align="center">Ordre</th>
                            <th text-align="center">Parcours</th>
                        </tr>
                    </thead>
                    ' . $this->printPlanFormation () . '
                </table>
                <br/>
                <span class="bold">Ville préférée :</span> ' . $this->villePreferee;
    }

    // <td class="planFormation" text-align="center">' . $this->formationName . '</td>
    // <td text-align="center"> ' . $this->formationPlace . '</td>

    public function setPrevFormation ($serie, $yearAcquisition, $establishment, $departement, $country, $cursusPostBac) {
        $this->serie           = $serie;
        $this->yearAcquisition = $yearAcquisition;
        $this->establishment   = $establishment;
        $this->departement     = $departement;
        $this->country         = $country;
        $this->cursusPostBac   = $cursusPostBac;
    }

    public function printValide($cpb){
        return ($cpb->getValide ()) ? "Oui" : "Non";
    }

    public function printPostBac () {
        $postBac = '';
        foreach ($this->cursusPostBac as $cpb) {
            $postBac .= '<tr>
                <td text-align="center">' . $cpb->getAnneeDebut () . '-' . $cpb->getAnneeFin () . '</td>
                <td text-align="center">' . $cpb->getEtablissement () . '</td>
                <td text-align="center">' . $cpb->getCursus () . '</td>
                <td text-align="center">' . $cpb->getNote () . '</td>
                <td text-align="center">' . $this->printValide($cpb) . '</td>
            </tr>';
        }
        return $postBac;
    }

    public function getPrevFormation () {
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
                    <table class="t_postBac">
                        <col style="width: 13%">
                        <col style="width: 30%">
                        <col style="width: 30%">
                        <col style="width: 15%">
                        <col style="width: 10%">
                        <tr>
                            <th class="bold" colspan="5" text-align="center">Cursus Post-Bac</th>
                        </tr>
                        <tr>
                            <th class="center">Année</th>
                            <th class="center">Établissement</th>
                            <th class="center">Cursus suivi</th>
                            <th class="center">Resultat</th>
                            <th class="center">Validé</th>
                        </tr>' . $this->printPostBac () . '</table>
    </div>';
    }

    public function setProExperience ($proExperience) {
        $this->proExperience = $proExperience;
    }

    public function printProExperience () {
        $proExperience = '';
        foreach ($this->proExperience as $proExp) {
            $proExperience .= '<tr>
                <td text-align="center">' . $proExp->getMoisDebut () . '-' . $proExp->getAnneeDebut () . '</td>
                <td text-align="center">' . $proExp->getMoisFin () . '-' . $proExp->getAnneeFin () . '</td>
                <td text-align="center">' . $proExp->getEntreprise () . '</td>
                <td text-align="center">' . $proExp->getFonction () . '</td>
            </tr>';
        }
        return $proExperience;
    }

    public function getProExperience () {
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
                    </tr> ' . $this->printProExperience () . '</table>';
    }

    public function setOther ($foreignLanguage, $otherElements) {
        $this->foreignLanguage = $foreignLanguage;
        $this->otherElements   = $otherElements;
    }

    public function getOther () {
        return '<br/>
        <div class="bold_underline">Langues étrangères (lu, écrit, parlé) :</div><br/>' . $this->foreignLanguage . '<br/><br/>
        <div class="bold_underline">Autres éléments appuyant votre candidature :</div><br/>' . $this->otherElements . '<br/>';
    }

    public function setTypeInformations ($typeInformations) {
        $this->typeInformations = $typeInformations;
    }

    public function setInformationsSpecifiques ($informationsSpecifiques) {
        $this->informationsSpecifiques = $informationsSpecifiques;
    }

    public function getInformationsSpecifiques () {
        if($this->isPrev){
            $informationsSpecifiquesLibelles = "";
            $i                               = 0;
            foreach ($this->informationsSpecifiques as $informationSpecifique) {
                $type = "";
                switch ($this->typeInformations[$i++]) {
                    // Dossier PDF prévisualisation
                    case "CheckBox":
                        $type = "Case à cocher";
                        break;
                    case "CheckBoxGroup":
                        $type = "Groupe de cases à cocher";
                        break;
                    case "TextBox":
                        $type = "Champ texte";
                        break;
                    case "RadioButton":
                        $type = "Bouton radio";
                        break;
                    case "RadioButtonGroup":
                        $type = "Groupe de boutons radio";
                        break;
                    case "TextArea":
                        $type = "Champ texte multiligne";
                        break;
                }
                $informationsSpecifiquesLibelles .= "<b>" . $informationSpecifique . "</b> :<br/><i>" . $type . "</i><br/><br/>";

            }
            return '<div class="titre_encadre">INFORMATIONS SPECIFIQUES A LA FORMATION</div><br/>' . $informationsSpecifiquesLibelles;
        }else{
            return '<div class="titre_encadre">INFORMATIONS SPECIFIQUES A LA FORMATION</div><br/>' . $this->informationsSpecifiques;
        }
    }

    public function setDocumentsGeneraux ($documentsGeneraux) {
        $this->documentsGeneraux = $documentsGeneraux;
    }

    public function printDocumentsGeneraux () {
        $doc = '<ul>';
        foreach ($this->documentsGeneraux as $documentGeneral) {
            $doc .= '<li>' . $documentGeneral->getNom () . '<br><br></li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    public function getDocumentsGeneraux () {
        return '<div class="titre_encadre">PIECES A JOINDRE GENERALES</div><br/>' . $this->printDocumentsGeneraux ();
    }

    public function setDocumentsSpecifiques ($documentsSpecifiques) {
        $this->documentsSpecifiques = $documentsSpecifiques;
    }

    public function printDocumentsSpecifiques () {
        $doc = '<ul>';
        foreach ($this->documentsSpecifiques as $documentSpecifique) {
            $doc .= '<li>' . $documentSpecifique->getNom () . '<br><br></li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    public function getDocumentsSpecifiques () {
        return '<div class="titre_encadre">PIECES A JOINDRE SPECIFIQUES</div><br/>' . $this->printDocumentsSpecifiques ();
    }

    public function getDossierModalites () {
        return '<div class="titre_encadre">MODALITES</div>' . $this->modalites;
    }

    public function setDossierModalites ($modalites) {
        $this->modalites = $modalites;
    }

    public function getDossierInformations () {
        return '<div class="titre_encadre">INFORMATIONS</div>' . $this->informations;
    }

    public function setDossierInformations ($informations) {
        $this->informations = $informations;
    }

    public function setRowAdmin ($rowAdmin) {
        $this->rowAdmin = $rowAdmin;
    }

    public function getRowAdmin ($rowAdmin) {
        if ($rowAdmin) {
            return '<img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Proposition admission en niveau inférieur<br/>
                    ………………………………………………………………………………………………………………………………………<br/>
                    ………………………………………………………………………………………………………………………………………<br/><br/>';

        }
    }

    public function getCadreSemester () {
        return $this->voeuxMultiple . '<br><br><img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/>  S1
                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/>  S2';
    }

    public function getCadreAdministration () {
        return '<div class="cadreRouge"><span class="titre5 bold_underline">CADRE RESERVE A L’ADMINISTRATION</span><br/><br/>
                <div class="bold_underline">AVIS DU RESPONSABLE PEDAGOGIQUE DE LA FORMATION :</div><br/>
                <form method="POST" action="" class="small">
                    <table class="table_cadre">
                    <col style="width: 10%">
                    <col style="width: 30%">
                    <col style="width: 60%">
                        <tr>
                            <th style="border-top:none;border-left:none;" colspan="2"></th>
                            <th class="center">UE bénéficiant de la dispense</th>
                        </tr>
                        ' . $this->getVoeux ($this->tableauVoeux, $this->voeuxMultiple) . '
                        <tr>
                            <td class="center bold" colspan="2">Motif du refus</td>
                            <td>
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Les études antérieures ne sont pas adaptées au cursus envisagé<br/><br/>
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Le niveau est insuffisant pour la formation envisagée<br/><br/>
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Le niveau est jugé trop juste en français<br/><br/>
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Autre motif:<br/>
                                ………………………………………………………………………………
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">' . $this->getRowAdmin ($this->rowAdmin) . '</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Suggestion éventuelle de réorientation<br/>
                                ………………………………………………………………………………………………………………………………………<br/>
                                ………………………………………………………………………………………………………………………………………<br/>
                                ………………………………………………………………………………………………………………………………………
                            </td>
                        </tr>
                        <tr>
                             <td colspan="3">Nom et signature<br/><br/><br/></td>
                        </tr>
                        </table>
                    </form><br/>
                     <div class="bold_underline">DECISION DE LA COMMISSION PEDAGOGIQUE de la faculté d’économie et de gestion</div><br>
                <table class="small">
                    <col style="width: 33%">
                    <col style="width: 33%">
                    <col style="width: 33%">
                    <tr>
                        <td class="no-border bold">
                            <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> ADMIS
                        </td>
                        <td class="no-border bold">
                            <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> REFUSE
                        </td>
                        <td class="no-border bold">
                            <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> LISTE D’ATTENTE
                        </td>
                    </tr>
                </table>
                <br/>
                <div class="underline small">Motif du refus</div><br>
                 <div class="small">
                    <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Les études antérieures ne sont pas adaptées au cursus envisagé<br/><br/>
                    <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Le niveau est insuffisant pour la formation envisagée<br/><br/>
                    <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Le niveau est jugé trop juste en français<br/><br/>
                    <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Autre motif
                </div>
                </div>';
    }

    public function getCadreAdministration2 () {
        return '<br/><div class="cadreRouge">

                </div>';
    }

    public function setVoeuxMultiple ($voeuxMultiple) {
        $this->voeuxMultiple = $voeuxMultiple;
    }

    public function getVoeux ($voeux, $voeuxMultiple) {
        $voeuxFormation = '';
        if ($voeuxMultiple) {
            foreach ($voeux as $element) {
                $voeuxFormation .= '  <tr>
                        <td><img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Admis<br/>
                        <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Refusé</td>
                        <td>' . $element . '</td>
                        <td></td>
                        </tr>';
            }
        } else {
            $voeuxFormation = '<tr>
                            <td width="100">
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Admis
                            </td>
                            <td width="100">
                                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Refusé
                            </td>
                            <td class="border-bottom-none"></td>
                        </tr>
                        <tr>
                            <td colspan="2" width="200">' . $this->getCadreSemester () . '<br/></td>
                            <td></td>
                        </tr>';
        }
        return $voeuxFormation;
    }

    public function setCadreAdministrationVoeux ($tableauVoeux) {
        $this->tableauVoeux = $tableauVoeux;
    }

    public function getFicheCommissionPeda () {
        return '<div class="titre_encadre">FICHE COMMISSION PEDAGOGIQUE</div><br/>
                <div class="text_align">Commission pédagogique du :………………………………………</div><br/>
                <div>Nom et Prénom du candidat : ' . $this->applicantName . ' ' . $this->applicantFirstName . '</div>
                <br/><div>Demande l’autorisation de s’inscrire en : ' . $this->title2 . '<br/></div><br/>
                <div>Dernier diplôme obtenu : ' . $this->dernierDiplome . '</div><br/>
                <div>Date et lieu : le ' . date ("d/m/Y") . ' à </div><br/>';
    }

    public function __toString () {
        return $this->getCssPath () . $this->getPageBegin () . $this->pagePdfHeader . $this->pagePdfFooter . $this->getFormationTitle () . $this->getDegreeHolder () . $this->getApplicant () . $this->getPlanFormation () . $this->getPageEnd () .
               $this->getNewPage () . $this->getPrevFormation () . $this->getProExperience () .
               $this->isCandidature () . $this->getPageEnd () .
               $this->getNewPage () . $this->getDossierModalites () . $this->getDossierInformations () . $this->getPageEnd () .
               $this->getNewPage () . $this->getFicheCommissionPeda () . $this->getCadreAdministration () . $this->getPageEnd ();
    }
}

