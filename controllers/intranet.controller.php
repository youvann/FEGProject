<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
    $action = "accueil";
} else {
    $action = $_GET['action'];
}

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
    case "accueil" :
    {
        echo $twig->render('intranet/accueil.html.twig');
    }
        break;
    case "carte" :
    {
        echo $twig->render('intranet/carte.html.twig');
    }
        break;
    case "explorateur" :
    {
        echo $twig->render('intranet/explorateur.html.twig',
            array('directory' => str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__))) . '/../')
        );
    }
        break;
    case "telechargerDossier" :
    {
        /*$z = new ZipArchive();
        $z->open("test.zip", ZIPARCHIVE::CREATE);
        folderToZip($_GET['folder'], $z, true);
        $z->close();*/
        //var_dump($_GET['folder'], str_replace('/', '\\', $_GET['folder']));
        //var_dump($_GET['folder']);
        //$path = folderToZip2($_GET['folder']);

        $path = Zip($_GET['folder'], './lib/' . time() . '.zip');
		echo $twig->render('intranet/telechargerDossier.html.twig', array('path' => $path));
    }
        break;
    case "generationPdfCandidature" :
    {
        $formation   = $formationManager->find("3BAS");
        $dossier     = $dossierManager->find('g11625159', '3BAS');
        $titulaire   = $titulaireManager->findAll();
        $cursus      = $cursusManager->findAllByDossier($dossier);
        $experiences = $experienceManager->findAllByDossier($dossier);
        $faires      = $faireManager->findAllByDossier($dossier);

        //$documentsGeneraux    = $documentGeneralManager->findAll();
        //$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation("3BAS");

        $etapes = array();
        $villesPossibles = array();

        // Récupère l'ordre des voeux et les villes où la formatin a lieu
        foreach ($faires as $faire) {
            $voeu                       = $voeuManager->find($faire->getCodeEtape());
            $lesSeDerouler              = $seDeroulerManager->findAllByVoeu($voeu);
            $etapes[$faire->getOrdre()] = $voeu->getEtape();

            //echo $voeu->getEtape() . ' ' . $faire->getOrdre();
            foreach ($lesSeDerouler as $unSeDerouler) {
                $ville = $villeManager->find($unSeDerouler->getCodeVet());
                // echo ' - ' . $ville->getNom();
            }
            // echo '<br>';
            $villesPossibles[] = $ville->getNom();
        }
        // Supprime les doublons des villes
        $villesPossibles = array_unique($villesPossibles);

        //var_dump($villesPossibles);

        $rs = $conn->query('SELECT `information`.`id` as idInfo, `information`.`libelle` as libelleInfo, `type`.`id` as typeInfo, `choix`.`texte` as libellesInfo
                            FROM `information`
                            INNER JOIN `type` ON (`information`.`type` = `type`.`id`)
                            LEFT JOIN `choix` ON (`information`.`id` = `choix`.`information`)
                            ORDER BY `information`.`ordre`;')->fetchAll();

        $structure               = $translatorResultsetToStructure->translate($rs);
        $informationsSpecifiques = $translatorJsonToHTML->translate($dossier->getInformations(), $structure);
        //$informationsSpecifiques = "";
        //$structure = "";
        
        require_once './classes/Pdf/PagePdf.class.php';
        $pagePdf = new PagePdf("./classes/pdf/style/pdf.css", "30mm", "7mm", "0mm", "10mm");

        // En-tête du pdf
        $pagePdf->setPagePdfHeaderImgPath("./classes/Pdf/img/feg.png");
        $pagePdf->setPagePdfHeaderText("DOSSIER DE CANDIDATURE<br />ANNÉE UNIVERSITAIRE 2013-2014<br />FACULTÉ D'ÉCONOMIE ET DE GESTION");

        // Pied du pdf
        $pagePdf->setPagePdfFooterText("Page [[page_cu]]/[[page_nb]]");

        // Corps du pdf
        $pagePdf->setTitle("Institut supérieur en sciences de Gestion", $formation->getMention());
        $pagePdf->setHolder(' ' . $titulaire[0]->getLibelle(), ' ' . $titulaire[1]->getLibelle(), ' ' . $titulaire[2]->getLibelle(), $dossier->getTitulaire());
        //$pagePdf->setNote("* Dossier à utiliser si vous résidez dans l'Espace européen, ou dans un pays où il n'existe pas d'espaceCampus-France (voir www.campusfrance.org). Tout dossier contrevenant à cette prescription ne sera pas examiné.");
        $pagePdf->setApplicant($dossier->getGenre(), $dossier->getNom(), $dossier->getPrenom(), $dossier->getLieuNaissance(), $dossier->getDateNaissance(), $dossier->getIne(), $dossier->getAdresse() . ' ' . $dossier->getComplement() . ' ' . $dossier->getVille() . ' ' . $dossier->getCodePostal(), $dossier->getFixe(), $dossier->getPortable(), $dossier->getMail(), $dossier->getActivite());
        $pagePdf->setPhotoPath('./classes/Pdf/img/photo/github.png');
        $pagePdf->setPlanFormation($etapes, $villesPossibles);

        $pagePdf->setPrevFormation($dossier->getSerieBac(), $dossier->getAnneeBac(), $dossier->getEtablissementBac(), $dossier->getDepartementBac(), $dossier->getPaysBac(), $cursus);
        $pagePdf->setProExperience($experiences);
        $pagePdf->setOther($dossier->getLangues(), $dossier->getAutresElements());
        $pagePdf->setInformationsSpecifiques($informationsSpecifiques);

        $pagePdf->setCadreAdministrationVoeux(array("voeux1", "voeux2"));
        $pagePdf->setVoeuxMultiple(true);
        $pagePdf->setRowAdmin(true);

        // $documentsGeneraux    = array("CV", "Lettre de motivation", "Passeport/Carte d'identité","Diplômes", "Photo");
        // $documentsSpecifiques = array("Livret de famille", "Lettre essai", "llo/Carte d'identité","sss", "aaa");
        //$pagePdf->setDocumentsGeneraux($documentsGeneraux);
        //$pagePdf->setDocumentsSpecifiques($documentsSpecifiques);

        ob_start();
        echo $pagePdf;
        $content = ob_get_clean();

        // convert in PDF
        require_once './classes/Pdf/html2pdf/html2pdf.class.php';
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(12, 10, 10, 10));
            //$html2pdf->setModeDebug();
            $html2pdf->pdf->addFont('verdana', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdana.php');
            $html2pdf->pdf->addFont('verdanab', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdanab.php');
            $html2pdf->setDefaultFont('verdana');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('html2pdf.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
        break;
        case "generationPdfPreinscription" :
    {
            
            
    }
        break;
    default:
        break;
}