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
    private $title3;
    private $title4;

    // Titulaire
    private $holder1;
    private $holder2;
    private $holder3;
    private $note;

    //Candidat
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

    // Formation envisagé
    private $formationName;
    private $formationPlace;

    // Cursus antérieur
    private $serie;
    private $yearAcquisition;
    private $establishment;
    private $departement;
    private $country;

    private $establishment1;
    private $establishment2;
    private $establishment3;
    private $establishment4;
    private $establishment5;
    private $cursus1;
    private $cursus2;
    private $cursus3;
    private $cursus4;
    private $cursus5;
    private $validate1;
    private $validate2;
    private $validate3;
    private $validate4;
    private $validate5;

    //Expérience professionnelle
    private $job;
    private $stage;
    private $emploi;
    private $contractDurateMonths;
    private $weeklyProportion;
    private $foreignLanguage;
    private $otherElements;

    // Documents généraux
    private $documentsGeneraux = array();

    // Documents spécifiques
    private $documentsSpecifiques = array ();

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

    public function setTitle ($title1, $title2, $title3, $title4){
        $this->title1 = $title1;
        $this->title2 = $title2;
        $this->title3 = $title3;
        $this->title4 = $title4;
    }

    public function setHolder ($holder1, $holder2, $holder3){
        $this->holder1 = $holder1;
        $this->holder2 = $holder2;
        $this->holder3 = $holder3;
    }

    public function setNote ($note){
        $this->note = $note;
    }

    public function getFormationTitle(){
        return '<table class="t_title">
                    <tr>
                        <td colspan="2" class="full_width_table titre3 bold">' . $this->title1 . '</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="full_width_table titre1 bold">' . $this->title2 . '</td>
                    </tr>
                    <tr>
                        <td class="fifty_width_table border-top-none border-right-none titre2 bold" text-align="center">' . $this->title3 . '</td>
                        <td class="fifty_width_table border-top-none titre2 bold"><img src="./pdf/img/miage.png" alt=""></td>
                    </tr>
                    <tr>
                        <td class="titre4 bold" colspan="2">' . $this->title4 . '</td>
                    </tr>
                </table>';
    }

    public function getDegreeHolder(){
        return '<br><form action="">
                    <input type="checkbox" value="titulaire1"><span class="bold note">' . $this->holder1 . '</span><br>
                    <input type="checkbox" value="titulaire2"><span class="bold note">' . $this->holder2 . '</span><br>
                    <input type="checkbox" value="titulaire3"><span class="bold note">' . $this->holder3 . '</span><br>
                </form>
                <p class="note">' . $this->note . '</p>';
    }

    public function setApplicant($applicantName, $applicantFirstName, $applicantBirthDate,
                                 $applicantBirthPlace, $applicantIne, $applicantAdress,
                                 $applicantFixNumber, $applicantPortNumber, $applicantMail,
                                 $applicantActivity) {
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

    public function getApplicant(){
        return '<div class="titre_encadre">CANDIDAT</div>
                <br>
                <form action="">
					<input type="checkbox" value="madame"><span class="bold note">Mme</span>
					<input type="checkbox" value="monsieur"><span class="bold note">M.</span>
                </form>
                <br><br>
                <div class="cadre">
                	<span class="bold">Nom :</span> ' . $this->applicantName . '<br><br>
                    <span class="bold">Prénom :</span> ' . $this->applicantFirstName . '<br><br>
                    <span class="bold">Date de naissance :</span> ' . $this->applicantBirthPlace . '<br><br>
                    <span class="bold">Lieu de naissance :</span> ' . $this->applicantBirthDate . '<br><br>
                    <span class="bold">N° INE (pour étudiants en France) :</span> ' . $this->applicantIne . '
                </div>
                <br>
                <div>
                    <span class="bold">Adresse :</span> ' . $this->applicantAdress . '<br><br>
                    <span class="bold">Tel Fixe :</span> ' . $this->applicantFixNumber . '<br><br>
                    <span class="bold">Tel Portable :</span> ' . $this->applicantPortNumber . '<br><br>
                    <span class="bold">Adresse électronique :</span> ' . $this->applicantMail . '<br><br>
                    <span class="bold">Activité actuelle* (étudiant, salarié, demandeur d\'emploi, autre) :</span> ' . $this->applicantActivity . '<br><br>
                </div>
                <div class="note">
                    *Vous êtes salarié, vous souhaitez bénéficier d\'un congé individuel de formation (CIF, DIF) ou d\'une période professionnalisation, vous êtes demandeur d\'emploi, bénéficiaire du RSA, vous souhaitez effectuer une procédure de VAE ou de VAP, vous avez cessé vos études depuis au moins 2 ans, vous avez suivi un cursus de formation en alternance, vous avez plus de 28 ans : Contactez rapidement le secrétariat de la formation afin que votre dossier et les possibilités de financement vous concernant soient examinés au plus tôt.
                </div>';
    }

    public function setPlanFormation ($formationName, $formationPlace){
        $this->formationName = $formationName;
        $this->formationPlace = $formationPlace;
    }

    public function getPlanFormation(){
        return '<div class="titre_encadre">FORMATION ENVISAGE</div><br>
                <br>
                <table class="t_planFormation">
                    <tr>
                        <td class="border-top-none border-left-none"></td>
                        <td class="bold" text-align="center">Localisation des parcours</td>
                    </tr>
                    <tr>
                        <td class="planFormation bold" text-align="center">Parcours</td>
                        <td class="bold" text-align="center">Aix-en-Provence/Marseille</td>
                    </tr>
                    <tr>
                        <td class="planFormation" text-align="center">' . $this->formationName . '</td>
                        <td text-align="center"> ' . $this->formationPlace . '</td>
                    </tr>
                </table>';
    }

    public function setPrevFormation ($serie, $yearAcquisition, $establishment, $departement, $country, $establishment1, $establishment2, $establishment3, $establishment4, $establishment5, $cursus1, $cursus2, $cursus3, $cursus4, $cursus5, $validate1, $validate2, $validate3, $validate4, $validate5, $annee1, $annee2, $annee3, $annee4, $annee5){
        $this->serie           = $serie;
        $this->yearAcquisition = $yearAcquisition;
        $this->establishment   = $establishment;
        $this->departement     = $departement;
        $this->country         = $country;
        $this->establishment1  = $establishment1;
        $this->establishment2  = $establishment2;
        $this->establishment3  = $establishment3;
        $this->establishment4  = $establishment4;
        $this->establishment5  = $establishment5;
        $this->cursus1         = $cursus1;
        $this->cursus2         = $cursus2;
        $this->cursus3         = $cursus3;
        $this->cursus4         = $cursus4;
        $this->cursus5         = $cursus5;
        $this->validate1       = $validate1;
        $this->validate2       = $validate2;
        $this->validate3       = $validate3;
        $this->validate4       = $validate4;
        $this->validate5       = $validate5;
        $this->annee1          = $annee1;
        $this->annee2          = $annee2;
        $this->annee3          = $annee3;
        $this->annee4          = $annee4;
        $this->annee5          = $annee5;
    }


    public function getPrevFormation (){
        return '<br><br>
                <div class="titre_encadre">CURSUS ANTÉRIEUR</div><br>
                <div class="cadre">
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
                        <tr>
                            <td class="bold" colspan="4" text-align="center">Localisation des parcours</td>
                        </tr>
                        <tr>
                            <th class="col3 center">Année</th>
                            <th class="col5 center">Établissement</th>
                            <th class="col5 center">Cursus suivi</th>
                            <th class="col2 center">Validé</th>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee1.'</td>
                            <td text-align="center">'.$this->establishment1.'</td>
                            <td text-align="center">'.$this->cursus1.'</td>
                            <td text-align="center">'.$this->validate1.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee2.'</td>
                            <td text-align="center">'.$this->establishment2.'</td>
                            <td text-align="center">'.$this->cursus2.'</td>
                            <td text-align="center">'.$this->validate2.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee3.'</td>
                            <td text-align="center">'.$this->establishment3.'</td>
                            <td text-align="center">'.$this->cursus3.'</td>
                            <td text-align="center">'.$this->validate3.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee4.'</td>
                            <td text-align="center">'.$this->establishment4.'</td>
                            <td text-align="center">'.$this->cursus4.'</td>
                            <td text-align="center">'.$this->validate4.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee5.'</td>
                            <td text-align="center">'.$this->establishment5.'</td>
                            <td text-align="center">'.$this->cursus5.'</td>
                            <td text-align="center">'.$this->validate5.'</td>
                        </tr>
                    </table>
                </div>';
    }

    public function setExperiencePro ($job, $stage, $emploi, $contractDurateMonths, $weeklyProportion, $foreignLanguage, $otherElements){
        $this->job                  = $job;
        $this->stage                = $stage;
        $this->emploi               = $emploi;
        $this->contractDurateMonths = $contractDurateMonths;
        $this->weeklyProportion     = $weeklyProportion;
        $this->foreignLanguage      = $foreignLanguage;
        $this->otherElements        = $otherElements;
    }

    public function getExperiencePro (){
        return '<br><br>
        <div class="bold_underline">Expérience professionnelle (emplois, stages):</div><br/>
        <form action="">
            <input type="checkbox" value="job">Jobs étudiants<br>
            <input type="checkbox" value="stage">Stages dans le cadre de vos études : fournir les attestations de stage<br>
            <input type="checkbox" value="emploi">Emploi occupé à temps partiel ou à temps plein (hors statut d’étudiant salarié)<br>
        </form><br/>
        <span>Durée cumulée du ou des contrats (en mois) :</span>'.$this->contractDurateMonths.'<br/>
        <span>Quotité hebdomadaire (en heures) : </span>'.$this->weeklyProportion.'<br/><br/>
        <div class="bold_underline">Langues étrangères (lu, écrit, parlé) :</div><br/>'.$this->foreignLanguage.'<br/><br/>
        <div class="bold_underline">Autres éléments appuyant votre candidature :</div><br/>'.$this->otherElements.'<br/>
        ';
    }

    public function setInformationsSpecifiques (){

    }

    public function getInformationsSpecifiques (){
        return '<div class="titre_encadre">INFORMATIONS SPECIFIQUES</div><br/><br/>';
    }

    public function setDocumentsGeneraux ($documentsGeneraux){
        $this->documentsGeneraux = $documentsGeneraux;
    }

    public function printDocumentsGeneraux (){
        $doc = '<ul>';
        foreach($this->documentsGeneraux as $documentGeneral){
            $doc .= '<li>' . $documentGeneral . '<br><br></li>';
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
            $doc .= '<li>' . $documentSpecifique . '<br><br></li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    public function getDocumentsSpecifiques (){
        return '<div class="titre_encadre">PIECES A JOINDRE SPECIFIQUES</div><br/>'
                . $this->printDocumentsSpecifiques();
    }

    public function getDossierModalite (){
        return '<div class="titre_encadre">DEPOT OU ENVOI DU DOSSIER</div><br/>
                <div class="bold">Nous recommandons aux candidats l’utilisation de la formule « courrier suivi » pour l’envoi du dossier à nos services. Le respect des dates limites mentionnées en page 1 est impératif, le cachet de la Poste faisant foi.<br/><br/>
                Adressez le dossier à : </div><br/>
                <div class="addressFac">IUP MIAGE<br/>
                FACULTE D’ECONOMIE et de GESTION<br/>
                15-19 Allée Claude Forbin<br/>
                13627 Aix-en-Provence Cedex 1</div>

                <br/><div class="italic_underline">Jours et Horaires d’ouverture au public :</div><br/>
                <span>Du lundi au vendredi, de 9h à 12h30 et de 14h à 16h.</span><br/><br/>
                <div class="italic_underline">Contacts :</div>
                <div class="center">Nathalie DI MARTINO <br/>
                     Bureau 2.15.B <br/>
                     Tel : 04 42 21 68 88 <br/>
                     Email : miage.aix@univ-cezanne.fr <br/>
                </div><br/>

                <div class="titre_encadre">Modalités de Candidature</div><br/>
                <div>La procédure de candidature en L3 Gestion parcours MIAGE se fait en deux étapes :
                <ol>
                    <li>Examen du dossier, à l’issue duquel l’admissibilité du candidat est évaluée.</li>
                    <li>Entretien + tests d’aptitudes, à l’issue desquels l’admission est déclarée ou rejetée.</li>
                </ol>
                Lors de l’examen des dossiers, la commission de recrutement prend une décision d’admissibilité. Tous les candidats admissibles reçoivent une convocation pour un entretien et un test d’aptitude qui ont lieu la même demi-journée. Les tests porteront sur des notions de base en <span class="bold">Logique, Algorithmique, Compréhension de Texte, Expression Française et Anglais</span>.
                La date exacte de ces entretiens sera précisée avec la convocation.<br/><br/>
                Après ces entretiens, la commission de recrutement prend une décision d’admission ou de rejet de la candidature. Selon le nombre de places disponibles et la qualité des dossiers, les candidatures sont placées sur une liste principale ou sur une liste d’attente. Tous les candidats sont prévenus par courrier et par e-mail, de l’avis rendu par la commission y compris en ce qui concerne la liste d’affectation (principale ou liste d’attente).
                <br/><br/>
                <span class="bold_underline">Remarques :</span>
                <ul>
                    <li>Votre dossier de candidature doit comprendre l’intégralité des 6 pages de ce dossier et les pièces supplémentaire décrites en page 4.<br/><br/></li>
                    <li>Joindre au dossier une enveloppe timbrée à votre adresse pour communication des résultats d’admissibilité et/ou d’admission.</li>
                </ul>
                </div><br/>';
    }

    public function getFicheCommissionPeda(){
        return '<div class="titre_encadre">FICHE COMMISSION PEDAGOGIQUE</div><br/>
                <div class="text_align">Commission pédagogique du :………………………………………</div><br/>
                <div>Nom et Prénom du candidat : ' . $this->applicantName . ' ' . $this->applicantFirstName . '</div>
                <br/><div>Demande l’autorisation de s’inscrire en :<br/>' . $this->formationName . '</div><br/>
                <div>Dernier diplôme obtenu : </div><br/>
                <div>Date et lieu : le ' . date("d/m/Y") . ' à </div><br/><br/>
                <img src="./pdf/img/cadre.png" alt="cadre_administration"/>';
    }

    public function __toString (){
        return $this->getCssPath() .
        $this->getPageBegin() . $this->pagePdfHeader . $this->pagePdfFooter . $this->getFormationTitle() . $this->getDegreeHolder() . $this->getApplicant() . $this->getPageEnd() .
        $this->getNewPage() . $this->getPlanFormation() . $this->getPrevFormation() . $this->getExperiencePro() . $this->getPageEnd() .
        $this->getNewPage() . $this->getInformationsSpecifiques() . $this->getPageEnd() .
        $this->getNewPage() . $this->getDocumentsGeneraux() . $this->getPageEnd() .
        $this->getNewPage() . $this->getDocumentsSpecifiques() . $this->getPageEnd() .
        $this->getNewPage() . $this->getDossierModalite() . $this->getPageEnd() .
        $this->getNewPage() . $this->getFicheCommissionPeda() . $this->getPageEnd();
    }
}

