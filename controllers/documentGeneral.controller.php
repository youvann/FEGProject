<?php

/**
 * @Project: FEG Project
 * @File: /controllers/document.controller.php
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
        $documentsGeneraux = $documentGeneralManager->findAll();
        echo $twig->render('documentGeneral/grilleDocumentGeneral.html.twig', array('documentsGeneraux' => $documentsGeneraux));
    } break;
    case "ajouter": {
        echo $twig->render('documentGeneral/ajouterDocumentGeneral.html.twig');
    } break;
    case "ajout": {
        $documentGeneralManager->insert(new DocumentGeneral(0, $_POST['nom'], $_POST['multiple']));
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
    case "modifier": {
        $documentGeneral = $documentGeneralManager->find($_GET['id']);
        echo $twig->render('documentGeneral/modifierDocumentGeneral.html.twig', array('documentGeneral' => $documentGeneral));
    } break;
    case "modification": {
        $documentGeneral = new DocumentGeneral($_POST['id'], $_POST['nom'], $_POST['multiple']);
        $documentGeneralManager->update($documentGeneral);
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
    case "suppression": {
        $documentGeneral = $documentGeneralManager->find($_GET['id']);
        $documentGeneralManager->delete($documentGeneral);
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
    default: break;
}