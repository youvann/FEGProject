<?php

/**
 * @Project: FEG Project
 * @File: /controllers/document.controller.php
 * @Purpose: Ce contrôleur gère l'entité DocumentGénéral
 * @Author: Lionel Guissani
 */
if (!isset($_GET['action'])) {
    $action = "grille";
} else {
    $action = $_GET['action'];
}

switch ($action) {
	// Cette action affiche la liste des documents générés
    case "grille": {
	    // On récupère tous les documents génréaux
        $documentsGeneraux = $documentGeneralManager->findAll();
        echo $twig->render('documentGeneral/grilleDocumentGeneral.html.twig', array('documentsGeneraux' => $documentsGeneraux));
    } break;
	// Cette action mène au formulaire d'ajout d'un document général
    case "ajouter": {
        echo $twig->render('documentGeneral/ajouterDocumentGeneral.html.twig');
    } break;
	// Cette action ajoute un formulaire en base de donneés
    case "ajout": {
	    // On ajoute le document à travers le manager
        $documentGeneralManager->insert(new DocumentGeneral(0, $_POST['nom'], $_POST['visible']));
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
	// Cette action mène au formulaire de modification d'un document général
    case "modifier": {
        $documentGeneral = $documentGeneralManager->find($_GET['id']);
        echo $twig->render('documentGeneral/modifierDocumentGeneral.html.twig', array('documentGeneral' => $documentGeneral));
    } break;
	// Cette action modifie un document général en base de données
    case "modification": {
	    // On met à jour le document à travers le manager
        $documentGeneralManager->update(new DocumentGeneral($_POST['id'], $_POST['nom'], $_POST['visible']));
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
	// Cette action supprime un document général en base de données
    case "suppression": {
        $documentGeneral = $documentGeneralManager->find($_GET['id']);
        $documentGeneralManager->delete($documentGeneral);
        header('location:index.php?uc=documentGeneral&action=grille');
    } break;
    default: break;
}
