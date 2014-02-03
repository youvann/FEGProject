<?php

/**
 * @Project: FEG Project
 * @File   : /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author :
 */
if (!isset($_GET['action'])){
    $action = "choixFormation";
} else{
    $action = $_GET['action'];
}

switch ($action){
    case "candidaturePossible" :
    {
        $q = $conn->prepare("SELECT if(count(*) = 0, true, false) as possible FROM `dossier` WHERE `dossier`.`INE` = ? and `dossier`.`CODE_FORMATION` = ?;");
        $q->execute(array($_POST['ine'], $_POST['code_formation']));
        $rs = $q->fetch();

        $response['response'] = $rs['possible'];
        echo json_encode($response);
    }
        break;
    case "choixFormation" :
    {
        $formations = $formationManager->findAll();
        echo $twig->render('formulaire/choixFormation.html.twig', array('formations' => $formations));
    }
        break;
    case "traiterChoixFormation":
    {
        $derniere = $_POST['derniere'];
        $_SESSION['choisie'] = $_POST['choisie'];
        $_SESSION['ine'] = $_POST['ine'];

        header('location:index.php?uc=formulaire&action=main');
    }
        break;
    case "displayDocuments":
    {
        FileHeader::headerJson();
        $documentsGeneraux = $documentGeneralManager->findAll();
        $documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation($_POST['code']);

        $response = array();
        $general = array();
        $specifique = array();

        foreach ($documentsGeneraux as $documentGeneral){
            $general[] = $documentGeneral->getNom();
        }
        foreach ($documentsSpecifiques as $documentSpecifique){
            $specifique[] = array($documentSpecifique->getNom(), $documentSpecifique->getUrl());
        }
        $response['general'] = $general;
        $response['specifique'] = $specifique;
        echo(json_encode($response));
    }
        break;
    case "main":
    {
        // Chargement des voeux
        $formation = $formationManager->find($_SESSION['choisie']);
        $voeux = $voeuManager->findAllByFormation($formation);
        foreach ($voeux as $voeu){
            $voeu->setVilles($voeuManager->getVilles($voeu));
        }
        $nbVoeux = count($voeux);

        // Chargement des informations supplémentaires
        $structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formation));
        $form = $translatorStructureToForm->translate($structure);
        $formHTML = $form->getHTML();

        // Chargement des documents généraux et spécifiques
        $documentsGeneraux = $documentGeneralManager->findAll();
        $documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation($_SESSION['choisie']);

        myMkdirIne($_SESSION['choisie'] . '/Candidatures/' . $_SESSION['ine']);

        echo $twig->render('formulaire/mainFormulaire.html.twig', array(
            'formation' => $formation,
            'voeux' => $voeux,
            'nbVoeux' => $nbVoeux,
            'form' => $formHTML,
            'documentsGeneraux' => $documentsGeneraux,
            'documentsSpecifique' => $documentsSpecifiques,
            'typedossier' => 'CA'
        ));
    }
        break;
    case "traiterMainFormulaire":
    {
        var_dump($_POST, count($_POST));
        $postInformations = array_slice($_POST, 69);
        $structure = $translatorResultsetToStructure->translate($informationManager->getResultset($formationManager->find($_SESSION['choisie'])));
        $json = $translatorFormToJson->translate($structure, $postInformations);

        // Changer le code formation !!
        $dossier = new Dossier($_POST["ine"], $_SESSION['choisie'], $_POST["nom"], $_POST["prenom"], $_POST["adresse"], $_POST["complement"], $_POST["code_postal"], $_POST["ville"], $_POST["date_naissance"], $_POST["lieu_naissance"], $_POST["fixe"], $_POST["portable"], $_POST["mail"], $_POST["genre"], $_POST["langues"], $_POST["nationalite"], $_POST["serie_bac"], $_POST["annee_bac"], $_POST["etablissement_bac"], $_POST["departement_bac"], $_POST["pays_bac"], $_POST["activite"], $_POST["autre"], $_POST["titulaire"], $_POST["ville_preferee"], $_POST["autres_elements"], $json, NULL);

        if (!$etudiantManager->ifExists(new Etudiant($_POST["ine"], 1))){
            $etudiantManager->insert(new Etudiant($_POST["ine"], 1));
        } else{
            $etudiant = $etudiantManager->find($_POST["ine"]);
            $nombreDepots = $etudiant->getNombreDepots();
            $nombreDepots = $nombreDepots + 1;
            $etudiantManager->update($etudiant);
        }
        $dossierManager->insert($dossier);

        $cursusManager->insert(new Cursus(0, $_POST["ine"], $_SESSION['choisie'], $_POST['anneeDebutCursus-1'], $_POST['anneeFinCursus-1'], $_POST['cursus-1'], $_POST['etablissement-1'], $_POST['valide-1']));
        $cursusManager->insert(new Cursus(0, $_POST["ine"], $_SESSION['choisie'], $_POST['anneeDebutCursus-2'], $_POST['anneeFinCursus-2'], $_POST['cursus-2'], $_POST['etablissement-2'], $_POST['valide-2']));
        $cursusManager->insert(new Cursus(0, $_POST["ine"], $_SESSION['choisie'], $_POST['anneeDebutCursus-3'], $_POST['anneeFinCursus-3'], $_POST['cursus-3'], $_POST['etablissement-3'], $_POST['valide-3']));
        $cursusManager->insert(new Cursus(0, $_POST["ine"], $_SESSION['choisie'], $_POST['anneeDebutCursus-4'], $_POST['anneeFinCursus-4'], $_POST['cursus-4'], $_POST['etablissement-4'], $_POST['valide-4']));
        $cursusManager->insert(new Cursus(0, $_POST["ine"], $_SESSION['choisie'], $_POST['anneeDebutCursus-5'], $_POST['anneeFinCursus-5'], $_POST['cursus-5'], $_POST['etablissement-5'], $_POST['valide-5']));

        $experienceManager->insert(new Experience(0, $_POST["ine"], $_SESSION['choisie'], $_POST['moisDebut-1'], $_POST['anneeDebut-1'], $_POST['moisFin-1'], $_POST['anneeFin-1'], $_POST['entreprise-1'], $_POST['fonction-1']));
        $experienceManager->insert(new Experience(0, $_POST["ine"], $_SESSION['choisie'], $_POST['moisDebut-2'], $_POST['anneeDebut-2'], $_POST['moisFin-2'], $_POST['anneeFin-2'], $_POST['entreprise-2'], $_POST['fonction-2']));
        $experienceManager->insert(new Experience(0, $_POST["ine"], $_SESSION['choisie'], $_POST['moisDebut-3'], $_POST['anneeDebut-3'], $_POST['moisFin-3'], $_POST['anneeFin-3'], $_POST['entreprise-3'], $_POST['fonction-3']));

        $i = 1;
        foreach ($_POST['voeu'] as $codeEtape){
            $faireManager->insert(new Faire($codeEtape, $_POST["ine"], $_SESSION['choisie'], $i));
            ++$i;
        }

        /* GENERATION PDF HERE */
        $formation = $formationManager->find($_SESSION['choisie']);
        $dossier = $dossierManager->find($_SESSION['ine'], $_SESSION['choisie']);
        $titulaire = $titulaireManager->findAll();
        $cursus = $cursusManager->findAllByDossier($dossier);
        $experiences = $experienceManager->findAllByDossier($dossier);
        $faires = $faireManager->findAllByDossier($dossier);

        //$documentsGeneraux    = $documentGeneralManager->findAll();
        //$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation($_SESSION['choisie']);

        $etapes = array();
        $villesPossibles = array();

        // Récupère l'ordre des voeux et les villes où la formatin a lieu
        foreach ($faires as $faire){
            $voeu = $voeuManager->find($faire->getCodeEtape());
            $lesSeDerouler = $seDeroulerManager->findAllByVoeu($voeu);
            $etapes[$faire->getOrdre()] = $voeu->getEtape();

            //echo $voeu->getEtape() . ' ' . $faire->getOrdre();
            foreach ($lesSeDerouler as $unSeDerouler){
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

        $structure = $translatorResultsetToStructure->translate($rs);
        $informationsSpecifiques = $translatorJsonToHTML->translate($dossier->getInformations(), $structure);

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

        ob_start();
        echo $pagePdf;
        $content = ob_get_clean();

        // convert in PDF
        require_once './classes/Pdf/html2pdf/html2pdf.class.php';
        try{
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(12, 10, 10, 10));
            //$html2pdf->setModeDebug();
            $html2pdf->pdf->addFont('verdana', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdana.php');
            $html2pdf->pdf->addFont('verdanab', '', './classes/html2pdf/_tcpdf_5.0.002/fonts/verdanab.php');
            $html2pdf->setDefaultFont('verdana');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

            $html2pdf->Output('./dossiers/' . $_SESSION['choisie'] . '/Candidatures/' . $_SESSION['ine'] . '/Candidature-' . $_SESSION['ine'] . '.pdf', 'F');
            //echo "<script type='text/javascript'>document.location.replace('index.php?uc=formulaire&action=recapitulatif');</script>";

        } catch (HTML2PDF_exception $e){
            echo $e;
            exit;
        }

    }
        break;
    case "recapitulatif" :
    {
        echo $twig->render('formulaire/recapitulatif.html.twig', array());
    }
        break;
    default:
        break;
}

