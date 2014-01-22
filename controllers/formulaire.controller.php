<?php
/**
 * @Project: FEG Project
 * @File: /controllers/formulaire.controller.php
 * @Purpose: Contrôleur qui se charge d'afficher les différentes vues des formulaires d'inscription
 * @Author: 
 */

if (!isset($_GET['action'])) {
    $action = "formCandidat";
} else {
    $action = $_GET['action'];
}

$limitDate = "7 juin 2014";

switch ($action) {
    case "formCandidat": {
        echo $twig->render('formulaire/formCandidat.html.twig', array(
        ));
    } break;
    case "infoPerso": {
        echo $twig->render('formulaire/infoPerso.html.twig', array(
            "limitDate" => $limitDate
        ));
    } break;
    case "postBac": {
        echo $twig->render('formulaire/postBac.html.twig', array(
        ));
    } break;
    case "choixSpe": {
        echo $twig->render('formulaire/choixSpe.html.twig', array(

        ));
    } break;
    case "document": {
        $documents = $documentManager->findAll();
        echo $twig->render('formulaire/document.html.twig', array(
            "documents" => $documents
        ));
    } break;
    case "documentSpecifique": {
        $documentsSpecifique = $documentSpecifiqueManager->findAllByFormation("BTM");
        echo $twig->render('formulaire/documentSpecifique.html.twig', array(
            "documentsSpecifique" => $documentsSpecifique
        ));
    } break;
    default: break;
}

