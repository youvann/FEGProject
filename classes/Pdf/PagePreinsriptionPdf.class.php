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


    //Candidat
    private $applicantName;
    private $applicantFirstName;
    private $applicantBirthDate;
    private $applicantNationality;
    private $applicantIne;
    private $applicantAdress;
    private $applicantFixNumber;
    private $applicantPortNumber;
    private $applicantMail;

    
    private $applicantBaccalaureateSeries; 
    private $applicantBaccalaureateYear;
    private $applicantBaccalaureateMention;


    // Cursus antérieur
  

    //Expérience professionnelle
    private $job;
    private $stage;
    private $emploi;

    private $contractDurateMonths;
    private $weeklyProportion;
    private $foreignLanguage;
    private $otherElements;
    

    private $avis1;
    private $avis2;

    private $folderDate;


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

    public function setPagePdfHeaderImgPath ($imgPath, $imgPath2){
        $this->pagePdfHeader->setImgPath($imgPath, $imgPath2);
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

    public function setTitle ($folderDate, $title1, $title11, $title2, $title3, $title4){
        $this->folderDate = $folderDate;
        $this->title1 = $title1;
        $this->title11 = $title11;
        $this->title2 = $title2;
        $this->title3 = $title3;
        $this->title4 = $title4;
    }



    public function setNote ($note){
        $this->note = $note;
    }

    public function getFormationTitle(){
        return '    <div class="cadreDate">Dossier reçue le :<br/>' . $this->folderDate . '</div>
                    <div class="center bold">' . $this->title1 . '</div>
                    <div class="center">'      . $this->title11 . '</div><br/><br/>
                    <div class="center bold">' . $this->title2 . '</div><br/><br/>
                    <div class="center bold">' . $this->title3 . '</div>               
                    <div class="center bold cadre">' . $this->title4 . '</div>                                      
                    
                ';
    }


       public function getPieceAjoindre (){
        return '
                <br/><br/><div>Pièces à fournir :</div>
                <ul class="cadre">
                    <li>Un CV (curriculum vitae) sur 1 seule page<br/><br/></li>
                    <li>Les photocopies des relevés de notes des 5 premiers semestres<br/><br/></li>
               </ul>
                ';
    } 
    
    
    
    

    public function setApplicant($applicantName, $applicantFirstName, $applicantBirthDate, $applicantNationality, $applicantIne, $applicantAdress,
                                 $applicantFixNumber, $applicantPortNumber, $applicantMail, $applicantBaccalaureateSeries, $applicantBaccalaureateYear, $applicantBaccalaureateMention
                                 ) {
        $this->applicantName       = $applicantName;
        $this->applicantFirstName  = $applicantFirstName;
        $this->applicantBirthDate  = $applicantBirthDate; 
        $this->applicantNationality = $applicantNationality;
        $this->applicantIne        = $applicantIne;
        $this->applicantAdress     = $applicantAdress;
        $this->applicantFixNumber  = $applicantFixNumber;
        $this->applicantPortNumber = $applicantPortNumber;
        $this->applicantMail       = $applicantMail;
        $this->applicantBaccalaureateSeries = $applicantBaccalaureateSeries;
        $this->applicantBaccalaureateYear = $applicantBaccalaureateYear;
        $this->applicantBaccalaureateMention = $applicantBaccalaureateMention;
    }

    
    
    
    
    
    public function getApplicant(){
        return '<br/><div class="titre_encadre">CANDIDAT</div>
                <br>
                <form action="">
					<input type="checkbox" value="madame"><span class="bold note">Mme</span>
					<input type="checkbox" value="monsieur"><span class="bold note">M.</span>
                </form>
                <br><br>
                <div>
                	<span class="bold">Nom :</span> ' . $this->applicantName . '<br><br>
                    <span class="bold">Prénom :</span> ' . $this->applicantFirstName . '<br><br>
                    <span class="bold">Né(e) le :</span> ' . $this->applicantNationality . '<br><br>
                    <span class="bold">Nationalité :</span> ' . $this->applicantBirthDate . '<br><br>
                    <span class="bold">N° INE (pour étudiants en France) :</span> ' . $this->applicantIne . '
                </div>
                <br>
                <div>
                    <span class="bold">Adresse :</span> ' . $this->applicantAdress . '<br><br>
                    <span class="bold">Tel Fixe :</span> ' . $this->applicantFixNumber . '<br><br>
                    <span class="bold">Tel Portable :</span> ' . $this->applicantPortNumber . '<br><br>
                    <span class="bold">Adresse électronique :</span> ' . $this->applicantMail . '<br><br>
                    <span class="bold">Baccalauréat : Série :</span> ' . $this->applicantBaccalaureateSeries .'    
                    <span class="bold">Année d\'obtention :</span> ' . $this->applicantBaccalaureateYear . '         
                    <span class="bold">Mention :</span> ' . $this->applicantBaccalaureateMention . '     
                </div>
                ';
    }



    public function setFormationDepuisBac ($annee1, $annee2, $annee3, $annee4, $annee5, $establishmentPlace1, $establishmentPlace2, $establishmentPlace3, $establishmentPlace4, $establishmentPlace5, $studyYear1, $studyYear2, $studyYear3, $studyYear4, $studyYear5, $discipline1, $discipline2, $discipline3, $discipline4, $discipline5, $result_mention1, $result_mention2, $result_mention3, $result_mention4, $result_mention5){
        $this->annee1=$annee1;
        $this->annee2=$annee2;
        $this->annee3=$annee3;
        $this->annee4=$annee4;
        $this->annee5=$annee5;
        $this->establishmentPlace1=$establishmentPlace1;
        $this->establishmentPlace2=$establishmentPlace2;
        $this->establishmentPlace3=$establishmentPlace3;
        $this->establishmentPlace4=$establishmentPlace4;
        $this->establishmentPlace5=$establishmentPlace5;
        $this->studyYear1=$studyYear1; 
        $this->studyYear2=$studyYear2;
        $this->studyYear3=$studyYear3;
        $this->studyYear4=$studyYear4;
        $this->studyYear5=$studyYear5;
        $this->discipline1=$discipline1; 
        $this->discipline2=$discipline2;
        $this->discipline3=$discipline3;
        $this->discipline4=$discipline4;
        $this->discipline5=$discipline5;
        $this->result_mention1= $result_mention1;
        $this->result_mention2= $result_mention2;
        $this->result_mention3= $result_mention3;
        $this->result_mention4= $result_mention4;
        $this->result_mention5= $result_mention5;
 
    }


    public function getFormationDepuisBac (){
        return '<br><br>
                <div class="titre_encadre">ETUDES SUPERIEURES DEPUIS LE BACCALAUREAT</div><br>
                <div>
                    
                    <table class="t_postBac2">
                        <tr>
                            <th class="col3 center">Année universitaire</th>
                            <th class="col4 center">Lieu</th>
                            <th class="col5 center">Année d’étude <br/>(DUT,BTS,L1, L2,L3)</th>
                            <th class="col6 center">Discipline</th>
                            <th class="col7 center">Résultat et mention <br/> (1ère ou 2ème chance)</th>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee1.'</td>
                            <td text-align="center">'.$this->establishmentPlace1.'</td>
                            <td text-align="center">'.$this->studyYear1.'</td>
                            <td text-align="center">'.$this->discipline1.'</td>
                            <td text-align="center">'.$this->result_mention1.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee2.'</td>
                            <td text-align="center">'.$this->establishmentPlace2.'</td>
                            <td text-align="center">'.$this->studyYear2.'</td>
                            <td text-align="center">'.$this->discipline2.'</td>
                            <td text-align="center">'.$this->result_mention2.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee3.'</td>
                            <td text-align="center">'.$this->establishmentPlace3.'</td>
                            <td text-align="center">'.$this->studyYear3.'</td>
                            <td text-align="center">'.$this->discipline3.'</td>
                            <td text-align="center">'.$this->result_mention3.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee4.'</td>
                            <td text-align="center">'.$this->establishmentPlace4.'</td>
                            <td text-align="center">'.$this->studyYear4.'</td>
                            <td text-align="center">'.$this->discipline4.'</td>
                            <td text-align="center">'.$this->result_mention4.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->annee5.'</td>
                            <td text-align="center">'.$this->establishmentPlace5.'</td>
                            <td text-align="center">'.$this->studyYear5.'</td>
                            <td text-align="center">'.$this->discipline5.'</td>
                            <td text-align="center">'.$this->result_mention5.'</td>
                        </tr>
                    </table>
                </div>';
    }

    
    public function setStageExpPro ($periode1, $periode2, $periode3, $periode4, $periode5, $compagny1, $compagny2, $compagny3, $compagny4, $compagny5, $place1, $place2, $place3, $place4, $place5, $activityResponsability1, $activityResponsability2, $activityResponsability3, $activityResponsability4, $activityResponsability5, $activityNature1, $activityNature2, $activityNature3, $activityNature4, $activityNature5){
        $this->periode1=$periode1;   
        $this->periode2=$periode2;
        $this->periode3=$periode3;
        $this->periode4=$periode4;
        $this->periode5=$periode5;
        $this->compagny1=$compagny1;
        $this->compagny2=$compagny2;
        $this->compagny3=$compagny3;
        $this->compagny4=$compagny4;
        $this->compagny5=$compagny5;     
        $this->place1=$place1; 
        $this->place2=$place2;
        $this->place3=$place3;
        $this->place4=$place4;
        $this->place5=$place5;
        $this->activityResponsability1=$activityResponsability1; 
        $this->activityResponsability2=$activityResponsability2;
        $this->activityResponsability3=$activityResponsability3;
        $this->activityResponsability4=$activityResponsability4;
        $this->activityResponsability5=$activityResponsability5; 
        $this->activityNature1= $activityNature1;
        $this->activityNature2= $activityNature2;
        $this->activityNature3= $activityNature3;
        $this->activityNature4= $activityNature4;
        $this->activityNature5= $activityNature5;
 
    }


    public function getStageExpPro (){
        return '<br><br>
                <div class="titre_encadre">STAGES et/ou EXPERIENCES PROFESSIONNELLES</div><br>
                <div>
                    
                    <table class="t_postBac2">
                        <tr>
                            <th class="col3 center">Période</th>
                            <th class="col4 center">Entreprise ou organisation</th>
                            <th class="col5 center">Lieu</th>
                            <th class="col6 center">Activité,<br/> responsabilités</th>
                            <th class="col7 center">Nature <br/>(stage ou emploi)</th>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->periode1.'</td>
                            <td text-align="center">'.$this->compagny1.'</td>
                            <td text-align="center">'.$this->place1.'</td>
                            <td text-align="center">'.$this->activityResponsability1.'</td>
                            <td text-align="center">'.$this->activityNature1.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->periode2.'</td>
                            <td text-align="center">'.$this->compagny2.'</td>
                            <td text-align="center">'.$this->place2.'</td>
                            <td text-align="center">'.$this->activityResponsability2.'</td>
                            <td text-align="center">'.$this->activityNature2.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->periode3.'</td>
                            <td text-align="center">'.$this->compagny3.'</td>
                            <td text-align="center">'.$this->place3.'</td>
                            <td text-align="center">'.$this->activityResponsability3.'</td>
                            <td text-align="center">'.$this->activityNature3.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->periode4.'</td>
                            <td text-align="center">'.$this->compagny4.'</td>
                            <td text-align="center">'.$this->place4.'</td>
                            <td text-align="center">'.$this->activityResponsability4.'</td>
                            <td text-align="center">'.$this->activityNature4.'</td>
                        </tr>
                        <tr>
                            <td text-align="center">'.$this->periode5.'</td>
                            <td text-align="center">'.$this->compagny5.'</td>
                            <td text-align="center">'.$this->place5.'</td>
                            <td text-align="center">'.$this->activityResponsability5.'</td>
                            <td text-align="center">'.$this->activityNature5.'</td>
                        </tr>
                    </table>
                </div>';
    }
    
    
    
    
    
    
    
    public function setExperiencePro ($job, $stage, $emploi, $contractDurateMonths, $weeklyProportion, $foreignLanguage, $otherElements){
        $this->job = $job;
        $this->stage = $stage;
        $this->emploi = $emploi;
        $this->contractDurateMonths = $contractDurateMonths;
        $this->weeklyProportion = $weeklyProportion;
        $this->foreignLanguage = $foreignLanguage;
        $this->otherElements = $otherElements;
    }


    
    public function getAdequationCompetence()  //cette fonction est utilisée dans la fonction getPartieAdministration()
    {
         return '
             <div>
                    
                    <table>
                        <tr>
                            <th rowspan="2">Compétences et savoirs disciplinaires</th>
                            <th colspan="3">Adéquation du profil du candidat</th>  
                        </tr>
                        <tr> 
                            <td>FORTE</td>
                            <td>MOYENNE</td>
                            <td>FAIBLE</td>
                        </tr>
                        <tr>
                            <td colspan="4">Généraux *</td>
                        </tr>
                        <tr>
                            <td class="alinea">Économie</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>   
                        <tr>
                            <td class="alinea">Gestion</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Statistiques</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Politiques économiques et sociales</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td colspan="4">Spécifiques **</td>
                        </tr>  
                        <tr>
                            <td class="alinea">Approches territoriales</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Economie publique</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Développement</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Analyses de marché et stratégiques</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        <tr>
                            <td class="alinea">Professionnalisation</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>  
                        </table>
         </div>';
    }
    
    public function setPartieAdministration($avis1, $avis2){
            $this->avis1 = $avis1;
            $this->avis2 = $avis2;
        
    }

 

    public function getPartieAdministration(){
        return '<div class="titre_encadre">PARTIE RESERVEE A L’ADMINISTRATION</div><br/>
                <div>AVIS D’OPPORTUNITE SUR LA DEMANDE D’INSCRIPTION (avis consultatif en fonction de l’adéquation du profil aux attendus du diplôme)</div><br/>
              
                '. $this->getAdequationCompetence().'


                <br/><div class="italic">* La présence de compétences et de savoirs généraux est jugée par rapport aux référentiels de Licence AES, d’Économie et de Management.</div><br/>
                <div class="italic">** La présence de compétences et de savoirs spécifiques est un élément supplémentaire qui vient renforcer l’adéquation du profil aux attendus du diplôme.</div>
                <br/><br/><br/><div>REMARQUES et AVIS D’OPPORTUNITÉ:</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    
                <div>AVIS DE LA COMMISSION PEDAGOGIQUE CONCERNANT LA DEMANDE D’INSCRIPTION EN M1</div>
                <form action="">
                    <input type="checkbox" value="avis1">CONSEILLE<span class="bold note"> ' . $this->avis1 . '</span>
                    <input type="checkbox" value="avis2"> DECONSEILLE<span class="bold note">' . $this->avis2 . '</span><br>
                </form>
                
                <br/><br/><br/><br/><br/><br/><div>REMARQUES:</div><br/><br/><br/><br/>

';
    }

    public function __toString (){
        return $this->getCssPath() .
        $this->getPageBegin() . $this->pagePdfHeader . $this->pagePdfFooter . $this->getFormationTitle() . $this->getPieceAjoindre() . $this->getApplicant()  . $this->getPageEnd() .
        $this->getNewPage()   .  $this->getFormationDepuisBac() . $this->getStageExpPro() . $this->getPageEnd() .
        $this->getNewPage()  . $this->getPartieAdministration() . $this->getPageEnd();
    }
}

?>