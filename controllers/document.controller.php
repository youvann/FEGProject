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

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
	case "consulter": {		
        $formation = $formationManager->find($_GET['code']);
        echo $twig->render('document/consulterDocument.html.twig', array('formation' => $formation));
    } break;
    case "grille": {
        $documents = $documentManager->findAll();
        echo $twig->render('document/grilleDocument.html.twig', array('documents' => $documents));
    } break;
    case "ajouter": {
        echo $twig->render('document/ajouterDocument.html.twig');
    } break;
    case "ajout": {
        $documentManager->insert(new Document(0, $_POST['nom'], $_POST['multiple']));
        header('location:index.php?uc=document&action=grille');
    } break;
    case "modifier": {
        $document = $documentManager->find($_GET['id']);
        echo $twig->render('document/modifierDocument.html.twig', array('document' => $document));
    } break;
    case "modification": {
        $document = new Document($_POST['id'], $_POST['nom'], $_POST['multiple']);
        $documentManager->update($document);
        header('location:index.php?uc=document&action=grille');
    } break;
    case "suppression": {
        $document = $documentManager->find($_GET['id']);
        $documentManager->delete($document);
        header('location:index.php?uc=document&action=grille');
    } break;
    default: break;
}