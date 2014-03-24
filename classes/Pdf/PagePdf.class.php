<?php
/**
 * Génère un document PDF
 *
 * @Project: FEG Project
 * @File   : /classes/Pdf/PagePdf.class.php
 * @Purpose: Construit la page d'un document HTML qui va être transformé en PDF
 * @Author : Kevin Meas & Hasan Karakoz
 */

require_once 'PagePdfHeader.class.php';
require_once 'PagePdfFooter.class.php';

class PagePdf {
    /**
     * @var string PagePdfHeader Texte de l'en-tête PDF
     */
    private $pagePdfHeader;
    /**
     * @var string PagePdfFooter Texte du pied de page PDF
     */
    private $pagePdfFooter;
    /**
     * @var int Marge haute du PDF
     */
    private $backTop;
    /**
     * @var int Marge basse du PDF
     */
    private $backBottom;
    /**
     * @var int Marge gauche du PDF
     */
    private $backLeft;
    /**
     * @var int Marge droite du PDF
     */
    private $backRight;
    /**
     * @var boolean Indique si le dossier est une candidature ou une pré-inscription
     */
    private $isCandidature;
    /**
     * @var boolean Indique si le dossier est créé pour une prévisualisation ou pour l'étudiant
     */
    private $isPrev;
    /**
     * @var int Numéro d'inscription qui permet d'identifier un étudiant et son dossier
     */
    private $numDossier;
    /**
     * @var string URL qui permet d'ajouter les pièces manquantes
     */
    private $urlPiecesmanquantes;
    /**
     * @var string Titre 1 (Institut supérieur en sciences de Gestion)
     */
    private $title1;
    /**
     * @var string Titre 2 (Licence 3 informatique parcours MIAGE)
     */
    private $title2;
    /**
     * @var string Chemin du logo du PDF
     */
    private $logoPath = "";

    // Titulaire
    private $holder1;
    private $holder2;
    private $holder3;
    private $checkboxHolder;
    private $note;
    private $dateLimite;

    /**
     * @var string Sexe du candidat
     */
    private $applicantSex = "Madame/Monsieur";
    /**
     * @var string Nom du candidat
     */
    private $applicantName;
    /**
     * @var string Prénom du candidat
     */
    private $applicantFirstName;
    /**
     * @var string Date de naissance du candidat
     */
    private $applicantBirthDate;
    /**
     * @var string Lieu de naissance du candidat
     */
    private $applicantBirthPlace;
    /**
     * @var int Numéro INE du candidat
     */
    private $applicantIne;
    /**
     * @var string Adresse du candidat
     */
    private $applicantAdress;
    /**
     * @var int Téléphone fixe du candidat
     */
    private $applicantFixNumber;
    /**
     * @var int Numéro de portable du candidat
     */
    private $applicantPortNumber;
    /**
     * @var string Courriel du candidat
     */
    private $applicantMail;
    /**
     * @var string Activité du candidat
     */
    private $applicantActivity;
    /**
     * @var string Dernier diplôme du candidat
     */
    private $dernierDiplome;
    /*
     * @var Tableau de string qui contient les étapes
     */
    private $etapes = array ();
    /**
     * @var string Indique la ville préférée de l'étudiant pour sa candidature
     */
    private $villePreferee;
    /**
     * @var string Filière du BAC
     */
    private $serie;
    /**
     * @var int Date d'obtention du BAC
     */
    private $yearAcquisition;
    /**
     * @var string Etablissement du BAC
     */
    private $establishment;
    /**
     * @var string Département du BAc
     */
    private $departement;
    /**
     * @var string Pays du BAC
     */
    private $country;
    /**
     * @var array Tableau qui contient le parcours post-bac de l'étudiant
     */
    private $cursusPostBac = array ();
    /**
     * @var array Tableau qui contient les expériences professionnelles de l'étudiant
     */
    private $proExperience = array ();
    /**
     * @var string Langues étrangères de l'étudiant
     */
    private $foreignLanguage;
    /**
     * @var string Indique les autres éléments
     */
    private $otherElements;
    /**
     * @var array Contient les informations spécifiques
     */
    private $informationsSpecifiques = array ();
    /**
     * @var array Indique de quels types sont les informations spécifiques
     *            Ex : checkbox, textbx, radiobox ...
     */
    private $typeInformations = array ();
    /**
     * @var string contient les informations préalabes du dossier
     */
    private $informationsPrealables;
    /**
     * @var string Contient les modalités de la formation
     */
    private $modalites;
    /**
     * @var string Contient les informations de la formation
     */
    private $informations;
    /**
     * @var boolean Indique s'il faut afficher la ligne "Proposition admission en niveau inférieur"
     *              dans la fiche de commission pédagogique
     */
    private $rowAdmin;
    /**
     * @var array Contient les voeux qui sont affichés dans la fiche de commission pédagogique
     */
    private $tableauVoeux = array ();
    /**
     * @var boolean Indique si l'on souhaite afficher plusieurs voeux ou non dans
     *              la fiche de comission pédagogique
     */
    private $voeuxMultiple;

    /**
     * Construit une page PDF avec une en-tête, un pied de page et un contenu vide
     *
     * @param        $cssPath
     * @param string $backTop
     * @param string $backBottom
     * @param string $backLeft
     * @param string $backRight
     */
    public function __construct ($cssPath, $backTop = "30mm", $backBottom = "7mm", $backLeft = "0mm", $backRight = "10mm") {
        $this->pagePdfHeader = new PagePdfHeader();
        $this->pagePdfFooter = new PagePdfFooter();

        $this->backTop    = $backTop;
        $this->backBottom = $backBottom;
        $this->backLeft   = $backLeft;
        $this->backRight  = $backRight;
        $this->cssPath    = $cssPath;
    }

    /**
     * Définit le chemin l'image qui est dans l'en-tête du PDF
     *
     * @param $imgPath string
     */
    public function setPagePdfHeaderImgPath ($imgPath) {
        $this->pagePdfHeader->setImgPath ($imgPath);
    }

    /**
     * Définit le texte de l'en-tête du PDF
     *
     * @param $headerText string
     */
    public function setPagePdfHeaderText ($headerText) {
        $this->pagePdfHeader->setHeadertext ($headerText);
    }

    /**
     * Définit le texte du pied de page du PDF
     *
     * @param $footerText string
     */
    public function setPagePdfFooterText ($footerText) {
        $this->pagePdfFooter->setFooterText ($footerText);
    }

    /**
     * Définit la première page du PDF
     *
     * @return string
     */
    public function getPageBegin () {
        return '<page backtop="' . $this->backTop . '" backbottom="' . $this->backBottom . '" backleft="' . $this->backLeft . '" backright="' . $this->backRight . '"> ';
    }

    /**
     * Définit une nouvelle page PDF
     *
     * @return string
     */
    public function getNewPage () {
        return '<page pageset="old">';
    }

    /**
     * Définit la fin de la page PDF
     *
     * @return string
     */
    public function getPageEnd () {
        return "</page> ";
    }

    /**
     * Définit le style CSS de la page PDF
     *
     * @return string
     */
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

            .titre_encadre { padding: 3px; border: 1px solid black;  width: 699px; background-color: #F1F1F1; }

            .cadre{ padding: 5px; border: 1px solid black; width: 700px; }

            .localisation_parcours{ padding: 5px; border: 1px solid black; width: 190px; }

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

    /**
     * Définit si le dossier est une candidature ou une pré-inscription
     *
     * @param $isCandidature boolean
     */
    public function setIsCandidature ($isCandidature) {
        $this->isCandidature = $isCandidature;
    }

    /**
     * Définit si l'on doit créer le dossier pour une prévisualisation ou pour un étudiant
     *
     * @param $isPrev boolean
     */
    public function setIsPrev ($isPrev) {
        $this->isPrev = $isPrev;
    }

    /**
     * Si le dossier est une candidature alors on affiche les autres éléments et
     * on créé une nouvelle page qui contient les autres éléments, les informations spécifiques
     *
     * @return string
     */
    public function isCandidature () {
        if ($this->isCandidature) {
            return $this->printOther () . $this->getPageEnd () . $this->printInformationsSpecifiques ();
        }
        return $this->getPageEnd();
    }

    /**
     * Définit le numéro d'inscription de l'étudiant
     *
     * @param int $numDossier
     */
    public function setNumDossier ($numDossier) {
        $this->numDossier = $numDossier;
    }

    /**
     * Affiche le numéro d'inscription sur le dossier PDF
     *
     * @return string
     */
    public function printNumDossier () {
        return "<span><b>Votre numéro de dossier : </b>" . $this->numDossier . "</span>";
    }

    /**
     * Affiche l'url des pièces manquantes sur le dossier PDF
     *
     * @return string
     */
    public function printUrlPiecesmanquantes () {
        return "<div><b>Si vous avez oublié de nous transmettre des documents, veuillez cliquer sur ce <a href='" . $this->urlPiecesmanquantes . "'>lien</a>.</b></div>";
    }

    /**
     * Définit l'url des pièces mannquantes
     *
     * @param $urlPiecesmanquantes
     */
    public function setUrlPiecesManquantes ($urlPiecesmanquantes) {
        $this->urlPiecesmanquantes = $urlPiecesmanquantes;
    }

    /**
     * Définit les titres du dossier PDF
     *
     * @param string $title1
     * @param string $title2
     */
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

    /**
     * @param array $dateLimite tableau contenant les dates limites
     */
    public function setDateLimite ($dateLimite) {
        $this->dateLimite = $dateLimite;
    }

    public function setNote ($note) {
        $this->note = $note;
    }

    /**
     * Déinfit le chemin du logo du PDF
     *
     * @param string $logoPath
     */
    public function setLogoPath ($logoPath) {
        $this->logoPath = $logoPath;
    }

    /**
     * Définit le dernier diplôme obtenu par l'étudiant
     *
     * @param string $dernierDiplome
     */
    public function setDernierDiplome ($dernierDiplome) {
        $this->dernierDiplome = $dernierDiplome;
    }

    /**
     * Affiche le logo de la formation sur le dossier PDF si l'image est dans /pubic/img/logos/nom-formation
     *
     * @return string
     */
    public function printLogo () {
        if ($this->logoPath == "") {
            return '<td></td>';
        } else {
            return '<td class="border-left-none"><img style:"width=200; height=auto;" src=" ' . $this->logoPath . '" /></td>';
        }
    }

    /**
     * Affiche les titres de la formation sur le dossier PDF
     *
     * @return string
     */
    public function printFormationTitle () {
        return '<table class="t_title">
                    <tr>
                        <td colspan="2" class="full_width_table titre3 bold">' . $this->title1 . '</td>
                    </tr>
                    <tr>
                        <td class="fifty_width_table titre1 border-right-none">' . $this->title2 . '</td>
                        ' . $this->printLogo () . '
                    </tr>
                </table>';
    }

    /**
     * Détermine le texte à renvoyer selon le numéro du titulaire
     *
     * @param $num
     *
     * @return mixed
     */
    public function printDegreeHolder () {
        $msgDiplome  = '<br/><span class="note bold">Diplôme : </span>';
        $msgDate     = '<br/><span class="note bold">Date limite de réception des pièces manquantes : </span>';
        $dateLimite1 = (count ($this->dateLimite) == 0) ? "Non renseignée" : $this->dateLimite[0];
        $dateLimite2 = (count ($this->dateLimite) == 0) ? "Non renseignée" : $this->dateLimite[1];
        $dateLimite3 = (count ($this->dateLimite) == 0) ? "Non renseignée" : $this->dateLimite[2];
        switch ($this->checkboxHolder) {
            case 1 :
            {
                return $msgDiplome . $this->holder1 . $msgDate . $dateLimite1 . '<br/>';
            }
                break;
            case 2 :
            {
                return $msgDiplome . $this->holder2 . $msgDate . $dateLimite2 . '<br/>';
            }
                break;
            case 3 :
            {
                return $msgDiplome . $this->holder3 . $msgDate . $dateLimite3 . '<br/>';
            }
                break;
            case 4 :
            {
                return '<b>' . $this->holder1 . '</b> : ' . $dateLimite1 . '<br/>' . '<b>' . $this->holder2 . '</b> : ' . $dateLimite2 . '<br/>' . '<b>' . $this->holder3 . '</b> : ' . $dateLimite3 . '<br/>';
            }
                break;
            default:
                break;
        }
    }

    /*public function printDateLimite ($num) {
        return (count($this->dateLimite) == 0) ? "Non renseignée" : $this->dateLimite[$num];
    }*/

    /**
     * Affiche le type de diplôme dont dipose l'étudiant (Titulaire d'un diplôme ...)
     *
     * @return string
     */
    /*public function printDegreeHolder () {
        $checkbox = '<br/><span class="note bold">Diplôme : </span>' . $this->numHolder ($this->checkboxHolder) . '<br/><span class="note bold">Date limite de réception des pièces manquantes : </span>' . $this->printDateLimite ($this->checkboxHolder) . '<br/><br/>';
        //if ($this->checkboxHolder == 3) {
          //  $checkbox .= '<p class="note">' . $this->note . '</p>';
       // }
        return $checkbox;
    }*/

    /**
     * Définit les informations principales du candidat
     *
     * @param string $applicantSex
     * @param string $applicantName
     * @param string $applicantFirstName
     * @param string $applicantBirthDate
     * @param string $applicantBirthPlace
     * @param string $applicantIne
     * @param string $applicantAdress
     * @param string $applicantFixNumber
     * @param string $applicantPortNumber
     * @param string $applicantMail
     * @param string $applicantActivity
     */
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

    /**
     * @return string Affiche le titre 1 : CANDIDAT ou ETUDIANT
     */
    public function printTitreRubrique1 () {
        return ($this->isCandidature) ? "CANDIDAT" : "ETUDIANT";
    }

    /**
     * Affiche les informations principles du candidat sur le dossier PDF
     *
     * @return string
     */
    public function printApplicant () {
        return '<div class="titre_encadre">' . $this->printTitreRubrique1 () . '</div>
                <br>
                ' . $this->printUrlPiecesmanquantes () . '<br/>' . $this->printNumDossier () . '<br/><br/>
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
                    <span class="bold">Adresse électronique :</span> ' . $this->applicantMail . $this->printActivity () . '
                    <br><br>
                </div>';
    }

    /**
     * Affiche l'activité actuelle de l'étudiant
     *
     * @return string
     */
    public function printActivity () {
        return ($this->isCandidature) ? '<br><br><span class="bold" > Activité actuelle (étudiant, salarié, demandeur d\'emploi, autre) :</span> ' . $this->applicantActivity : "";
    }

    /**
     * Définit les étapes et la ville préférée de l'étudiant
     *
     * @param array  $etapes
     * @param string $villePreferee
     */
    public function setPlanFormation ($etapes, $villePreferee) {
        $this->etapes        = $etapes;
        $this->villePreferee = $villePreferee;
    }

    /**
     * Affiche les étapes que les étudiants a choisi
     *
     * @return string
     */
    public function printPlanFormation () {
        $nomEtapeOrdre = '';
        foreach ($this->etapes as $ordre => $etape) {
            $nomEtapeOrdre .= '<tr><td text-align="center">' . $ordre . '</td>' . '<td>' . $etape . '</td></tr>';
        }
        return $nomEtapeOrdre;
    }

    /**
     * @return string Affiche le titre 2 : FORMATION ENVISAGEE ou PRE-INSCRIPTION DEMANDEE
     */
    public function printTitreRubrique2 () {
        return ($this->isCandidature) ? "FORMATION ENVISAGEE" : "PRE-INSCRIPTION DEMANDEE";
    }

    /**
     * Affiche contenant les étapes et la ville préférée que l'étudiant a choisi
     *
     * @return string
     */
    public function getPlanFormation () {
        return '<br/><div class="titre_encadre">' . $this->printTitreRubrique2 () . '</div><br>
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

    /**
     * Indique si l'étudiant a validé son cursus post-bac ou non pour chaque année
     *
     * @param string $cpb Cursus post-bac
     *
     * @return string
     */
    public function printValide ($cpb) {
        return ($cpb->getValide ()) ? "Oui" : "Non";
    }

    /**
     * Affiche le parcours post-bac de l'étudiant
     *
     * @return string
     */
    public function printPostBac () {
        $postBac = '';
        foreach ($this->cursusPostBac as $cpb) {
            $postBac .= '<tr>
                <td text-align="center">' . $cpb->getAnneeDebut () . '-' . $cpb->getAnneeFin () . '</td>
                <td text-align="center">' . $cpb->getEtablissement () . '</td>
                <td text-align="center">' . $cpb->getCursus () . '</td>
                <td text-align="center">' . $cpb->getNote () . '</td>
                <td text-align="center">' . $this->printValide ($cpb) . '</td>
            </tr>';
        }
        return $postBac;
    }

    /**
     * Définit les informations concernant le BAC de l'étudiant
     *
     * @param string $serie
     * @param string $yearAcquisition
     * @param string $establishment
     * @param string $departement
     * @param string $country
     * @param string $cursusPostBac
     */
    public function setPrevFormation ($serie, $yearAcquisition, $establishment, $departement, $country, $cursusPostBac) {
        $this->serie           = $serie;
        $this->yearAcquisition = $yearAcquisition;
        $this->establishment   = $establishment;
        $this->departement     = $departement;
        $this->country         = $country;
        $this->cursusPostBac   = $cursusPostBac;
    }

    /**
     * Affiche le cursus antérieur de l'étudiant
     *
     * @return string
     */
    public function printPrevFormation () {
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

    /**
     * Définit les expériences de l'étudiant
     *
     * @param array $proExperience
     */
    public function setProExperience ($proExperience) {
        $this->proExperience = $proExperience;
    }

    /**
     * Affiche le tableau contenant les expériences professionnelles de l'étudiant
     *
     * @return string
     */
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

    /**
     * Affiche l'en-tête du tableau contenant les expériences professionnelles
     *
     * @return string
     */
    public function printProExperienceHeader () {
        return (count ($this->proExperience) == 0 && !$this->isPrev) ? '' :
                '<br/><div class="bold_underline">Expérience professionnelle (emplois, stages, jobs étdudiants):</div><br/>
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

    /**
     * Définit les autres éléments
     *
     * @param string $foreignLanguage
     * @param string $otherElements
     */
    public function setOther ($foreignLanguage, $otherElements) {
        $this->foreignLanguage = $foreignLanguage;
        $this->otherElements   = $otherElements;
    }

    /**
     * Affiche sur le PDF les autres éléments
     *
     * @return string
     */
    public function printOther () {
        return '<br/>
        <div class="bold_underline">Langues étrangères (lu, écrit, parlé) :</div><br/>' . $this->foreignLanguage . '<br/><br/>
        <div class="bold_underline">Autres éléments appuyant votre candidature :</div><br/>' . $this->otherElements . '<br/>';
    }

    /**
     * Définit le type des informations suppélementaires (ex: checkbox, textbox, radiobutton ...)
     *
     * @param array $typeInformations
     */
    public function setTypeInformations ($typeInformations) {
        $this->typeInformations = $typeInformations;
    }

    /**
     * Définit les informations supplémentaires
     *
     * @param array $informationsSpecifiques
     */
    public function setInformationsSpecifiques ($informationsSpecifiques) {
        $this->informationsSpecifiques = $informationsSpecifiques;
    }

    /**
     * Affiche les informations spécifiques sur le PDF
     *
     * @return string
     */
    public function printInformationsSpecifiques () {
        // C'est une prévisualisation
        if ($this->isPrev) {
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
            if (count ($this->informationsSpecifiques) == 0) { // Pas d'informations spécifiques
                // On n'affiche pas le titre de la rubrique informations spécifiques
                return "";
            } else {
                // On affiche le titre de la rubrique
                return $this->getNewPage () . '<div class="titre_encadre">INFORMATIONS SPECIFIQUES A LA FORMATION</div><br/>' . $informationsSpecifiquesLibelles . $this->getPageEnd ();
            }
        } else { // Ce n'est pas une prévisualisation
            if ($this->informationsSpecifiques == "") { // Pas d'informations spécifiques
                // On n'affiche pas le titre de la rubrique informations spécifiques
                return "";
            } else {
                // On affiche le titre de la rubrique
                return $this->getNewPage () . '<div class="titre_encadre">INFORMATIONS SPECIFIQUES A LA FORMATION</div><br/>' . $this->informationsSpecifiques . $this->getPageEnd ();
            }
        }
    }

    /**
     * Affiche les informations préalables
     *
     * @return string
     */
    public function printInformationsPrealables () {
        return ($this->informationsPrealables == "") ? "<br/>" : $this->informationsPrealables;
    }

    /**
     * Définit les informations préalables
     *
     * @param string $informationsPrealables
     */
    public function setInformationsPrealablesDossier ($informationsPrealables) {
        $this->informationsPrealables = $informationsPrealables;
    }

    /**
     * Affiche le cadre Modalités
     *
     * @return string
     */
    public function printDossierModalites () {
        return '<div class="titre_encadre">MODALITES</div>' . $this->modalites;
    }

    /**
     * Définit les modalités
     *
     * @param string $modalites
     */
    public function setDossierModalites ($modalites) {
        $this->modalites = $modalites;
    }

    /**
     * Affiche les informations de la formation
     *
     * @return string
     */
    public function printDossierInformations () {
        return '<div class="titre_encadre">INFORMATIONS</div>' . $this->informations;
    }

    /**
     * Définit les informatins du dossier
     *
     * @param $informations
     */
    public function setDossierInformations ($informations) {
        $this->informations = $informations;
    }

    /**
     * Indique si l'on doit utiliser la ligne "Proposition admission en niveau inférieur" ou non
     *
     * @param boolean $rowAdmin
     */
    public function setRowAdmin ($rowAdmin) {
        $this->rowAdmin = $rowAdmin;
    }

    /**
     * Affiche la ligne si $rowAdmin est vrai
     *
     * @param boolean $rowAdmin
     *
     * @return string
     */
    public function printRowAdmin ($rowAdmin) {
        if ($rowAdmin) {
            return '<img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/> Proposition admission en niveau inférieur<br/>
                    ………………………………………………………………………………………………………………………………………<br/>
                    ………………………………………………………………………………………………………………………………………<br/><br/>';

        }
        return "";
    }

    /**
     * Affiche les cases semestre 1 et semestre 2
     *
     * @return string
     */
    public function printCadreSemester () {
        return $this->voeuxMultiple . '<br><br><img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/>  S1
                <img src="classes/Pdf/img/case_a_cocher.jpg" alt=""/>  S2';
    }


    /**
     * Affiche le cadre réservé à la commission pédagogique
     *
     * @return string
     */
    public function printCadreAdministration () {
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
                        ' . $this->printVoeux ($this->tableauVoeux, $this->voeuxMultiple) . '
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
                            <td colspan="3">' . $this->printRowAdmin ($this->rowAdmin) . '</td>
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

    /**
     * Indique si l'on souhaite avoir plusieurs voeux ou un seul dans la fiche de commission pédagogique
     *
     * @param boolean $voeuxMultiple
     */
    public function setVoeuxMultiple ($voeuxMultiple) {
        $this->voeuxMultiple = $voeuxMultiple;
    }

    /**
     * Affiche les voeux dans la fiche de la comission pédagogique
     *
     * @param array   $voeux
     * @param boolean $voeuxMultiple
     *
     * @return string
     */
    public function printVoeux ($voeux, $voeuxMultiple) {
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
                            <td colspan="2" width="200">' . $this->printCadreSemester () . '<br/></td>
                            <td></td>
                        </tr>';
        }
        return $voeuxFormation;
    }

    /**
     * Définit les voeux
     *
     * @param array $tableauVoeux
     */
    public function setCadreAdministrationVoeux ($tableauVoeux) {
        $this->tableauVoeux = $tableauVoeux;
    }

    /**
     * Affiche l'en-tête de la fiche de la commission pédagogique
     *
     * @return string
     */
    public function printFicheCommissionPeda () {
        return '<div class="titre_encadre">FICHE COMMISSION PEDAGOGIQUE</div><br/>
                <div class="text_align">Commission pédagogique du :………………………………………</div><br/>
                <div>Nom et Prénom du candidat : ' . $this->applicantName . ' ' . $this->applicantFirstName . '</div>
                <br/><div>Demande l’autorisation de s’inscrire en : ' . $this->title2 . '<br/></div><br/>
                <div>Dernier diplôme obtenu : ' . $this->dernierDiplome . '</div><br/>
                <div>Date et lieu : le ' . date ("d/m/Y") . ' à </div><br/>';
    }

    /**
     * Fais appel à toutes les méthodes qui affichent du code HTML afin de créer une page PDF
     *
     * @return string
     */
    public function __toString () {
        return $this->getCssPath () . $this->getPageBegin () . $this->pagePdfHeader . $this->pagePdfFooter . $this->printFormationTitle () .
               $this->printDegreeHolder () . $this->printInformationsPrealables () . $this->printApplicant () . $this->getPlanFormation () . $this->getPageEnd () .
               $this->getNewPage () . $this->printPrevFormation () . $this->printProExperienceHeader () . $this->isCandidature () .
               $this->getNewPage () . $this->printDossierModalites () . $this->printDossierInformations () . $this->getPageEnd () .
               $this->getNewPage () . $this->printFicheCommissionPeda () . $this->printCadreAdministration () . $this->getPageEnd ();
    }
}
