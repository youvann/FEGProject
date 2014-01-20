<?php

/**
 * @Project: FEG Project
 * @File: /controllers/informationSupp.controller.php
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
        $informations = array();
        $informations[] = new Information("01", "nom1", "code1", "libelle1", "explications1", "ordre1");
        $informations[] = new Information("02", "nom2", "code2", "libelle2", "explications2", "ordre2");
        echo $twig->render('information/grilleInformation.html.twig', array('informations' => $informations, "titre2" => "Liste des informations"));
    } break;
    case "ajouter": {
        echo $twig->render('information/ajouterInformation.html.twig', array('titre2' => 'Ajouter une information'));
    } break;
    case "ajout": {
        $informationManager->insert(new Information($_POST["id"], $_POST["nom"], $_POST["id"], $_POST["code"], $_POST["libelle"], $_POST["explications"], $_POST["ordre"]));
        header('location:index.php?uc=information&action=grille');
    } break;
    case "modifier": {
        $information = $informationManager->find($_GET['id']);
        echo $twig->render('information/modifierInformation.html.twig', array('information' => $information));
    } break;
    case "modification": {
        $information = new Information($_POST["id"], $_POST["nom"], $_POST["id"], $_POST["code"], $_POST["libelle"], $_POST["explications"], $_POST["ordre"]));
        $informationManager->update($information);
        header('location:index.php?uc=information&action=grille');
    } break;
    case "suppression": {
        $information = $informationManager->find($_GET['id']);
        $informationManager->delete($information);
        header('location:index.php?uc=information&action=grille');
    } break;
    default: break;
}