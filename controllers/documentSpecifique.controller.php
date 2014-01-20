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

/* autorisations
  $pageAction = array("ordonner", "ajouter", "ajout", "modifier", "modification", "suppression");

  if (in_array($action, $pageAction) && !$utilisateur->isConnected()) {
  header('location:index.php?uc=utilisateur&action=connecter');
  } */

switch ($action) {
    case "grille": {
	$documentsSpecifiques = $documentSpecifiqueManager->findAllByFormation($_GET['code']);
        echo $twig->render('documentSpecifique/grilleDocumentSpecifique.html.twig', array('documentsSpecifiques' => $documentsSpecifiques, 'code' => $_GET['code']));
    } break;
    case "ajouter": {
        echo $twig->render('documentSpecifique/ajouterDocumentSpecifique.html.twig', array('code' => $_GET['code']));
    } break;
    case "ajout": {
        $documentSpecifiqueManager->insert(new DocumentSpecifique(0, $_POST['code'], $_POST['nom'], $_POST['url']));
        header('location:index.php?uc=documentSpecifique&action=grille&code='.$_POST['code']);
    } break;
    case "modifier": {
        $documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
        echo $twig->render('documentSpecifique/modifierDocumentSpecifique.html.twig', array('documentSpecifique' => $documentSpecifique, "code" => $_GET['code']));
    } break;
    case "modification": {
        $documentSpecifique = new $documentSpecifique($_POST['id'], $_POST['code'], $_POST['nom'], $_POST['url']);
        $documentSpecifiqueManager->update($documentSpecifique);
        header('location:index.php?uc=documentSpecifique&action=grille&code='.$_POST['code']);
    } break;
    case "suppression": {
        $documentSpecifique = $documentSpecifiqueManager->find($_GET['id']);
		$documentSpecifiqueManager->delete($documentSpecifique);
        header('location:index.php?uc=documentSpecifique&action=grille&code='.$_GET['code']);
    } break;
    default: break;
}