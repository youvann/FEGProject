<?php
/* 
 * Project: FEG Project
 * File: /pdf/pdf.php
 * Purpose: Génération du PDF L3 Gestion Parcours MIAGE
 * Author: 
 */
    header('Content-Type: text/html; charset=utf-8');
    require('../classes/fpdf17/fpdf.php');

	class PDF extends FPDF{
        // public function __construct() {

        // }

        // En-tête
        function Header(){
            // Police Verdana Bold 15
            $this->SetFont('Verdanab','',16);
            // Logo
            $this->Cell(60, 21, '', 'LTRB', 0, 'L', $this->Image('img/feg.png',10,8,80));
            // Titre
            $this->MultiCell(0, 7, "DOSSIER DE CANDIDATURE\nANNNE UNIVERSITAIRE 2013-2014\nFACULTE D'ECONOMIE ET DE GESTION",1);
            // Saut de ligne
            $this->Ln(4);
        }

        // Nom de la formation
        function FormationName(){
            $this->SetFont('Verdanab','',14);
            $this->Cell(0, 7, 'Institut superieur en sciences de gestion', 'LTRB', 0, '');
            $this->Ln(7);
            $this->SetFontSize(28);
            $this->Cell(0, 13, 'Licence Gestion', 'LTRB', 0, 'L');
            $this->Ln(13);

            $this->SetFontSize(24);            
            $this->MultiCell(0, 35, "",1, $this->Image('img/miage.png', 120, 58, 65));
            $this->setXY(60,57);
            $this->write(12, "L3 Gestion");
            $this->setXY(68,67);
            $this->write(12, "Parcours");
            $this->setXY(78,77);
            $this->write(12, "MIAGE");

            $this->Ln(13);
            $this->SetFontSize(14);
            $this->Cell(0, 8, 'Methodes Informatiques Appliquees a la Gestion des Entreprises', 'LTRB', 0, '');
        }

        // Titulaire d'un diplôme
        function DegreeHolder (){
            $this->SetFont('Verdanab','',9);
            $this->setX(14);
            $this->Cell(0, 7, "Titulaire d'un diplome francais - Date limite de depot du dossier le 7 Juin 2013", 0, 0, 'L', $this->Image('img/unchecked.png', 10, 104, 3));
            $this->Ln(5);
            $this->setX(14);
            $this->Cell(0, 7, "Titulaire d'un diplome de l'Union Europeenne - Date limite de depot du dossier le 7 Juin 2013", 0, 0, 'L', $this->Image('img/unchecked.png', 10, 109, 3));
            $this->Ln(5);
            $this->setX(14);
            $this->Cell(0, 7, "Titulaire d'un diplome hors Union Europeenne* - Date limite de depot du dossier le 7 Juin 2013", 0, 0, 'L', $this->Image('img/unchecked.png', 10, 114, 3));

            $this->Ln(9);
            $this->SetFont('Verdana','',9);
            $this->MultiCell(0, 5, "* Dossier a utiliser si vous residez dans l'Espace europeen, ou dans un pays ou il n'existe pas\nd'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant a cette prescription\nne sera pas examine.", 0);
        }

        // Cadre du candidat + Photo
        function Applicant(){
            $this->SetFont('Verdanab', '', 11);
            $this->SetFillColor(241,241,241);
            $this->Cell(0, 7, 'CANDIDAT', 'LTRB', 2, 'L', 'true');
            $this->Ln(2);
            $this->SetFont('Verdana', '', 10);
            $this->setX(14);
            $this->Cell(11, 7, "Mme", 0, 0, 'L', $this->Image('img/unchecked.png', 10, 152, 3));
            $this->setX(29);
            $this->Cell(11, 7, "M.", 0, 0, 'L', $this->Image('img/unchecked.png', 25, 152, 3));

            // Cadre Nom, Prénom, Date et lieu de naissance ...
            $this->Rect(10, 158, 190, 33);
            $this->SetXY($this->GetX() - 30, $this->GetY() + 10);
            
            $this->SetFont('Verdanab', '', 10);
            $this->Cell(13, 7, 'Nom : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, 'Pierre', 0, 0, 'L');
            $this->Ln(6);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(19, 7, 'Prenom : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, 'Paul', 0, 0, 'L');
            $this->Ln(6);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(53, 7, 'Date et lieu de naissance : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, '01/01/1992', 0, 0, 'L');
            $this->Ln(6);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(26, 7, 'Nationalite : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, 'Francaise', 0, 0, 'L');
            $this->Ln(6);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(71, 7, 'N. INE (pour etudiants en France) : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, '1234567890W', 0, 1, 'L');

            // Adresse, Téléphone, Mail ...
            $this->SetXY($this->GetX(), $this->GetY() + 5);
            $this->SetFont('Verdanab', '', 10);
            $this->Cell(19, 7, 'Adresse : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, '5 rue MIAGE, Bat B, Residence AMU, 13100 Aix-en-Provence', 0, 0, 'L');
            $this->Ln(9);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(18, 7, 'Tel fixe : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(35, 7, '04 42 28 27 26', 0, 0, 'L');
            $this->SetFont('Verdanab', '', 10);
            $this->Cell(27, 7, 'Tel portable : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, '06 92 38 17 20', 0, 0, 'L');
            $this->Ln(9);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(45, 7, 'Adresse electronique : ', 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, 'project-feg@gmail.com', 0, 0, 'L');
            $this->Ln(9);

            $this->SetFont('Verdanab', '', 10);
            $this->Cell(133, 7, "Activite actuelle * (etudiant, salarie, demandeur d'emploi, autre) : ", 0, 0, 'L');
            $this->SetFont('Verdana', '', 10);
            $this->Cell(90, 7, 'etudiant', 0, 0, 'L');
            $this->Ln(9);

            $this->SetFont('Verdana', '', 8);
            $this->MultiCell(0, 5, "*Vous etes salarie, vous souhaitez beneficier d'un conge individuel de formation (CIF, DIF) ou d'une periode professionnalisation, vous etes demandeur d'emploi, beneficiaire du RSA, vous souhaitez effectuer une procedure de VAE ou de VAP, vous avez cesse vos etudes depuis au moins 2 ans, vous avez suivi un cursus de formation en alternance, vous avez plus de 28 ans : Contactez rapidement le secretariat de la formation afin que votre dossier et les possibilites de financement vous concernant soient examines au plus tot.", 0);
        }

        // Formation envisagée
        function PlanFormation (){
            $this->SetFont('Verdanab', '', 10);
            $this->SetFillColor(241,241,241);
            $this->Cell(0, 7, 'FORMATION ENVISAGEE', 'LTRB', 2 , 'L', 'true');
            $this->Ln(6);

            $this->SetX($this->GetX()+ 135);
            $this->Cell(55, 7, 'Localisation des parcours', 'LTRB', 2, 'C');
            $this->SetX($this->GetX() - 135);
            $this->Cell(135, 7, 'Parcours', 'LTRB', 0, 'C');
            $this->Cell(55, 7, 'Aix-en-Provence/Marseille', 'LTRB', 1, 'C');
            
            $this->SetFont('Verdana', '', 8);
            $this->Cell(135, 7, 'L3 Gestion parcours MIAGE - Methodes Informatiques Appliquees a la Gestion des Entreprises', 'LTRB', 0, 'L');
            $this->Cell(55, 7, 'Aix-en-Provence', 'LTRB', 1, 'C');
        }

        // Renseignements complémentaires
        function ComplementaryInfo(){
            $this->SetFont('Verdanab', '', 8);
            $this->SetFillColor(241,241,241);
            $this->Cell(0, 7, 'RENSEIGNEMENTS COMPLEMENTAIRES', 'LTRB', 2 , 'C', 'true');
            $this->Rect($this->GetX(), $this->GetY(), 190, 130);
            $this->SetFont('Verdana', '', 8);
            $this->MultiCell(0, 8, "Comment avez-vous connu la formation sur laquelle vous candidatez (presse, internet, famille, amis, ...) :", 0);
            $this->Ln(122);
        }

        // Cursus anterieur
        function PrevFormation (){
            $this->SetFont('Verdanab', '', 9);
            $this->Cell(0, 7, 'CURSUS ANTERIEUR', 'LTRB', 1, 'L', 'true');
            $this->Ln(4);

            // BAC
            $this->Rect($this->GetX(), $this->GetY(), 190, 33);
            $this->SetFont('Verdanab','',9);
            $this->SetY($this->GetY()+ 2);
            $this->Cell(0, 7, 'BACCALAUREAT', 0, 1, 'C');
            $this->Ln(2);

            $this->SetFont('Verdana', '', 8);
            $this->Cell(10, 7, 'Serie : ', 0, 0, 'L');
            $this->Cell(35, 7, 'Scientifique', 0, 0, 'L');

            $this->Cell(28, 7, "Annee d'obention : ", 0, 0, 'L');
            $this->Cell(28, 7, '2010', 0, 0, 'L');

            $this->Cell(23, 7, "Etablissement : ", 0, 0, 'L');
            $this->Cell(15, 7, 'Lycee Roland Garros', 0, 1, 'L');

            $this->Cell(22, 7, "Departement : ", 0, 0, 'L');
            $this->Cell(65, 7, 'Bouches-du-rhone', 0, 0, 'L');

            $this->Cell(10, 7, "Pays : ", 0, 0, 'L');
            $this->Cell(15, 7, 'France', 0, 1, 'L');

            // Enseignement supérieur
            $this->AddPage();
            $this->Rect($this->GetX(), $this->GetY(), 190, 93);
            $this->SetFont('Verdanab','',9);
            $this->SetY($this->GetY()+ 2);
            $this->Cell(0, 7, 'ENSEIGNEMENT SUPERIEUR', 0, 1, 'C');

            $this->SetFont('Verdanab','',9);
            $this->Cell(28, 7, "Derniere inscription dans l'enseignement superieur : ", 0, 1, 'L');

            $this->SetFont('Verdana','',8);
            $this->Cell(31, 7, "Annee universitaire : ", 0, 0, 'L');
            $this->Cell(28, 7, "2013/2014", 0, 1, 'L');

            $this->Cell(27, 7, "Formation suivie : ", 0, 0, 'L');
            $this->Cell(28, 7, "DUT Informatique IUT Aix-en-Provence", 0, 1, 'L');
            $this->Ln(2);

            // Cursus Post-bac
            $this->SetX($this->GetX()+ 3);
            $this->SetFont('Verdanab','',9);
            $this->Cell(184, 7, 'Cursus Post-bac', 1, 1, 'C');
            $this->SetFont('Verdana','',8);

            for($i = 0; $i < 5; $i++){
                $this->SetX($this->GetX()+ 3);
                $this->Cell(25, 10, 'Annee' . $i, 1, 0, 'C');
                $this->Cell(70, 10, 'Etablissement' . $i, 1, 0, 'C');
                $this->Cell(70, 10, 'Cursus suivi' . $i, 1, 0, 'C');
                $this->Cell(19, 10, 'Valide' . $i, 1, 1, 'C');
            }   

            $this->Ln(6);
            $this->SetFont('Verdanab','',9);
            $this->Cell(28, 7, "Experience professionnelle (emplois, stages) : ", 0, 1, 'L');
            $this->SetFont('Verdana','',9);

            $this->setX(14);
            $this->Cell(40, 7, "Jobs etudiant", 0, 0, 'L', $this->Image('img/unchecked.png', $this->GetX() - 3, $this->GetY() + 2, 3));
            $this->Cell(0, 7, "Stages dans le cadre de vos etudes : fournir les attestations de stage", 0, 1, 'L', $this->Image('img/unchecked.png', $this->GetX() - 3, $this->GetY() + 2, 3));
            $this->setX(14);
            $this->Cell(0, 7, "Emploi occupe a temps partiel ou a temps plein (hors statut d'etudiant salarie)", 0, 1, 'L', $this->Image('img/unchecked.png', $this->GetX() - 3, $this->GetY() + 2, 3));
        }

        // Pied de page
        function Footer(){
            $this->SetFont('Verdana', '', 8);
            // Positionnement à 1,5 cm du bas
            $this->SetY(-15);
            // Numéro de page
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF();
    // Ajout de la police Verdana et Verdana Bold
    $pdf->AddFont('Verdana','','Verdana.php');
    $pdf->AddFont('Verdanab','','Verdanab.php');
    $pdf->AliasNbPages();

    $pdf->AddPage();
    $pdf->FormationName();
    $pdf->Ln(12);
    $pdf->DegreeHolder();
    $pdf->Ln(5);
    $pdf->Applicant();

    $pdf->AddPage(); 
    $pdf->PlanFormation();
    $pdf->Ln(4);

    $pdf->ComplementaryInfo();
    $pdf->Ln(4);

    $pdf->PrevFormation();

    // $pdf->SetFont('Verdana','',10);
    // for($i = 1; $i <= 20; $i++){
    //     $pdf->Cell(0, 10,'Impression de la ligne numero ' . $i, 0, 1);
    // }
    $pdf->Output();



?>