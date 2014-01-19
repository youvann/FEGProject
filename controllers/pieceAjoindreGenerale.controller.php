<?php

/**
 * @Project: FEG Project
 * @File: /controllers/pieceAJoindreGenerale.controller.php
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
        $piecesAJoindreGenerale = array();
        $piecesAJoindreGenerale[] = new PieceAJoindreGenerale("01", "CV");
        $piecesAJoindreGenerale[] = new PieceAJoindreGenerale("02", "Lettre de motivation");
        echo $twig->render('pieceAJoindreGenerale/grillePieceAJoindreGenerale.html.twig', array('piecesAJoindreGenerale' => $piecesAJoindreGenerale, 'titre2' => 'Liste des pièces générales à joindre'));
    } break;
    case "ajouter": {
        echo $twig->render('pieceAJoindreGenerale/ajouterPieceAJoindreGenerale.html.twig', array('titre2' => 'Ajouter une pièce'));
    } break;
    case "ajout": {
        $pieceAJoindreGeneraleManager->insert(new PieceAJoindreGenerale($_POST["id"], $_POST["libel_piece"]));
        header('location:index.php?uc=pieceAJoindreGenerale&action=grille');
    } break;
    case "modifier": {
        $pieceAJoindreGenerale = $pieceAJoindreGeneraleManager->find($_GET["id"]);
        echo $twig->render('pieceAJoindreGenerale/ajouterPieceAJoindreGenerale.html.twig', array('pieceAJoindreGenerale' => $pieceAJoindreGenerale, "titre2" => 'Modifier une pièce'));
    } break;
    case "modification": {
        $pieceAJoindreGenerale = new PieceAJoindreGenerale($_POST["id"], $_POST["libel_piece"]) ;
        $pieceAJoindreGeneraleManager->update($pieceAJoindreGenerale);
        header('location:index.php?uc=pieceAJoindreGenerale&action=grille');
    } break;
    case "suppression": {
        $pieceAJoindreGenerale = $pieceAJoindreGeneraleManager->find($_GET["id"]);
        $pieceAJoindreGeneraleManager->delete($pieceAJoindreGenerale);
        header('location:index.php?uc=pieceAJoindreGenerale&action=grille');
    } break;
    default: break;
}