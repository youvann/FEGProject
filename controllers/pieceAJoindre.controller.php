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
        $piecesAJoindre = array();
        $piecesAJoindre[] = new PieceAJoindre("Comment avez-vous connu notre formation ?", "BGE303", "111");
        $piecesAJoindre[] = new PieceAJoindre("QCM", "BGE303", "111");
        echo $twig->render('pieceAJoindre/grillePieceAJoindre.html.twig', array('piecesAJoindre' => $piecesAJoindre, 'titre2' => 'Liste des pièces à joindre'));
    } break;
    case "ajouter": {
        echo $twig->render('pieceAJoindre/ajouterPieceAJoindre.html.twig', array('titre2' => 'Ajouter une pièce'));
    } break;
    case "ajout": {
        $pieceAJoindreManager->insert(new PieceAJoindreManager($_POST['libel_piece'], $_POST['code_etape'],  $_POST['code_vet']));
        header('location:index.php?uc=pieceAJoindre&action=grille');
    } break;
    case "modifier": {
        $pieceAJoindre = $pieceAJoindreManager->find($_POST['libel_piece'], $_GET['code_etape'], $_GET['code_vet']);
        //$pieceAJoindre = new PieceAJoindre("Lettre de motivation", "BGE303", "111");
        echo $twig->render('pieceAJoindre/modifierPieceAJoindre.html.twig', array('pieceAJoindre' => $pieceAJoindre, "titre2" => 'Modifier la pièce'));
    } break;
    case "modification": {
        $pieceAJoindre = new PieceAJoindreManager($_POST['libel_piece'], $_POST['code_etape'],  $_POST['code_vet']);
        $pieceAJoindreManager->update($pieceAJoindre);
        header('location:index.php?uc=pieceAJoindre&action=grille');
    } break;
    case "suppression": {
        $pieceAJoindre = $pieceAJoindreManager->find($_POST['libel_piece'], $_GET['code_etape'], $_GET['code_vet']);
        $pieceAJoindreManager->delete($pieceAJoindre);
        header('location:index.php?uc=pieceAJoindre&action=grille');
    } break;
    default: break;
}