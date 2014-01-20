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
        //$pieceAJoindre = $pieceAJoindreManager->find($_POST['libel_piece'], $_GET['code_etape'], $_GET['code_vet']);
        //$pieceAJoindre = new PieceAJoindre("Lettre de motivation", "BGE303", "111");
        //echo $twig->render('pieceAJoindre/modifierPieceAJoindre.html.twig', array('pieceAJoindre' => $pieceAJoindre, "titre2" => 'Modifier la pièce'));
    } break;
    case "modification": {
        //$pieceAJoindre = new PieceAJoindreManager($_POST['libel_piece'], $_POST['code_etape'],  $_POST['code_vet']);
        //$pieceAJoindreManager->update($pieceAJoindre);
        header('location:index.php?uc=pieceAJoindre&action=grille');
    } break;
    case "suppression": {
        //$pieceAJoindre = $pieceAJoindreManager->find($_POST['libel_piece'], $_GET['code_etape'], $_GET['code_vet']);
        //$pieceAJoindreManager->delete($pieceAJoindre);
        header('location:index.php?uc=pieceAJoindre&action=grille');
    } break;
    default: break;
}