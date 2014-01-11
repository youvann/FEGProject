<?php
/**
 * @Project: FEG Project
 * @File: /classes/Pdf/PagePdf.class.php
 * @Purpose: Construit la page d'un document HTML qui va être transformé en PDF
 * @Author:
 */

class PagePdf{
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

    //
    private $formationName;

    public function __construct($cssPath, $backTop = "30mm", $backBottom = "7mm", $backLeft = "0mm", $backRight = "10mm") {
		$this->backTop    = $backTop;
		$this->backBottom = $backBottom;
		$this->backLeft   = $backLeft;
		$this->backRight  = $backRight;
		$this->cssPath    = $cssPath;
		$this->css        = '<link type="text/css" href="' . $this->cssPath . '" rel="stylesheet" >';
    }

    public function getBegin(){
        return '<page backtop="' . $this->backTop . '" backbottom="' . $this->backBottom . '" backleft="' . $this->backLeft . '" backright="' . $this->backRight . '"> ';
    }

    // public function getEnd (){
    // 	echo "</page> ";
    // }

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
                        <td class="fifty_width_table border-top-none titre2 bold"><img src="./img/miage.png" alt=""></td>
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
                <div id="cadre_candidat">
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
    
    public function setPlanFormation ($formationName){
        $this->formationName = $formationName;
    }
    
    public function getPlanFormation(){
        return '<div class="titre_encadre">FORMATION ENVISAGE</div><br>
                <div class="localisation_parcours">Localisation des parcours</div>
                <br>
                <table class="t_planFormation">
                    <tr>
                        <td class="planFormation bold" text-align="center">Parcours</td>
                        <td class="bold" text-align="center">Aix-en-Provence/Marseille</td>
                    </tr>
                    <tr>
                        <td class="planFormation" text-align="center">' . $this->formationName . '</td>
                        <td text-align="center">Ville</td>
                    </tr>
                </table>';
    }

    public function __toString (){
        return $this->getCssPath() . $this->getBegin() . $this->getFormationTitle() . $this->getDegreeHolder() . $this->getApplicant();
    }
}
