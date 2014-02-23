<?php

/**
 * @Project: FEG Project
 * @File: /controllers/pieceAJoindre.controller.php
 * @Purpose:
 * @Author:
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "grille": {
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
		$documentsSpecifiques = $documentSpecifiqueManager->findAllByDossierPdf($dossierPdf);
        echo $twig->render('documentSpecifique/grilleDocumentSpecifique.html.twig', array('documentsSpecifiques' => $documentsSpecifiques, 'dossierPdf' => $dossierPdf));
    } break;
    case "ajouter": {
		$dossierPdf = $dossierPdfManager->find($_GET['dossierPdf']);
        echo $twig->render('documentSpecifique/ajouterDocumentSpecifique.html.twig', array('dossierPdf' => $dossierPdf));
    } break;
    case "ajout": {
        $documentSpecifiqueManager->insert(new DocumentSpecifique(0, $_POST['dossier_pdf'], $_POST['nom'], $_POST['url']));
        header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf='.$_POST['dossier_pdf']);
    } break;
    case "modifier": {
        $documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
		$dossierPdf = $dossierPdfManager->find($documentSpecifique->getDossierPdf());
        echo $twig->render('documentSpecifique/modifierDocumentSpecifique.html.twig', array('documentSpecifique' => $documentSpecifique, 'dossierPdf' => $dossierPdf));
    } break;
    case "modification": {
        $documentSpecifique = new documentSpecifique($_POST['id'], $_POST['dossier_pdf'], $_POST['nom'], $_POST['url'], $_POST['multiple']);
        $documentSpecifiqueManager->update($documentSpecifique);
        header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf='.$_POST['dossier_pdf']);
    } break;
    case "suppression": {
        $documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
		$documentSpecifiqueManager->delete($documentSpecifique);
        header('location:index.php?uc=documentSpecifique&action=grille&dossierPdf='.$documentSpecifique->getDossierPdf());
    } break;
    default: break;
}
